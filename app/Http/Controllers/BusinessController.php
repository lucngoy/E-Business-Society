<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Notification;

// Models
use App\Models\Review;
use App\Models\Business;
use App\Models\Category;
use App\Models\User;

// Notification
use App\Notifications\BusinessStatusUpdated;
use App\Notifications\NewBusinessPostedForUser;
use App\Notifications\NewBusinessPostedForAdmin;
use App\Notifications\BusinessDeletedByAdmin;
use App\Notifications\BusinessDeletedByOwner;

class BusinessController extends Controller
{
    public function boot()
    {
        // Partager l'utilisateur avec toutes les vues
        View::share('user', Auth::user());
    }

    // Affiche la liste des entreprises sur le dashboard
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $search = $request->input('search');
        $status = $request->input('status');

        $businesses = Business::query()
            ->latest()
            ->with(['category', 'user']) // Chargez les relations nécessaires
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('business_name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('website', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('category_name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('role', 'like', "%{$search}%");
                            $userQuery->orWhere('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when(!$user->isAdmin(), function ($query) use ($user) {
                // Si pas admin afficher uniquement les entreprises lui appartenant
                $query->where('user_id', $user->id);
            })
            ->paginate(10)
            ->onEachSide(2);

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.businesses.index', compact('businesses', 'user', 'search', 'status','totalNotifications'));
    }


    // Affichage des business sur recheche principale
    public function search(Request $request)
    {
        // Validation des entrées
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'category' => 'nullable|exists:categories,id',
            'location' => 'nullable|string|max:255',
        ]);

        // Construction de la requête
        $query = Business::query();

        if ($request->filled('name')) {
            $query->where('business_name', 'like', '%' . $validated['name'] . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $validated['category']);
        }

        if ($request->filled('location')) {
            $query->where('address', 'like', '%' . $validated['location'] . '%');
        }

        // Chargement des entreprises avec pagination
        $businesses = $query->orderByDesc('id')
            ->where('status','approved') // Ne prendre que le businesses apprové par l'admin
            ->paginate(10) // Afficher 10 business par page
            ->onEachSide(2); // Retourne 10 résultats par page

        // Récupération des catégories principales
        $categories = Category::all();

        // Récupère les 6 catégories les plus populaires (par nombre d'entreprises approuvées)
        $topCategories = Category::withCount(['businesses' => function ($query) {
            $query->where('status', 'approved');
        }])
            ->orderByDesc('businesses_count') // Tri par le nombre d'entreprises approuvées
            ->take(6) // Limite à 6 résultats
            ->get();

        // Retourne la vue avec les données
        return view('business.search', compact('businesses', 'categories', 'topCategories'));
    }

    // Affiche le formulaire de création d'une nouvelle entreprise
    public function create()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
        
        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        // Récupérer toutes les catégories avec leurs sous-catégories
        $categories = Category::orderBy('category_name')->get();

        return view('dashboard.businesses.create', compact('categories', 'totalNotifications')); // Passer les catégories à la vue
    }

    // Sauvegarde une nouvelle entreprise dans la base de données
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'address' => 'required|string',
            'phone' => 'required|string',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour une seule image
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Traitement de l'image (si présente)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('business_images', 'public'); // Stockage dans le dossier 'public/business_images'
        }

        try {
            // Déterminer le statut en fonction de l'utilisateur qui publie
            $status = (Auth::user()->role == 'admin') ? 'approved' : 'pending'; // Si l'admin poste, statut "approved", sinon "pending" (ou toute autre valeur par défaut)

            // Création du business
            $business = new Business([
                'business_name' => $validated['business_name'],
                'category_id' => $validated['category_id'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'website' => $validated['website'],
                'description' => $validated['description'],
                'opening_hours' => $validated['opening_hours'],
                'image' => $imagePath, // Stockage du chemin de l'image
                'user_id' => Auth::id(), // ID de l'utilisateur connecté
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'status' => $status, // Assigner le statut ici
            ]);

            // Si nouveau business ajouté
            if ($business->save()) {
                // Notification à l'admin si l'utilisateur qui poste n'est pas l'admin
                if (Auth::user()->role != 'admin') {
                    $users = User::where('role', 'admin')->get();
                    Notification::send($users, new NewBusinessPostedForAdmin($business));
                }

                // Notification à tous les utilisateurs sauf l'admin qui a posté
                $users = User::where('role', 'user')->get();
                Notification::send($users, new NewBusinessPostedForUser($business));
            }

            return redirect()->route('businesses.create')->with('success', 'Business added successfully.');
        } catch (\Exception $e) {
            // Gestion des erreurs (exemple générique, vous pouvez personnaliser selon vos besoins)
            return back()->withErrors(['error' => 'An error has occurred. Please try again later.']);
        }
    }





    // Affiche les détails d'une entreprise spécifique

    public function show($id)
    {
        // Récupère les catégories principales
        $categories = Category::all();

        // Charger l'entreprise avec ses avis paginés
        $business = Business::with(['reviews.user'])->findOrFail($id);

        // Paginer les avis
        $reviews = Review::where('business_id', $business->id)
            ->latest()
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);

        return view('business.show', compact('business', 'reviews', 'categories'));
    }


    // Affiche le formulaire d'édition d'une entreprise
    public function edit(Business $business)
    {
        $user = Auth::user();

        // Vérifiez si un utilisateur est connecté
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        $categories = Category::orderBy('category_name')->get();

        return view('dashboard.businesses.edit', compact('business', 'categories', 'totalNotifications'));
    }

    // Met à jour les informations d'une entreprise dans la base de données
    public function update(Request $request, Business $business)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'address' => 'required|string',
            'phone' => 'required|string',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour une seule image
            'latitude' => 'nullable|numeric', // Validation pour latitude
            'longitude' => 'nullable|numeric', // Validation pour longitude
        ]);

        // Si une nouvelle image est téléchargée
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si nécessaire
            if ($business->image) {
                Storage::disk('public')->delete($business->image);
            }
            // Stocker la nouvelle image
            $validatedData['image'] = $request->file('image')->store('business_images', 'public');
        } else {
            // Si aucune nouvelle image, retirer la clé 'image' pour ne pas écraser la valeur existante
            unset($validatedData['image']);
        }

        // Mise à jour des informations de l'entreprise
        $business->update($validatedData);

        // Rediriger vers la page de l'entreprise ou une autre route
        return redirect()
            ->route('businesses.edit', $business->id)
            ->with('success', 'Business updated successfully.');
    }

    // Méthode pour changer le statut d'une entreprise
    public function changeStatus(Request $request, Business $business)
    {
        $request->validate([
            'status' => 'required|string|in:approved,rejected,pending,inactive',
        ]);

        // Mise à jour du statut de l'entreprise
        $business->update(['status' => $request->status]);

        // Notification au propriétaire de l'entreprise
        $businessOwner = $business->user;
        $businessOwner->notify(new BusinessStatusUpdated($business));

        // Si l'entreprise est approuvée, notifier tous les utilisateurs
        if ($request->status === 'approved') {
            $users = User::where('role', 'user')->get();
            Notification::send($users, new NewBusinessPostedForUser($business));
        }

        return redirect()->route('businesses.index')->with('success', 'Business status updated successfully.');
    }





    public function destroy(Business $business)
    {
        // Récupère le propriétaire de l'entreprise
        $businessOwner = $business->user;

        // Vérifie si l'utilisateur connecté est un admin ou le propriétaire
        $isAdmin = Auth::user()->role == 'admin';
        
        // Supprimer les images de l'entreprise si elles existent
        if ($business->image) {
            Storage::disk('public')->delete($business->image);
        }

        // Supprimer l'entreprise
        $business->delete();

        // Si c'est l'admin qui supprime, notifier le propriétaire
        if ($isAdmin) {
            $businessOwner->notify(new \App\Notifications\BusinessDeletedByAdmin($business));
        } else {
            // Si c'est le propriétaire qui supprime, notifier l'admin
            $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new \App\Notifications\BusinessDeletedByOwner($business));
        }

        // Retourner une réponse avec un message de succès
        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully');
    }

}

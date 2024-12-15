<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use App\Models\Review;
use App\Models\Business;
use App\Models\Category;

class BusinessController extends Controller
{
    public function boot()
    {
        // Partager l'utilisateur avec toutes les vues
        View::share('user', Auth::user());
    }

    // Affiche la liste des entreprises
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $search = $request->input('search');

        $businesses = Business::query()
            ->latest()
            ->where('business_name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhere('website', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('address', 'like', "%{$search}%")
            ->with('category')
            ->when(!$user->isAdmin(), function ($query) use ($user) {
                $query->where('user_id', $user->id); // Filtrer les entreprises selon l'utilisateur connecté
            })
            ->paginate(10)
            ->onEachSide(2); // Remplacez '10' par le nombre d'éléments par page

        return view('dashboard.businesses.index', compact('businesses', 'user', 'search'));
    }



    // Affiche le formulaire de création d'une nouvelle entreprise
    public function create()
    {
        // Récupérer toutes les catégories avec leurs sous-catégories
        $categories = Category::all();

        return view('dashboard.businesses.create', compact('categories')); // Passer les catégories à la vue
    }

    // Sauvegarde une nouvelle entreprise dans la base de données
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'business_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'address' => 'required|string',
            'phone' => 'required|string',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour une seule image
        ]);

        // Traitement de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('business_images', 'public'); // Dossier public/business_images
        }

        // Création de l'objet Business
        $business = new Business([
            'business_name' => $request->business_name,
            'category_id' => $request->category_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
            'description' => $request->description,
            'opening_hours' => $request->opening_hours,
            'image' => $imagePath, // Enregistrer le chemin de l'image
            'user_id' => Auth::id(), // L'utilisateur connecté
        ]);

        $business->save();

        return redirect()->route('businesses.create')->with('success', 'Business added successfully.');
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

        $categories = Category::all();

        return view('dashboard.businesses.edit', compact('business', 'categories'));
    }

    // Met à jour les informations d'une entreprise dans la base de données
    public function update(Request $request, Business $business)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'opening_hours' => 'nullable|string|max:500',
            // Validation pour une image unique (décommenter si nécessaire)
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Si vous gérez l'upload d'image, décommentez ce bloc
        // if ($request->hasFile('image')) {
        //     // Supprimer l'ancienne image si nécessaire
        //     if ($business->image) {
        //         Storage::disk('public')->delete($business->image);
        //     }
        //     $validatedData['image'] = $request->file('image')->store('business_images', 'public'); // Enregistrer dans le dossier public/business_images
        // }

        // Mise à jour des informations de l'entreprise
        $business->update($validatedData);

        // Rediriger vers la page de l'entreprise ou une autre route
        return redirect()
            ->route('businesses.edit', $business->id)
            ->with('success', 'Business updated successfully.');
    }

    // Supprime une entreprise de la base de données
    public function destroy(Business $business)
    {
        $businessOwner = $business->user; // Supposons que la relation est définie (Business appartient à User)

        // Supprimer les images de l'entreprise si elles existent
        if ($business->image) {
            Storage::disk('public')->delete($business->image);
        }

        // Supprimer l'entreprise
        $business->delete();

        // Notifier le propriétaire
        // $businessOwner->notify(new \App\Notifications\BusinessDeleted($business->business_name));

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully');
    }
}

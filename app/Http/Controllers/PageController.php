<?php
// app/Http/Controllers/PageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Business;
use App\Models\Review;


class PageController extends Controller
{
    public function home()
    {
        // Récupère toutes les catégories pour le header
        $categories = Category::orderBy('category_name')->get();

        // Récupère les 6 catégories les plus populaires (par nombre d'entreprises approuvées)
        $topCategories = Category::withCount(['businesses' => function ($query) {
            $query->where('status', 'approved');
        }])
            ->orderByDesc('businesses_count') // Tri par le nombre d'entreprises approuvées
            ->take(6) // Limite à 6 résultats
            ->get();

        // Récupère les 3 entreprises les plus populaires (par moyenne des avis, seulement approuvées)
        $topBusinesses = Business::withAvg('reviews', 'rating') // Charge la moyenne des avis
            ->where('status', 'approved') // Seulement les entreprises approuvées
            ->orderByDesc('reviews_avg_rating') // Trie par la moyenne des avis
            ->take(3) // Limite à 3 résultats
            ->get();

        // Récupère les 6 derniers avis pour des entreprises approuvées
        $latestReviews = Review::with(['business' => function ($query) {
                $query->where('status', 'approved');
            }, 'user'])
            ->latest() // Trie par date de création décroissante
            ->get()
            ->unique('business_id') // Rend chaque entreprise unique
            ->take(6); // Limite à 6 résultats

        


        // Récupère les coordonnées des entreprises approuvées pour la carte interactive
        $businesses = Business::select('business_name', 'address', 'latitude', 'phone', 'longitude')
            ->where('status', 'approved') // Seulement les entreprises approuvées
            ->get();

        return view('home', compact('businesses', 'categories', 'topCategories', 'latestReviews', 'topBusinesses'));
    }


    public function listings(Request $request)
    {
        // Récupérer les filtres depuis la requête
        $query = $request->input('query');        // Recherche par nom ou description
        $categoryId = $request->input('category'); // Filtrer par catégorie
        $location = $request->input('location');  // Filtrer par emplacement

        // Récupérer les catégories pour le filtre
        $categories = Category::all();

        // Construire la requête de base
        $businesses = Business::withCount('reviews') // Inclure le nombre d'avis
            ->withAvg('reviews', 'rating') // Inclure la note moyenne
            ->where('status','approved'); // Ne prendre que le businesses apprové par l'admin

        // Appliquer les filtres
        if ($query) {
            $businesses->where('business_name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        }

        if ($categoryId) {
            $businesses->where('category_id', $categoryId);
        }

        if ($location) {
            // Optionnel : si vous avez des données de latitude/longitude, ajoutez un filtre de distance
            $businesses->where('address', 'like', '%' . $location . '%');
        }

        // Pagination pour les résultats
        $businesses = $businesses->latest()->paginate(10)->withQueryString();

        // Récupère les 6 catégories les plus populaires (par nombre d'entreprises approuvées)
        $topCategories = Category::withCount(['businesses' => function ($query) {
            $query->where('status', 'approved');
        }])
            ->orderByDesc('businesses_count') // Tri par le nombre d'entreprises approuvées
            ->take(6) // Limite à 6 résultats
            ->get();

        // Retourner la vue avec les données
        return view('listings', compact('businesses', 'categories', 'topCategories'));
    }



    public function about()
    {
        // Récupère les catégories principales
        $categories = Category::all();
        
        return view('about', compact('categories')); // Vue pour la page 'À propos'
    }

    public function contact()
    {
        // Récupère les catégories principales
        $categories = Category::all();
        
        return view('contact', compact('categories')); // Vue pour la page de contact
    }
}

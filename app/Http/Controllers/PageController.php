<?php
// app/Http/Controllers/PageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Business; // Assure-toi que tu utilises le bon modèle


class PageController extends Controller
{
    public function home()
    {
        // Récupère toutes les catégories pour le header
        $categories = Category::all();

        // Récupère les 6 catégories les plus populaires (par nombre d'entreprises)
        $topCategories = Category::withCount('businesses')
            ->orderByDesc('businesses_count') // Tri par le nombre d'entreprises
            ->take(6) // Limite à 6 résultats
            ->get();

        return view('home', compact('categories', 'topCategories'));
    }

    public function listings()
    {
        // Récupère les catégories principales
        $categories = Category::all();

        // Récupérer toutes les entreprises avec le nombre d'avis et la note moyenne des avis
        $businesses = Business::withCount('reviews')  // Compte le nombre d'avis pour chaque entreprise
            ->latest()
            ->withAvg('reviews', 'rating')  // Calcule la note moyenne des avis
            ->paginate(10)
            ->onEachSide(2); // Remplacez '10' par le nombre d'éléments par page
            // ->get();

        return view('listings', compact('businesses', 'categories')); // Vue pour la page des listings
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

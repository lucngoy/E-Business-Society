<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // recup les donnees saisie
        $search = $request->input('search');

        // Récupère toutes les catégories
        $categories = Category::query()
            ->latest()
            ->where('id', 'like', "%{$search}%")
            ->orWhere('category_name', 'like', "%{$search}%")
            ->paginate(10)
            ->onEachSide(2);

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();


        return view('dashboard.categories.index', compact('categories','totalNotifications'));
    }

    // Affiche le formulaire d'édition d'une categorie
    public function edit(Category $category)
    {
        $user = Auth::user();

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        // Vérifiez si un utilisateur est connecté
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        return view('dashboard.categories.edit', compact('category', 'totalNotifications'));
    }

    // Affiche le formulaire de création d'une nouvelle Category
    public function create()
    {
        return view('dashboard.categories.create');
    }

    // Sauvegarde une nouvelle Category dans la base de données
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'category_name' => 'required|string|max:50|min:3',
        ]);

        // Création de l'objet Category
        $category = new Category([
            'category_name' => $request->category_name,
        ]);

        $category->save();


        return redirect()
            ->route('categories.index')
            ->with('success', 'Category added successfully.');
    }

    // Met à jour les informations d'une category dans la base de données
    public function update(Request $request, Category $category)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:50|min:3',
        ]);

        // Mise à jour des informations d la Category
        $category->update($validatedData);


        // Rediriger vers la page de la Category ou une autre route
        return redirect()
            ->route('categories.edit', $category->id)
            ->with('success', 'Category updated successfully.');
    }

    // Supprime une category de la base de données
    public function destroy(Category $category)
    {

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}

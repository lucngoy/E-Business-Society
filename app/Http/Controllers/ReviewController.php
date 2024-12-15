<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviews(Request $request)
    {
        $user = auth()->user(); // Récupérer l'utilisateur connecté

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $search = $request->input('search');

        if ($user->isAdmin()) {
            // Si l'utilisateur est administrateur, récupérer tous les avis
            $reviews = Review::query()
                ->latest()
                ->where('rating', 'like', "%{$search}%")
                ->orWhere('comment', 'like', "%{$search}%")
                ->paginate(10)
                ->onEachSide(2); // Remplacez '10' par le nombre d'éléments par page

        } elseif ($user->isBusinessOwner()) {
            // Si l'utilisateur est propriétaire d'entreprise, récupérer ses entreprises et leurs avis
            $reviews = Review::with('business')
                ->whereHas('business', function ($query) use ($user) {
                    $query->where('user_id', $user->id); // Remplacez `user_id` par le nom correct de la colonne
                })
                ->latest()
                ->where('rating', 'like', "%{$search}%")
                ->orWhere('comment', 'like', "%{$search}%")
                ->paginate(10)
                ->onEachSide(2); // Remplacez '10' par le nombre d'éléments par page;

        } else {
            // Si l'utilisateur n'a pas de rôle valide, retourner une liste vide
            $reviews = collect(); // Collection vide
        }

        return view('dashboard.reviews', compact('reviews', 'user', 'search'));
    }

    // Méthode pour enregistrer un nouvel avis
    public function store(Request $request, $businessId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = new Review();
        $review->business_id = $businessId;
        $review->user_id = auth()->user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('business.show', $businessId)->with('success', 'Review added successfully.');
    }

    // Méthode pour supprimer un avis
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('dashboard.reviews')->with('success', 'Business deleted successfully');
    }
}

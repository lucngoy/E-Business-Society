<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Business;
use App\Models\Category;
use App\Models\Review;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function overview() {

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $userRole = auth()->user()->role; // Obtiens le rôle de l'utilisateur connecté

        // Valeurs par défaut
        $totalBusinesses = 0;
        $totalReviews = 0;
        $totalUsers = 0;
        $averageRating = 0;
        $myBusinesses = 0;
        $reviews = 0;
        $businesses = 0;
        $categories = 0;
        $businessCounts = 0;
        $businessCountsByMonth = [];
        $reviewsCountsByMonth = [];
        $categoriesData = [];

        if ($userRole === 'admin') {
            $totalBusinesses = Business::count(); // Nombre total d'entreprises
            $totalReviews = Review::count(); // Nombre total d'avis
            $totalUsers = User::count(); // Nombre total d'utilisateurs
            $averageRating = Review::average('rating'); // Note moyenne des avis

            // Chart data
            $businessCountsByMonth = Business::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $reviewsCountsByMonth = Review::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $categoriesData = Business::select('category_id', DB::raw('count(*) as count'))
                ->groupBy('category_id')
                ->with('category') // Assurez-vous que la relation 'category' existe
                ->get();
            
            // Préparez les données pour le graphique
            $categories = $categoriesData->pluck('category.category_name')->toArray(); // Catégories (axe X)
            $businessCounts = $categoriesData->pluck('count')->toArray(); // Nombre d'entreprises (axe Y)

        } elseif ($userRole === 'business_owner') {
            $userId = auth()->id();
            $myBusinesses = Business::where('user_id', $userId)->count();
            $totalReviews = Review::whereIn('business_id', Business::where('user_id', $userId)->pluck('id'))->count();
            $averageRating = Review::whereIn('business_id', Business::where('user_id', $userId)->pluck('id'))->average('rating');
            $reviews = Review::with('business')
                ->where(function ($query) use ($user) {
                    $query->whereHas('business', function ($subQuery) use ($user) {
                        $subQuery->where('user_id', $user->id); // Filtrer uniquement les entreprises de l'utilisateur
                    });
                })->take(6)->latest()->get();

            $businesses = Business::with(['category', 'user']) // Charger les relations nécessaires
                ->withCount('reviews') // Obtenir le nombre de reviews
                ->withAvg('reviews', 'rating') // Obtenir la moyenne des notes (assurez-vous que "rating" est le bon champ)
                ->latest()
                ->when(!$user->isAdmin(), function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->take(6)->get();

        }

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.overview', compact(
            'userRole',
            'totalBusinesses',
            'totalReviews',
            'totalUsers',
            'averageRating',
            'myBusinesses',
            'reviews',
            'businesses',
            
            'businessCountsByMonth',
            'reviewsCountsByMonth',

            'categoriesData',
            'categories',
            'businessCounts',
            'totalNotifications'
        ));
    }

    // public function reviews() {
    //     return view('dashboard.reviews');
    // }

    public function users() {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.users', compact('totalNotifications'));
    }

    public function reports() {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.reports', compact('totalNotifications'));
    }

    public function settings() {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
        
        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.settings', compact('totalNotifications'));
    }
}

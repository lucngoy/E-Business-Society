<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Affiche la liste des notifications
    public function index(Request $request)
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Récupération de la recherche
        $search = $request->input('search');

        // Requête pour les notifications
        $notificationsQuery = $user->notifications()->orderBy('created_at', 'desc');

        if ($search) {
            // Filtre les notifications si une recherche est effectuée
            $notificationsQuery->where('data', 'like', '%' . $search . '%');
        }

        $notifications = $notificationsQuery
            ->paginate(10)
            ->onEachSide(2);

        // Total des notifications non lues
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.notifications.index', compact('notifications', 'totalNotifications', 'search'));
    }

    // Marquer une notification comme lue
    public function markAsRead($id)
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
        
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->route('notifications.index')->with('success', 'Notification marked as read successfully.');
    }

    // Marquer toutes les notifications comme lues
    public function markAllAsRead()
    {
        $user = auth()->user(); // Récupère l'utilisateur connecté

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $user->unreadNotifications->markAsRead();

        return redirect()->route('notifications.index')->with('success', 'All notifications marked as read successfully.');
    }
}

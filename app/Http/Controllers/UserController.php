<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Afficher les users inscrit
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        $search = $request->input('search');

        $users = User::query()
            ->latest()
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('role', 'like', "%{$search}%")
            ->paginate(10)
            ->onEachSide(2);

        // Total des notifications
        $totalNotifications = $user->unreadNotifications()->count();

        return view('dashboard.users', compact('users', 'search','totalNotifications'));
    }

    // Supprime un user de la base de données
    public function destroy(User $user)
    {
        try {
            $user->delete(); // Supprime l'utilisateur
            return redirect()->route('dashboard.users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.users')->with('error', 'Failed to delete user.');
        }
    }
}

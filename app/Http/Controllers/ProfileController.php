<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    // Afficher la page setting
    public function settings()
    {
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }
        return view('dashboard.settings');
    }

    // Mettre a jour le profil
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validation des champs
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['nullable', Rule::in(['user', 'business_owner', 'admin'])],
        ]);

        // Préparation des données à mettre à jour
        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        // Mise à jour du rôle si l'utilisateur n'est pas admin
        if ($user->role !== 'admin' && $request->filled('role')) {
            $updateData['role'] = $request->input('role');
        }
        
        // Mise à jour des données utilisateur
        $user->update($updateData);

        return redirect()->route('dashboard.settings')->with('success', 'Profile updated successfully.');
    }


    // Mettre a jour le mot de passe
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('dashboard.settings')->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('dashboard.settings')->with('success', 'Password updated successfully.');
    }

    // Supprime un user de la base de données
    public function destroy(User $user)
    {
        try {
            $user->delete(); // Supprime l'utilisateur
            return redirect()->route('login')->with('success', 'User profile deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.settings')->with('error', 'Failed to delete. Please try later.');
        }
    }
}

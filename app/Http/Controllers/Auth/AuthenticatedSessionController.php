<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Générer deux nombres aléatoires
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);

        // Stocker la question et la réponse dans la session
        session(['captcha_question' => "$num1 + $num2", 'captcha_answer' => $num1 + $num2]);

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Valider le captcha
        $request->validate([
            'captcha' => 'required|numeric', // Le champ captcha doit être un nombre
        ]);

        // Vérifier si la réponse au captcha est correcte
        if ($request->input('captcha') != session('captcha_answer')) {
            return back()->withErrors(['captcha' => 'The captcha answer is incorrect.'])->withInput();
        }

        // Authentification de l'utilisateur
        $request->authenticate();

        // Régénérer la session après authentification
        $request->session()->regenerate();

        // Redirection basée sur le rôle de l'utilisateur
        $user = $request->user();

        if ($user->role === 'admin' || $user->role === 'business_owner') {
            return redirect()->route('dashboard.overview'); // Rediriger vers overview si admin ou business_owner
        } else {
            return redirect()->route('dashboard.settings'); // Rediriger vers settings pour les autres utilisateurs
        }
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

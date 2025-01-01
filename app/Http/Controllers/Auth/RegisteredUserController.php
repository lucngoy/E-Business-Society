<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Générer deux nombres aléatoires
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);

        // Stocker la question et la réponse dans la session
        session(['captcha_question' => "$num1 + $num2", 'captcha_answer' => $num1 + $num2]);
        
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'captcha' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value != session('captcha_answer')) {
                        $fail('The captcha answer is incorrect.');
                    }
                },
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Nettoyer les données de session liées au captcha
        session()->forget(['captcha_question', 'captcha_answer']);

        event(new Registered($user));

        // Connecter l'utilisateur et rediriger
        Auth::login($user);

        // Redirection vers dashboard
        return redirect()->route('dashboard.settings')->with('success', 'Account created successfully.');
    }
}

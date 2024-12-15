@extends('layouts.login-layout')
@section('title', 'Register')
@section('content')
    <div class="login100-pic js-tilt" data-tilt>
        <img src="{{ asset('images/img-01.png') }}" alt="IMG">
    </div>

    <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
        <a class="txt2" style="display: flex;align-items: center;justify-content: center;" href="{{ route('home') }}">
            Go to the home page
        </a>
        <br>
        @csrf
        <span class="login100-form-title">
            {{ __('Register') }}
        </span>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Name -->
        <div class="wrap-input100 validate-input {{ $errors->has('name') ? 'alert-validate' : '' }}" data-validate="{{ $errors->has('email') ? $errors->first('name') : 'Name is required' }}">
            <input class="input100" id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ __('Full Name') }}" />
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>

        <!-- Email Address -->
        <div class="wrap-input100 validate-input {{ $errors->has('email') ? 'alert-validate' : '' }}" data-validate="{{ $errors->has('email') ? $errors->first('email') : 'Valid email is required: ex@abc.xyz' }}">
            <input class="input100" id="email" type="email" name="email" value="{{ old('email') }}" autofocus placeholder="{{ __('Email') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>


        <!-- Password -->
        <div class="wrap-input100 validate-input {{ $errors->has('password') ? 'alert-validate' : '' }}" data-validate="{{ $errors->has('password') ? $errors->first('password') : 'Valid password is required: ex@abc.xyz' }}">
            <input class="input100 password-field" id="password" type="password" name="password" placeholder="{{ __('Password') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <!-- Icône pour afficher/masquer le mot de passe -->
            <span class="toggle-password">
                <i class="fa fa-eye-slash"></i>
            </span>
        </div>

        <!-- Confirm Password -->
        <div class="wrap-input100 validate-input {{ $errors->has('password_confirmation') ? 'alert-validate' : '' }}" data-validate="{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : 'Valid password confirmation is required: ex@abc.xyz' }}">
            <input class="input100 password-field" id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Password confirmation') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <!-- Icône pour afficher/masquer le mot de passe -->
            <span class="toggle-password">
                <i class="fa fa-eye-slash"></i>
            </span>
        </div>

        <!-- <label for="captcha" style="margin-bottom: 5px; display: block;">Solve: {{ session('captcha_question') }}</label> -->
        <!-- Captcha Arithmétique -->
        <div class="wrap-input100 validate-input {{ $errors->has('captcha') ? 'alert-validate' : '' }}" data-validate="{{ $errors->has('captcha') ? $errors->first('captcha') : 'Correct answer is required' }}">
            <input class="input100" id="captcha" type="text" name="captcha" placeholder="Solve: {{ session('captcha_question') }}" required>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-calculator" aria-hidden="true"></i>
            </span>
        </div>


        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <!-- Submit Button -->
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                {{ __('Register') }}
            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="{{ route('login') }}">
                {{ __('Already registered?') }}
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
@endsection

@extends('layouts.login-layout')
@section('title', 'Reset Password')
@section('content')
    <div class="login100-pic js-tilt" data-tilt>
        <img src="{{ asset('images/img-01.png') }}" alt="IMG">
    </div>

    

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <span class="login100-form-title">
            {{ __('Reset Password') }}
        </span>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <div class="wrap-input100 validate-input {{ $errors->has('email') ? 'alert-validate' : '' }}" data-validate="{{ $errors->has('email') ? $errors->first('email') : 'Valid email is required: ex@abc.xyz' }}">
            <input class="input100" id="email" type="email" name="email" :value="old('email')" autofocus placeholder="{{ __('Email') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <!-- Submit Button -->
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="{{ route('login') }}">
                {{ __('Go to login') }}
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
@endsection

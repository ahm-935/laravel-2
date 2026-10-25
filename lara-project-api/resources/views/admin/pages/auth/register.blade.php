@extends('admin.layouts.single-master')

@section('title', 'Register')

@section('content')
<div class="login-card">
    <h4 class="login-card-title text-center">Register</h4>

    <!-- Brand Identity -->
    <a href="index.html" class="login-brand text-decoration-none">
        <i class="bi bi-asterisk"></i>
        <span>Spark Admin</span>
    </a>

    <p class="login-subtitle">Welcome to Spark Admin. Please register to continue.</p>

    <!-- Login Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="login-form-group">
            <label class="login-form-label">Name</label>
            <div class="login-input-group">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="name" class="login-input" placeholder="Enter name" 
                value="">
            </div>
        </div>
        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />

        <!-- Email Input Group -->
        <div class="login-form-group">
            <label class="login-form-label">Email Address</label>
            <div class="login-input-group">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="login-input" placeholder="name@company.com" 
                value="">
            </div>
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

        <!-- Password Input Group -->
        <div class="login-form-group">
            <label for="password" class="login-form-label">Password</label>
            <div class="login-input-group">
                <i class="bi bi-shield-lock input-icon"></i>
                <input type="password" name="password" class="login-input login-input-password" placeholder="••••••••"
                    value="123">
                <button type="button" class="password-toggle-btn" id="toggle-password" aria-label="Show password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

        <div class="login-form-group">
            <label for="password" class="login-form-label">Confirm Password</label>
            <div class="login-input-group">
                <i class="bi bi-shield-lock input-icon"></i>
                <input type="password" name="password_confirmation" class="login-input login-input-password" placeholder="••••••••"
                    value="123">
                <button type="button" class="password-toggle-btn" id="toggle-password" aria-label="Show password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />


        <!-- Submit Button -->
        <button type="submit" class="btn-login" id="btn-submit">
            <span>Register Now</span>
            <i class="bi bi-arrow-right"></i>
        </button>

    </form>

    <!-- Divider -->
    <div class="login-divider">Or signup with</div>

    <!-- Social Logins -->
    <div class="social-login-grid">
        <button class="btn-social" type="button" id="btn-google">
            <i class="bi bi-google text-danger"></i>
            <span>Google</span>
        </button>
        <button class="btn-social" type="button" id="btn-github">
            <i class="bi bi-github"></i>
            <span>GitHub</span>
        </button>
    </div>

    <!-- Footer Link -->
    <p class="login-footer-text">
        Already have an account? <a href="{{ route('login') }}" id="link-register">Login Now</a>
    </p>

</div>
@endsection
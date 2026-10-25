@extends('admin.layouts.single-master')

@section('title', 'Login')

@section('content')
<div class="login-card">
    <h4 class="login-card-title text-center">Login</h4>

    <!-- Brand Identity -->
    <a href="index.html" class="login-brand text-decoration-none">
        <i class="bi bi-asterisk"></i>
        <span>Spark Admin</span>
    </a>

    @if(session('success'))
        <div class="alert alert-success fade show text-center fw-bold" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <p class="login-subtitle">Please sign in to access your dashboard</p>

    <!-- Login Form -->
    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <!-- Email Input Group -->
        <div class="login-form-group">
            <label class="login-form-label">Email Address</label>
            <div class="login-input-group">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="login-input" placeholder="name@company.com" 
                value="{{ old('email') ?? 'asia@mail.com' }}">
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

        <!-- Options (Remember me & Forgot Password) -->
        <div class="login-options">
            <label class="custom-control-label">
                <input type="checkbox" class="custom-checkbox-input" id="rememberMe">
                <span>Remember Me</span>
            </label>
            <a href="#" class="forgot-password-link">Forgot Password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-login" id="btn-submit">
            <span>Sign In to Dashboard</span>
            <i class="bi bi-arrow-right"></i>
        </button>

    </form>

    <!-- Divider -->
    <div class="login-divider">Or sign in with</div>

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
        Don't have an account? <a href="{{ route('register') }}" id="link-register">Register Now</a>
    </p>

</div>
@endsection
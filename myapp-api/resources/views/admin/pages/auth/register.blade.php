@extends("admin.layouts.single-master")

@section('title', 'Register Here')

@section("content")

      <!-- Main centered login card -->
        <div class="login-card">
            
            <!-- Brand Identity -->
            <a href="{{ route('dashboard') }}" class="login-brand text-decoration-none">
                <i class="bi bi-asterisk"></i>
                <span>Spark Admin</span>
            </a>
            
            <p class="login-subtitle">Create a new account</p>
            
            <!-- Login Form -->
            <form action="{{ route('register') }}" method="POST" id="loginForm" class="needs-validation" novalidate>
                @csrf

                <!-- Name Input Group -->
                <div class="login-form-group">
                    <label for="name" class="login-form-label">Name</label>
                    <div class="login-input-group">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="name" id="name" class="login-input" placeholder="John Doe" required>
                    </div>
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email Input Group -->
                <div class="login-form-group">
                    <label for="email" class="login-form-label">Email Address</label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" id="email" class="login-input" placeholder="name@company.com" required>
                    </div>
                   <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <!-- Password Input Group -->
                <div class="login-form-group">
                    <label for="password" class="login-form-label">Password</label>
                    <div class="login-input-group">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="login-input login-input-password" placeholder="•••••" required>
                        <button type="button" class="password-toggle-btn" id="toggle-password" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <!-- Confirm Password Input Group -->
                <div class="login-form-group">
                    <label for="password_confirmation" class="login-form-label">Confirm Password</label>
                    <div class="login-input-group">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="login-input login-input-password" placeholder="•••••" required>
                        <button type="button" class="password-toggle-btn" id="toggle-password-confirmation" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                
                <!-- Options (Remember me & Forgot Password) -->
                {{-- <div class="login-options">
                    <label class="custom-control-label">
                        <input type="checkbox" class="custom-checkbox-input" id="rememberMe">
                        <span>Remember Me</span>
                    </label>
                    <a href="#" class="forgot-password-link">Forgot Password?</a>
                </div> --}}
                
                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="btn-submit">
                    <span>Sign Up</span>
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
                Already have an account? <a href="{{ route('login') }}" id="link-register">Log In</a>
            </p>
            
        </div>
@endsection
{{-- @extends("layouts.single-page")
@section("main")
<div class="text-center">
    <h1 class="h1 mb-3 fw-bold text-danger"> 404</h1>
    <p class="h2 fw-bold">Page not found.</p><br>
    <x-btn href="/"> Back to HomePage</x-btn>
</div> --}}
@extends('admin.layouts.single-master')

@section('title', 'Page Not Found')
@section('content')

        <!-- Main centered error card layout -->
        <div class="login-card text-center">
            
            <!-- Brand Identity -->
            <a href="{{ route('dashboard') }}" class="login-brand text-decoration-none">
                <i class="bi bi-asterisk"></i>
                <span>Spark Admin</span>
            </a>
            
            <!-- Giant 404 header with spinning asterisk Zero -->
            <div class="error-title-huge">
                <span>4</span>
                <i class="bi bi-asterisk"></i>
                <span>4</span>
            </div>
            
            <h2 class="error-subtitle">Page Not Found</h2>
            <p class="error-desc">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>
            
            <div class="error-actions-group">
                <a href="{{ route('dashboard') }}" class="btn-custom btn-custom-primary">
                    <i class="bi bi-house"></i> Back to Dashboard
                </a>
            </div>
            
        </div>

@endsection
@extends('admin.layouts.single-master')

@section('title', 'Page Not Found')

@section('content')
    <div class="login-card text-center">

        <!-- Brand Identity -->
        <a href="index.html" class="login-brand text-decoration-none">
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

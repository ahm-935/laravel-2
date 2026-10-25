@extends('admin.layouts.master')

@section('title', 'Products - Details')

@section('content')
    <x-admin.phead title="Products - Details" subtitle="Show details information.">
        <a href="{{ route('products.index') }}" class="btn-custom btn-custom-outline-secondary" type="button">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </x-admin.phead>

    <div class="card">
        <div class="card-body">
            <div class="table-user-cell">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="Eleanor Pena" class="table-user-avatar">
                @else
                    <img src="https://placehold.net/product-400x400.png" alt="Eleanor Pena" class="table-user-avatar"
                        onerror="this.src = 'assets/images/avatar.png'">
                @endif
                <div>
                    <div class="h3">{{ $product->name }}</div>
                    {{-- <div class="h5 text-muted fw-normal">{{ $user->email }}</div> --}}
                </div>
            </div>
            <hr>
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Category:</strong> {{ $product->category->name }}</p>
            <p><strong>Brand:</strong> {{ $product->brand->name }}</p>
            <p><strong>Price:</strong> {{ $product->price }}</p>
        </div>
    </div>
@endsection
@extends('admin.layouts.master')

@section('title', 'Edit Product')


@section('content')
    <x-admin.phead title="Edit Product" subtitle="Update product information.">
        <a href="{{ route('users.index') }}" class="btn-custom btn-custom-secondary fw-bold" type="button">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
    </x-admin.phead>

    @if (session('success'))
        <div>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Product Name --}}
        <div class="mb-3">
            <label for="basicText" class="form-label-custom">Name</label>

            <input type="text" name="name" class="form-control-custom" id="basicText" placeholder="Enter product name"
                value="{{ old('name', $product->name) }}">

            <small class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category" class="form-label-custom">Category</label>

            <select name="category_id" id="category" class="form-control-custom">
                <option value="">Choose Category</option>

                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" @selected(old('category_id', $product->category_id) == $item->id)>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>

            <small class="text-danger">
                @error('category_id')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Brand --}}
        <div class="mb-3">
            <label for="brand" class="form-label-custom">Brand</label>

            <select name="brand_id" id="brand" class="form-control-custom">
                <option value="">Choose Brand</option>

                @foreach ($brands as $item)
                    <option value="{{ $item->id }}" @selected(old('brand_id', $product->brand_id) == $item->id)>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>

            <small class="text-danger">
                @error('brand_id')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label for="price" class="form-label-custom">Price</label>

            <input type="number" name="price" class="form-control-custom" id="price" placeholder="Enter price" step="0.01"
                value="{{ old('price', $product->price) }}">

            <small class="text-danger">
                @error('price')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Quantity --}}
        <div class="mb-3">
            <label for="quantity" class="form-label-custom">Quantity</label>

            <input type="number" name="quantity" class="form-control-custom" id="quantity" placeholder="Enter quantity"
                value="{{ old('quantity', $product->quantity) }}">

            <small class="text-danger">
                @error('quantity')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label-custom">Product Image</label>

            @if ($product->image)
                <div class="mb-2">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                </div>
            @endif

            <input type="file" name="image" class="form-control-custom" id="image" accept="image/*">

            <small class="text-danger">
                @error('image')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="active" class="form-label-custom">Status</label>

            <select name="active" id="active" class="form-control-custom">
                <option value="1" @selected(old('active', $product->active) == 1)>
                    Active
                </option>

                <option value="0" @selected(old('active', $product->active) == 0)>
                    Inactive
                </option>
            </select>

            <small class="text-danger">
                @error('active')
                    {{ $message }}
                @enderror
            </small>
        </div>

        {{-- Update Button --}}
        <div class="mb-3 text-end">
            <a href="{{ route('products.index') }}" class="btn-custom btn-custom-secondary me-1">
                Cancel
            </a>

            <button type="submit" class="btn-custom btn-custom-secondary">
                Update
            </button>
        </div>

    </form>



    </div>
    <!-- END: Basic Table Card Container -->
@endsection
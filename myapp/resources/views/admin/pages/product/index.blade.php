@extends('admin.layouts.master')

@section('title', 'Products')


@section('content')
    {{-- @php
    echo "
    <pre>";
                            print_r($products);
                            echo "</pre>";
    @endphp --}}
    <x-admin.phead title="Products" subtitle="Manage your products from this page.">
        <a href="{{ route('products.create') }}" class="btn-custom btn-custom-secondary fw-bold" type="button">
            <i class="bi bi-plus"></i> Add Product
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

    <!-- START: Basic Table Card Container -->
    <div class="table-card-custom">
        <!-- Header Controls -->
        <div class="table-header-control">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex flex-md-nowrap flex-wrap gap-2 w-100">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search products...">
                </div>
                <div class="input-group">
                    <label class="input-group-text"><i class="bi bi-funnel me-1"></i> Category</label>
                    <select name="category" class="form-select" id="inputGroupSelect01">
                        <option selected="" disabled>Choose...</option>
                        @foreach ($categories as $item)                             
                        <option value="{{ $item->id }}" @selected( request('category') == $item->id)> {{ $item->name }}</option>
                        @endforeach                        
                    </select>
                </div>
                <div class="input-group">
                    <label class="input-group-text"><i class="bi bi-funnel me-1"></i> Brand</label>
                    <select name="brand" class="form-select" id="inputGroupSelect01">
                        <option selected="" disabled>Choose...</option>
                        @foreach ($brands as $item)                             
                        <option value="{{ $item->id }}" @selected(request('brand') == $item->id)> {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Action buttons / Filter options -->
                <div class="table-filter-group">
                    <button class="btn-table-action" type="submit">
                        Search <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                <a href="{{ route('products.index') }}" class="btn-table-action me-2 text-nowrap">Clear Filters</a>
            </form>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            <td class="table-id">{{ $item->id }}</td>
                            <td>
                                <div class="table-user-cell">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="Eleanor Pena" class="table-user-avatar">
                                    @else
                                        <img src="https://placehold.net/product-400x400.png" alt="Eleanor Pena"
                                            class="table-user-avatar" onerror="this.src = 'assets/images/avatar.png'">
                                    @endif

                                    <div>
                                        <div class="table-user-name">{{ $item->name }}</div>
                                        {{-- <div class="table-user-sub">eleanor.pena@example.com</div> --}}
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($item->category)
                                    {{ $item->category->name }}
                                @endif
                            </td>
                            <td><span class="table-user-role">{{ $item->brand->name }}</span></td>
                            <td><span class="table-user-role">{{ $item->price }}</span></td>
                            <td><span class="table-user-role">{{ $item->quantity }}</span></td>
                            <td
                                class="text-center badge border {{ $item->active == 1 ? 'border-success text-success' : 'border-danger text-danger' }}">
                                <span class="table-user-role">{{ $item->active == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('products.show', ['product' => $item->id]) }}" class="table-btn-action"
                                        title="View details"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('products.edit', ['product' => $item->id]) }}" class="table-btn-action"
                                        title="Edit"><i class="bi bi-pencil"></i></a>
                                    {{-- <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="table-btn-action btn-delete" title="Delete"
                                            data-bs-toggle="modal" data-bs-target="#modalDelete" data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form> --}}
                                    <button type="button" class="table-btn-action delete" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No products found</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>

        <!-- Footer Controls / Pagination -->
        <div class="table-footer-control">
            {{ $products->links() }}
        </div>
    </div>
    <!-- END: Basic Table Card Container -->
    <x-admin.modal id="modalDelete" title="Delete Product">
        <div class="text-center">
            <i class="bi bi-trash fs-1 text-danger"></i>
            <p class="mt-2">Are you sure you want to delete this product?</p>
            <span class="name fw-bold badge border border-danger text-danger py-2 px-3">Mina</span>
            <hr>
            <form method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-outline-secondary me-1" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </x-admin.modal>
@endsection
@section('style')
    <style>
        .table-footer-control nav {
            width: 100%;
        }

        .table-footer-control nav div:last-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.dataset.id;
                let name = this.dataset.name;
                document.querySelector('#modalDelete .name').innerText = name;
                // document.querySelector('#modalDelete form').action = `/users/${id};
                document.querySelector('#modalDelete form').action = `{{ route('products.destroy', ['product' => ':id']) }}`.replace(':id', id);
            })
        })
    </script>
@endsection
@extends('admin.layouts.master')

@section('title', 'Products')

@section('content')
    <x-admin.phead title="Products" subtitle="Manage items from this page.">
        <a href="{{ route('products.create') }}" class="btn-custom btn-custom-secondary" type="button">
            <i class="bi bi-plus"></i> Add New
        </a>
    </x-admin.phead>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-card-custom">
        <!-- Header Controls -->
        <div class="table-header-control">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex flex-md-nowrap flex-wrap gap-2 w-100">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-custom" placeholder="Search products...">
                </div>
                <div class="input-group">
                    <label class="input-group-text"><i class="bi bi-funnel me-1"></i> Category</label>
                    <select class="form-select form-select-custom" name="category_id">
                        <option selected="" disabled>Choose...</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @selected(request('category_id') == $item->id)>{{ $item->name }}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <label class="input-group-text"><i class="bi bi-funnel me-1"></i> Brand</label>
                    <select class="form-select form-select-custom" name="brand_id">
                        <option selected="" disabled>Choose...</option>
                        @foreach ($brands as $item)
                            <option value="{{ $item->id }}" @selected(request('brand_id') == $item->id)>{{ $item->name }}</option>                            
                        @endforeach
                    </select>
                </div>
                <!-- Action buttons / Filter options -->
                <div class="table-filter-group ms-auto">
                    <button class="btn-table-action" type="submit">
                        Search <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                <a href="{{ route('products.index') }}" class="btn-table-action text-nowrap">Clear Filter</a>
            </form>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if ($item->image)
                                        <img src="{{ asset($item->image) }}" alt="" class="rounded-3" width="60"
                                            height="60">
                                    @else
                                        <img src="https://placehold.net/product-400x400.png" alt=""
                                            class="rounded-3" width="60" height="60">
                                    @endif
                                    <div>
                                        <h5 class="mb-0 fw-normal">{{ $item->name }}</h5>
                                        <p class="mb-0 text-muted">{{ $item->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($item->category)
                                    {{ $item->category->name }}
                                @endif
                            </td>
                            <td>{{ $item->brand->name ?? '-' }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <span
                                    class="badge border {{ $item->active == 1 ? 'border-success text-success' : 'border-danger text-danger' }}">
                                    {{ $item->active == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('users.show', ['user' => $item->id]) }}" class="table-btn-action"
                                        title="View details"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('users.edit', ['user' => $item->id]) }}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    {{-- <form action="{{ route('users.destroy', ['user' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="table-btn-action delete" title="Delete row"><i
                                                class="bi bi-trash"></i></button>
                                    </form> --}}
                                    <button type="button" class="table-btn-action delete" data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete" title="Delete row">
                                        <i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found.</td>
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

    <x-admin.modal id="modalDelete" title="Delete User">
        <div class="text-center">
            <i class="bi bi-trash fs-1 text-danger"></i>
            <p class="mt-2">Are you sure you want to delete this user?</p>
            <span class="name fw-bold badge border border-danger text-danger py-2 px-3"></span>
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
            button.addEventListener('click', function() {
                let id = this.dataset.id;
                let name = this.dataset.name;
                // alert(id);
                document.querySelector('#modalDelete .name').innerText = name;
                // document.querySelector('#modalDelete form').action = `/products/${id}`;
                document.querySelector('#modalDelete form').action =
                    `{{ route('products.destroy', ['product' => '_id']) }}`.replace('_id', id);
            })
        })
    </script>
@endsection

@extends('admin.layouts.master')

@section('title', 'Users')

@section('content')
    <x-admin.phead title="Users" subtitle="Manage items from this page.">
        <a href="{{ route('users.create') }}" class="btn-custom btn-custom-secondary" type="button">
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
            <!-- Search bar -->
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Search orders or products...">
            </div>
            <!-- Action buttons / Filter options -->
            <div class="table-filter-group">
                <div class="dropdown">
                    <button class="btn-table-action dropdown-toggle" type="button" id="dropdownFilterStatus"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Status Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                        <li><a class="dropdown-item" href="#">All Statuses</a></li>
                        <li><a class="dropdown-item" href="#">Paid / Success</a></li>
                        <li><a class="dropdown-item" href="#">Processing</a></li>
                        <li><a class="dropdown-item" href="#">Cancelled / Failed</a></li>
                    </ul>
                </div>
                <button class="btn-table-action" type="button">
                    <i class="bi bi-file-earmark-arrow-down"></i> Export
                </button>
            </div>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td class="table-order-id">{{ $item->id }}</td>
                            <td>
                                <div class="table-user-cell">
                                    <span
                                        class="table-user-avatar bg-brand-lime d-flex align-items-center justify-content-center text-lime fw-bold fs-5">{{ Str::substr($item->name, 0, 1) }}</span>
                                    <div>
                                        <div class="table-user-name">{{ $item->name }}</div>
                                        <div class="table-user-sub">{{ $item->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="table-product-name">{{ $item->role }}</td>
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
                                    @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <button type="button" class="table-btn-action delete" 
                                    data-id="{{ $item->id }}" 
                                    data-name="{{ $item->name }}" 
                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                     title="Delete row">
                                     <i class="bi bi-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer Controls / Pagination -->
        <div class="table-footer-control">
            {{ $users->links() }}
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
        button.addEventListener('click', function () {
            let id = this.dataset.id;
            let name = this.dataset.name;
            // alert(id);
            document.querySelector('#modalDelete .name').innerText = name;
            // document.querySelector('#modalDelete form').action = `/users/${id}`;
            document.querySelector('#modalDelete form').action = `{{ route('users.destroy', ['user' => '_id']) }}`.replace('_id', id);
        })
    })
</script>
@endsection

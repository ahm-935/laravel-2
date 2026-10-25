@extends('admin.layouts.master')

@section('title', 'User Management')

@section('content')

    {{-- Page Header --}}
    <div class="border px-3 py-3">
        <x-admin.phead
            title="Users"
            subtitle="Manage all users from this page."
        >
            <a href="{{ route('users.create') }}"
               class="btn btn-gradient-success">
                <i class="bi bi-plus"></i>
                Add New
            </a>
        </x-admin.phead>
    </div>
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    
    @endif

    <div class="card-body">

        <div class="container-fluid p-4">

            {{-- Header Controls --}}
            <div class="d-flex align-items-center gap-3 flex-nowrap user-controls">

                {{-- Search --}}
                <div class="search-box">

                    <i class="bi bi-search search-icon"></i>

                    <input
                        type="text"
                        id="userSearch"
                        class="form-control"
                        placeholder="Search users..."
                    >

                </div>


                {{-- Role Filter --}}
                <div class="dropdown flex-shrink-0">

                    <button
                        class="btn dropdown-toggle filter-btn"
                        type="button"
                        id="dropdownFilterRole"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="bi bi-funnel me-1"></i>
                        Role Filter
                    </button>

                    <ul
                        class="dropdown-menu"
                        aria-labelledby="dropdownFilterRole"
                    >

                        <li>
                            <a
                                class="dropdown-item role-filter"
                                href="#"
                                data-role="all"
                            >
                                All Roles
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item role-filter"
                                href="#"
                                data-role="Admin"
                            >
                                Admin
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item role-filter"
                                href="#"
                                data-role="Manager"
                            >
                                Manager
                            </a>
                        </li>

                        <li>
                            <a
                                class="dropdown-item role-filter"
                                href="#"
                                data-role="User"
                            >
                                User
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- Export --}}
                <button
                    class="btn export-btn flex-shrink-0"
                    type="button"
                    id="exportUsers"
                >
                    <i class="bi bi-file-earmark-arrow-down me-1"></i>
                    Export
                </button>

            </div>

        </div>


        {{-- Users Table --}}
        <div class="table-responsive">

            <table class="table" id="usersTable">

                <thead>

                    <tr>
                        <th class="fw-bold">ID</th>
                        <th class="fw-bold">Name</th>
                        <th class="fw-bold">Email</th>
                        <th class="fw-bold">Role</th>
                        <th class="fw-bold">Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse ($users as $item)

                        <tr class="user-row">

                            <td>
                                {{ $item->id }}
                            </td>

                            <td class="user-name">
                                {{ $item->name }}
                            </td>

                            <td class="user-email">
                                {{ $item->email }}
                            </td>

                            <td class="user-role">
                                {{ $item->role }}
                            </td>

                            <td class="text-center align-middle">

                                <div class="d-flex justify-content-start align-items-center gap-1">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('users.show', ['user' => $item->id]) }}"
                                        title="View details"
                                    >
                                        <i class="bi bi-eye-fill border text-success"></i>
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('users.edit', ['user' => $item->id]) }}"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil-square border text-info"></i>
                                    </a>


                                    {{-- Delete --}}
                                      @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <button
                                        type="button"
                                        class="delete border-0 bg-transparent p-0"
                                        title="Delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDelete"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->name }}"
                                    >
                                        <i class="bi bi-trash border text-danger"></i>
                                    </button>
                                    @endif
                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center py-4">
                                No users found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="table-footer-control">

            {{ $users->links() }}

        </div>

    </div>


    {{-- Delete Modal --}}
    <x-admin.modal
        id="modalDelete"
        title="Delete User"
    >

        <div class="text-center">

            <i class="bi bi-trash fs-1 text-danger"></i>

            <p class="mt-2">
                Are you sure you want to delete this user?
            </p>

            <span
                class="name fw-bold badge border border-danger text-danger py-2 px-3"
            >
                User
            </span>

            <hr>

            <form
                method="POST"
                id="deleteUserForm"
            >

                @csrf

                @method('DELETE')

                <button
                    type="button"
                    class="btn btn-outline-secondary me-1"
                    data-bs-dismiss="modal"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    Delete
                </button>

            </form>

        </div>

    </x-admin.modal>

@endsection


@section('style')

<style>

    /* ==============================
       Header Controls
    ============================== */

    .user-controls {
        width: 100%;
        background: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }


    /* ==============================
       Search Box
    ============================== */

    .search-box {
    position: relative;
    flex: 1;
    min-width: 250px;
    }

    .search-box .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 16px;
    z-index: 10;
    pointer-events: none;
    }

    .search-box .form-control {
    width: 100%;
    height: 42px;
    padding-left: 42px;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    box-shadow: none;
    }

    /* ==============================
       Filter Button
    ============================== */

    .filter-btn {
        height: 42px;
        padding: 0 16px;
        border: 1px solid #dee2e6;
        background-color: #ffffff;
        color: #343a40;
        white-space: nowrap;
    }

    .filter-btn:hover {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }


    /* ==============================
       Export Button
    ============================== */

    .export-btn {
        height: 42px;
        padding: 0 16px;
        border: 1px solid #dee2e6;
        background-color: #ffffff;
        color: #343a40;
        white-space: nowrap;
    }

    .export-btn:hover {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }


    /* ==============================
       Table
    ============================== */

    #usersTable th,
    #usersTable td {
        vertical-align: middle;
    }

    #usersTable tbody tr {
        height: 50px;
    }


    /* Action icons */

    #usersTable td i {
        padding: 2px 4px;
        font-size: 14px;
    }


    /* ==============================
       Pagination
    ============================== */

    .table-footer-control nav {
        width: 100%;
    }

    .table-footer-control nav > div:last-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }


    /* ==============================
       Mobile
    ============================== */

    @media (max-width: 768px) {

        .user-controls {
            flex-wrap: wrap !important;
        }

        .search-box {
            width: 100%;
            min-width: 100%;
        }

        .filter-btn,
        .export-btn {
            flex: 1;
        }

    }

</style>

@endsection


@section('script')

<script>

    /*
    |--------------------------------------------------------------------------
    | Delete User
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.delete').forEach(button => {

        button.addEventListener('click', function () {

            const id = this.dataset.id;
            const name = this.dataset.name;

            // Set user name
            document.querySelector(
                '#modalDelete .name'
            ).innerText = name;


            // Set delete URL
            const deleteUrl =
                `{{ route('users.destroy', ['user' => ':id']) }}`
                .replace(':id', id);

            document.querySelector(
                '#modalDelete form'
            ).action = deleteUrl;

        });

    });


    /*
    |--------------------------------------------------------------------------
    | User Search
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById('userSearch');

    searchInput.addEventListener('keyup', function () {

        const searchValue =
            this.value.toLowerCase().trim();

        document.querySelectorAll('.user-row').forEach(row => {

            const name =
                row.querySelector('.user-name')
                   .innerText
                   .toLowerCase();

            const email =
                row.querySelector('.user-email')
                   .innerText
                   .toLowerCase();

            const role =
                row.querySelector('.user-role')
                   .innerText
                   .toLowerCase();


            if (
                name.includes(searchValue) ||
                email.includes(searchValue) ||
                role.includes(searchValue)
            ) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Role Filter
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.role-filter').forEach(filter => {

        filter.addEventListener('click', function (event) {

            event.preventDefault();

            const selectedRole =
                this.dataset.role.toLowerCase();


            document.querySelectorAll('.user-row').forEach(row => {

                const role =
                    row.querySelector('.user-role')
                       .innerText
                       .trim()
                       .toLowerCase();


                if (
                    selectedRole === 'all' ||
                    role === selectedRole
                ) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        });

    });


</script>

@endsection
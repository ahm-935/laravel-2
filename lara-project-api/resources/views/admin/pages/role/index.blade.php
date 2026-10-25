@extends('admin.layouts.master')

@section('title', 'Roles')

@section('content')
    <x-admin.phead title="Roles" subtitle="Manage items from this page.">
        <a href="{{ route('roles.create') }}" class="btn-custom btn-custom-secondary" type="button">
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
                <input list="cities" type="search" class="table-search-input" placeholder="Search roles...">
                {{-- <datalist id="cities">
                    <option value="Mursalin">
                    <option value="Khairul">
                    <option value="Fahim">
                    <option value="Rion">
                    <option value="Arif">
                </datalist> --}}
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
                        <th>Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($roles as $item)
                        <tr>
                            <td class="table-order-id">
                                {{ $roles->firstItem() + $loop->index }}
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('roles.edit', ['role' => $item->id]) }}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                        <button type="button" class="table-btn-action delete" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete" title="Delete row">
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
            {{ $roles->links() }}
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
        function loadDelete() {
            document.querySelectorAll('.delete').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.dataset.id;
                    let name = this.dataset.name;
                    // alert(id);
                    document.querySelector('#modalDelete .name').innerText = name;
                    // document.querySelector('#modalDelete form').action = `/roles/${id}`;
                    document.querySelector('#modalDelete form').action =
                        `{{ route('roles.destroy', ['role' => '_id']) }}`.replace('_id', id);
                })
            })
        }
        loadDelete();
    </script>
    <script>
        let searchInput = $('.table-search-input');
        searchInput.on('input', function() {
            $.ajax({
                url: '{{ route('roles.search') }}',
                method: 'GET',
                data: {
                    search: $(this).val(),
                    // _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    // console.log(res.data);
                    let rows = res.data;
                    let html = '';
                    rows.forEach((item, i) => {
                        const editUrl = "{{ route('roles.edit', ['role' => ':id']) }}";
                        let url = editUrl.replace(':id', item.id);
                        html += `
                        <tr>
                            <td class="table-order-id">
                                ${i + 1}
                            </td>
                            <td>${item.name}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="${url}" class="table-btn-action"
                                        title="Edit row"><i class="bi bi-pencil"></i></a>
                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                        <button type="button" class="table-btn-action delete" data-id="${item.id}"
                                            data-name="${item.name}" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete" title="Delete row">
                                            <i class="bi bi-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        `;
                    });
                    $('#tbody').html(html);
                    loadDelete();
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });
    </script>
@endsection

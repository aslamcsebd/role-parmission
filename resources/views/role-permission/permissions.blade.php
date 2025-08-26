@extends('layouts.app')
@section('css')
    <style>
        .copy-permission {
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .copy-permission:hover {
            background-color: #e2e6ea;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pt-2">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12 px-0">
                <div class="card border border-danger">
                    <div class="card-header p-1">
                        <div class="row align-items-start g-0">
                            <div class="col-md-4 border-end pe-md-2 mb-4 mb-md-0">
                                <form action="{{ route('permission_category.store') }}" method="POST"
                                    class="row g-3 align-items-end">
                                    @csrf
                                    <div class="col-md-7">
                                        <label for="category" class="form-label fs-5 mb-0">Add permission category</label>
                                        <input type="text" name="permission_category" class="form-control py-1"
                                            placeholder="User management" required>
                                    </div>
                                    <div class="col-md-5 pt-md-4">
                                        <button type="submit" class="btn btn-success w-100 py-1">
                                            <i class="fa-solid fa-plus pe-1"></i>
                                            Add category
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8 ps-md-2">
                                <form action="{{ route('permissions.store') }}" method="POST"
                                    class="row g-3 align-items-end">
                                    @csrf
                                    <div class="col-md-4">
                                        <label for="permission_category_id" class="form-label fs-5 mb-0">Permission
                                            category</label>
                                        <select class="form-select py-1" name="permission_category_id" required>
                                            <option value="">Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="permission" class="form-label fs-5 mb-0">Permission name</label>
                                        <input type="text" name="permission" class="form-control py-1"
                                            placeholder="users.create, users.view" required>
                                    </div>
                                    <div class="col-md-3 pt-md-4">
                                        <button type="submit" class="btn btn-primary w-100 py-1">
                                            <i class="fa-solid fa-plus pe-1"></i>
                                            Add permission
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h5 class="card-header bg-success text-center p-1 mx-1 mt-1 text-light">All permissions</h5>
                    <div class="card-body px-1 py-0">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>
                                        <i class="fas fa-layer-group me-1 text-primary"></i>
                                        Category name
                                    </th>
                                    <th>
                                        <i class="fas fa-key me-1 text-success"></i>
                                        Permissions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="fw-semibold text-dark">
                                            <i class="fas fa-folder me-1 text-secondary"></i> {{ $category->name }}
                                            <span
                                                class="badge bg-secondary float-end">{{ $category->permissions->count() }}</span>
                                        </td>
                                        <td>
                                            @if ($category->permissions->isNotEmpty())
                                                @foreach ($category->permissions as $permission)
                                                    <span class="badge bg-light border text-dark me-1 copy-permission"
                                                        role="button" style="cursor: pointer;"
                                                        data-permission="{{ $permission->name }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Click to copy">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted fst-italic">No permissions added</span>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            No permission categories found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.copy-permission');

            elements.forEach(el => {
                const tooltip = new bootstrap.Tooltip(el);

                // Copy on click
                el.addEventListener('click', function() {
                    const text = this.getAttribute('data-permission');

                    navigator.clipboard.writeText(text).then(() => {
                        this.setAttribute('data-bs-original-title', 'Copied!');
                        tooltip.show();

                        setTimeout(() => {
                            this.setAttribute('data-bs-original-title',
                                'Click to copy');
                            tooltip.hide();
                        }, 1000);
                    });
                });
            });
        });
    </script>
@endsection

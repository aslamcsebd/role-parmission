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
        <div class="row justify-content-center">
            <div class="col-md-12 px-0">
                <div class="card border border-danger">
                    <div class="card-header p-1">
                        <div class="row align-items-start g-0">
                            <div class="col-md-4 border-end pe-md-2 mb-4 mb-md-0">
                                <form action="{{ route('permission_categories.store') }}" method="POST"
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
                                        <select class="form-select py-1" id="permission_category_id"
                                            name="permission_category_id" required>
                                            <option value="">Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" data-name="{{ $category->name }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="permission" class="form-label fs-5 mb-0">Permission name</label>
                                        <input type="text" id="permission" name="permission" class="form-control py-1"
                                            placeholder="create.users, view.users" required>
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
                                    <th class="center" width="3%">Sl</th>
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
                                    <tr >
                                        <td class="center">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold text-dark">
                                            <i class="fas fa-folder me-1 text-secondary"></i> {{ $category->name }}
                                            <span class="badge bg-secondary float-end">{{ $category->permissions->count() }}</span>
                                        </td>
                                        <td>
                                            @if ($category->permissions->isNotEmpty())
                                                @foreach ($category->permissions as $permission)
                                                    <span class="badge border border-primary text-dark fs-6 fw-normal me-1 copy-permission"
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
        // After select category
        document.getElementById('permission_category_id').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let categoryName = selectedOption.getAttribute('data-name');

            if (categoryName) {
                // Convert to lowercase and replace spaces with underscores
                categoryName = categoryName.toLowerCase().replace(/\s+/g, '_');

                let input = document.getElementById('permission');
                input.value = "." + categoryName;

                // Place cursor at the beginning (before the dot)
                setTimeout(() => {
                    input.focus();
                    input.setSelectionRange(0, 0);
                }, 50);
            } else {
                document.getElementById('permission').value = '';
            }
        });

        // Copy permission
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

        // DataTable
        $(document).ready(function() {
            var table = $('.table').DataTable({
                "pageLength": -1,
                "lengthMenu": [
                    [-1],
                    ["All"]
                ],
                // "order": [[0, "desc"]] 
            });
        });
    </script>
@endsection

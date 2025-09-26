@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-2">
        <div class="row justify-content-center">
            <div class="col-md-12 px-0">
                <div class="card border border-danger">
                    <div class="card-header p-1 mb-1">
                        <form action="{{ route('roles.store') }}" method="POST" class="d-flex align-items-start">
                            @csrf
                            <input type="text" name="name" class="form-control me-2 py-1 border border-primary w-auto"
                                placeholder="Role name [User, Editor]" required>
                            <button type="submit" class="btn btn-primary py-1">
                                <i class="fa-solid fa-plus pe-1"></i>
                                Create role
                            </button>
                        </form>
                    </div>
                    <h5 class="card-header bg-success text-center p-1 mx-1 mt-1 text-light">All Roles</h5>
                    <div class="card-body px-1 py-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="center" width="4%">Sl</th>
                                    <th>Role name</th>
                                    <th class="center" width="8%">Total user</th>
                                    <th class="center" width="12%">Total permissions</th>
                                    <th class="center" width="10%">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $role->name }}</td>
                                        <td class="align-middle center">
                                            <a href="{{ route('user_roles.index', ['role_name' => $role->name]) }}">
                                                <span class="badge text-bg-warning px-3 copy-permission"
                                                    title="Click to view {{ $role->name }}">
                                                    {{ $role->users->count() }}
                                                </span>
                                            </a>
                                        </td>
                                        <td class="align-middle center">
                                            <span class="badge bg-light border text-dark">
                                                {{ $role->permissions->count() }}
                                            </span>
                                        </td>
                                        <td class="center">
                                            <a href="{{ route('roles.edit_permissions', $role->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa-regular fa-pen-to-square pe-1"></i>
                                                Edit Permissions
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () =>
            document.querySelectorAll('.copy-permission').forEach(el => new bootstrap.Tooltip(el))
        );
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-2">
        @if (session('success'))
            <div style="color:green">{{ session('success') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12 px-0">
                <div class="card border border-danger">
                    <h5 class="card-header bg-success text-center p-1 mx-1 mt-1 text-light">User role</h5>
                    <div class="card-body px-1 py-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="center">Sl</th>
                                    <th class="">Name</th>
                                    <th class="">Email</th>
                                    <th class="center">Current role</th>
                                    <th class="center">Assign new role</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td class="align-middle">{{ $user->email }}</td>
                                        <td class="center align-middle">
                                            @if ($user->roles->isNotEmpty())
                                                {{ $user->roles->pluck('name')->implode(', ') }}
                                            @else
                                                <em>No role assigned</em>
                                            @endif
                                        </td>
                                        <form method="POST" action="{{ route('role.assignRole') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <td class="text-center align-middle">
                                                <div class="d-inline-block">
                                                    <select name="role_id" class="form-select w-auto py-1">
                                                        <option value="">Select role</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                {{ $user->roles->contains($role) ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="submit" class="btn btn-sm btn-outline-success">
													<i class="fa-regular fa-pen-to-square pe-1"></i>
													Update
												</button>
												<button>Delete</button>
                                            </td>
                                        </form>
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

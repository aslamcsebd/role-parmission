<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ url('/home') }}" class="brand-link">
            <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">AdminLTE 4</span>
        </a>
    </div>

	@php
		$check = 'fa-check-circle';
	@endphp

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Role & Permission</li>
                <li class="nav-item">
                    <a href="{{ url('user-role') }}" class="nav-link {{ request()->is('user-role') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular {{ request()->is('user-role') ? $check : 'fa-circle text-success' }}"></i>
                        <p class="text">User role</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('roles') }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular {{ request()->is('roles') ? $check : 'fa-circle text-danger' }}"></i>
                        <p class="text">Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('permissions') }}" class="nav-link {{ request()->is('permissions') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular {{ request()->is('permissions') ? $check : 'fa-circle text-info' }}"></i>
                        <p class="text">Permissions</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

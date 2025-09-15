<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ url('/home') }}" class="brand-link">
            <i class="fa-solid fa-user-lock"></i>
            <span class="brand-text fw-light">Role & parmission</span>
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
                    <a href="{{ route('user_roles.index') }}"
                        class="nav-link {{ request()->routeIs('user_roles.index') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular {{ request()->routeIs('user_roles.index') ? $check : 'fa-circle text-success' }}"></i>
                        <p class="text">User role</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('roles.index') }}"
                        class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular {{ request()->routeIs('roles.index') ? $check : 'fa-circle text-danger' }}"></i>
                        <p class="text">Roles</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}"
                        class="nav-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular {{ request()->routeIs('permissions.index') ? $check : 'fa-circle text-info' }}"></i>
                        <p class="text">Permissions</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

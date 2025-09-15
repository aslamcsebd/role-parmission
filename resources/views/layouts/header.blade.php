<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="fa-solid fa-bars"></i>
                </a> 
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/default.jpg') }}" class="user-image rounded-circle shadow" alt="User Image">
                    <span class="d-none d-md-inline">
                        {{ Auth::user()->name }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('images/default.jpg') }}" class="rounded-circle shadow" alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since  {{ date('M. Y', strtotime(Auth::user()->created_at)) }}</small>
                        </p>
                    </li>
                    <li class="user-footer"> 
                        <a href="#" class="btn btn-sm btn-outline-primary btn-flat">
                            <i class="fa-solid fa-gear me-1"></i>
                            Profile
                        </a> 
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger btn-flat float-end" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-power-off me-1"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
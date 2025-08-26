<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="fa-solid fa-bars"></i>
                </a> 
            </li>
            <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
            <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"> 
                <a class="nav-link" data-widget="navbar-search" href="#" role="button"> 
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a> 
            </li>

            <li class="nav-item dropdown"> 
                <a class="nav-link" data-bs-toggle="dropdown" href="#"> 
                    <i class="fa-regular fa-comment-dots"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> 
                    <a href="#" class="dropdown-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0"> 
                                <img src="{{ asset('images/default.jpg') }}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title"> Brad Diesel
                                    <span class="float-end fs-7 text-danger">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">Call me whenever you can...</p>
                                <p class="fs-7 text-secondary"> 
                                    <i class="fa-solid fa-clock me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div> 
                    <a href="#" class="dropdown-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0"> 
                                <img src="{{ asset('images/default.jpg') }}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title"> John Pierce
                                    <span class="float-end fs-7 text-secondary"> 
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">I got your message bro</p>
                                <p class="fs-7 text-secondary"> 
                                    <i class="fa-solid fa-clock me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0"> 
                                <img src="{{ asset('images/default.jpg') }}" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title"> Nora Silvester
                                    <span class="float-end fs-7 text-warning"> 
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                </h3>
                                <p class="fs-7">The subject goes here</p>
                                <p class="fs-7 text-secondary">
                                    <i class="fa-solid fa-clock me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"> See All Messages </a>
                </div>
            </li>
            <li class="nav-item dropdown"> 
                <a class="nav-link" data-bs-toggle="dropdown" href="#"> 
                    <i class="fa-solid fa-bell"></i> 
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> 
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"> 
                        <i class="fa-regular fa-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span> 
                    </a>
                    <div class="dropdown-divider"></div>                    
                    <a href="#" class="dropdown-item"> 
                        <i class="fa-solid fa-user-group me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div> 
                    <a href="#" class="dropdown-item"> 
                        <i class="fa-solid fa-file me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span> 
                    </a>
                    <div class="dropdown-divider"></div> 
                    <a href="#" class="dropdown-item dropdown-footer">
                        See All Notifications
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen"> 
                    <i data-lte-icon="maximize" class="fa-solid fa-expand"></i> 
                    <i data-lte-icon="minimize" class="fa-solid fa-compress" style="display: none;"></i>
                </a>
            </li>
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
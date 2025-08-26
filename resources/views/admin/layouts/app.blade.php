<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler-vendors.min.css" rel="stylesheet"/>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/>

    <style>
        /* Sidebar text putih */
        .navbar-vertical .navbar-nav .nav-link,
        .navbar-vertical .navbar-nav .nav-link .nav-link-title,
        .navbar-vertical .navbar-brand {
            color: #fff !important;
        }

        /* Icon sidebar putih */
        .navbar-vertical .navbar-nav .nav-link .nav-link-icon i {
            color: #fff !important;
        }

        /* Hover & active effect */
        .navbar-vertical .navbar-nav .nav-link:hover,
        .navbar-vertical .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff !important;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                </h1>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="fas fa-home"></i></span>
                                <span class="nav-link-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.destinations.index') }}">
                                <span class="nav-link-icon"><i class="fas fa-map-marked-alt"></i></span>
                                Destinations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.news.index') }}">
                                <span class="nav-link-icon"><i class="fas fa-newspaper"></i></span>
                                News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.reviews.index') }}">
                                <span class="nav-link-icon"><i class="fas fa-star"></i></span>
                                Reviews
                            </a>
                        </li>

                        <li class="nav-item mt-3">
                            <li class="nav-item">
                                <a class="nav-link text-info" href="{{ url('/') }}" target="_blank">
                                    <span class="nav-link-icon"><i class="fas fa-globe"></i></span>
                                    Back to Site
                                </a>
                            </li>
                            <a class="nav-link text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="nav-link-icon"><i class="fas fa-sign-out-alt"></i></span>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </aside>

        <!-- Page wrapper -->
        <div class="page-wrapper">
            <!-- Page header -->
            <header class="navbar navbar-expand-md navbar-light d-print-none">
                <div class="container-xl">
                    <div class="navbar-nav flex-row order-md-last">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                                <span class="avatar avatar-sm" style="background-image: url('https://ui-avatars.com/api/?name={{ Auth::user()->name }}')"></span>
                                <div class="d-none d-xl-block ps-2">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="mt-1 small text-muted">Admin</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="#" class="dropdown-item">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form-top').submit();">
                                   Logout
                                </a>
                                <form id="logout-form-top" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl mt-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js"></script>
</body>
</html>

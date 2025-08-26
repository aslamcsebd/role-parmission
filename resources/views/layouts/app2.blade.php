<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')
    <style>
        .card {
            margin-top: 2rem !important;
        }
        .card .card-header {
            color: #fff !important;
            background-color: #17a2b8 !important;
            font-size: 1.5rem;
            padding: .4rem 1.25rem;
        }
        .card label {
            font-size: 1.15rem !important;
        }
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            width: 100%;
            display: block;
        }
    </style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('layouts.header2')

        <main class="app-main">
            <div class="app-content">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>

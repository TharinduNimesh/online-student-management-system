<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_csrf" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/styles/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@@sweetalert2/theme-dark@5.0.2/dark.min.css">
    <link rel="stylesheet" href="/styles/main.css" />
    <title>
        @yield('title') | SchoolPlus
    </title>
</head>
<body>
    <div class="container-fluid p-0">
        @yield('content')
    </div>

    <script src="/scripts/jquery-min.js"></script>
    <script src="/scripts/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/scripts/main.js"></script>
    @yield('scripts')
</body>
</html>

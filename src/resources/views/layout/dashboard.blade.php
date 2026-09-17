<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administração | VS Cuidadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="d-flex min-vh-100">
        @include('partials.admin.menu-lateral')
        <main class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h1 class="h3 mb-0">@yield('title', 'Administração')</h1>
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('home') }}">Ver site</a>
            </div>
            @if (session('sucesso')) <div class="alert alert-success">{{ session('sucesso') }}</div> @endif
            @if (session('erro')) <div class="alert alert-danger">{{ session('erro') }}</div> @endif
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

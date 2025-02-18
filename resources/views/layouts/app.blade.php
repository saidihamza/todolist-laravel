<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'To-Do List')</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Ajoutez le CDN de SweetAlert2 dans la balise <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Barre de navigation avec fond rouge et icône -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2b3f56;">
        <div class="container">
            <!-- Icône (image) et nom de l'application à gauche -->
            <a class="navbar-brand" href="{{ route('tasks.index') }}">
                <img src="{{ asset('images/todolist-icon.png') }}" alt="To-Do List Icon" width="30" height="30" class="d-inline-block align-top">
            </a>
            
            <!-- Nom de l'utilisateur connecté -->
            @auth
                <span class="navbar-text text-light ms-3">
                    Bienvenue, {{ Auth::user()->name }}!
                </span>
            @endauth
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

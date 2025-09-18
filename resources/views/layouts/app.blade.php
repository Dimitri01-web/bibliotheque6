<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="">Bibliothèque</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('livres.index')}}">Livres</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('auteurs.index')}}">Auteurs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Catégories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('membres.index') }}">Membres</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('emprunts.index') }}">Emprunts</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('rapports.index')}}">Rapports</a></li>


            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

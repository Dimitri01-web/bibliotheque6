@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du livre</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title">{{ $livre->titre }}</h3>
            <p><strong>Auteur :</strong> {{ $livre->auteur->nom ?? 'Inconnu' }}</p>
            <p><strong>Catégorie :</strong> {{ $livre->categorie->nom ?? 'Non classée' }}</p>
            <p><strong>ISBN :</strong> {{ $livre->isbn }}</p>
            <p><strong>Année de publication :</strong> {{ $livre->annee_publication }}</p>
            <p>
                <strong>Disponibilité :</strong>
                @if ($livre->disponible)
                    <span class="badge bg-success">Disponible</span>
                @else
                    <span class="badge bg-danger">Indisponible</span>
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('livres.destroy', $livre) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Supprimer ce livre ?')">Supprimer</button>
    </form>
</div>
@endsection

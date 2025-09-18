@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Livres</h1>
    <a href="{{ route('livres.create') }}" class="btn btn-primary">Ajouter un livre</a>
</div>

{{-- Formulaire de recherche --}}
    <form action="{{ route('livres.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text"
                   name="q"
                   class="form-control"
                   placeholder="Rechercher par titre, ISBN ou année..."
                   value="{{ old('q', $q ?? '') }}">
            <button class="btn btn-primary">Rechercher</button>
        </div>
    </form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($livres as $livre)
        <tr>
            <td><a href="{{ route('livres.show', $livre) }}">{{ $livre->titre }}</a></td>
            <td>{{ $livre->auteur->nom ?? 'N/A' }}</td>
            <td>{{ $livre->categorie->nom ?? 'N/A' }}</td>

            <td>
                <a href="{{ route('livres.show', $livre) }}" class="btn btn-sm btn-info">Voir</a>
                <a href="{{ route('livres.edit', $livre) }}" class="btn btn-sm btn-warning">Modifier</a>

                <form action="{{ route('livres.destroy', $livre) }}" method="POST" style="display:inline-block"
                      onsubmit="return confirm('Supprimer ce livre ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4">Aucun livre trouvé.</td></tr>
    @endforelse
    </tbody>
</table>

{{-- Pagination avec conservation du mot clé --}}
    {{ $livres->withQueryString()->links() }}
@endsection

@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Catégories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Ajouter une catégorie</a>
</div>

{{-- Formulaire de recherche --}}
    <form action="{{ route('categories.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text"
                   name="q"
                   class="form-control"
                   placeholder="Rechercher par nom"
                   value="{{ old('q', $q ?? '') }}">
            <button class="btn btn-primary">Rechercher</button>
        </div>
    </form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($categories as $categorie)
        <tr>
            <td><a href="{{ route('categories.show', $categorie) }}">{{ $categorie->nom }}</a></td>
            <td>
                <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('categories.destroy', $categorie) }}" method="POST" style="display:inline-block"
                      onsubmit="return confirm('Supprimer cette catégorie ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="2">Aucune catégorie trouvée.</td></tr>
    @endforelse
    </tbody>
</table>

{{ $categories->links() }}
@endsection

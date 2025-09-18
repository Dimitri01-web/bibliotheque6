@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Auteurs</h1>
    <a href="{{route('auteurs.create')}}" class="btn btn-primary">Ajouter un auteur</a>
</div>
{{-- Formulaire de recherche --}}
    <form action="{{ route('auteurs.index') }}" method="GET" class="mb-3">
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
    @forelse($auteurs as $auteur)
        <tr>
            <td><a href="{{ route('auteurs.show', $auteur) }}">{{ $auteur->nom }}</a></td>
            <td>
                <a href="{{ route('auteurs.edit', $auteur) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('auteurs.destroy', $auteur) }}" method="POST" style="display:inline-block"
                      onsubmit="return confirm('Supprimer cet auteur ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="2">Aucun auteur trouvé.</td></tr>
    @endforelse
    </tbody>
</table>

{{-- Pagination avec conservation du mot clé --}}
{{ $auteurs->withQueryString()->links() }}@endsection

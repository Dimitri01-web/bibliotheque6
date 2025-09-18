@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'auteur</h1>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire d'édition --}}
    <form action="{{ route('auteurs.update', $auteur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'auteur</label>
            <input
                type="text"
                class="form-control"
                id="nom"
                name="nom"
                value="{{ old('nom', $auteur->nom) }}"
                required
            >
        </div>

        <div class="mb-3">
            <label for="biographie" class="form-label">Biographie</label>
            <textarea
                class="form-control"
                id="biographie"
                name="biographie"
                rows="4"
            >{{ old('biographie', $auteur->biographie) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

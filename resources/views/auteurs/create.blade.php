@extends('layouts.app')

@section('content')
<h1>Ajouter un auteur</h1>

<form method="POST" action="{{ route('auteurs.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l'auteur</label>
        <input type="text" name="nom" id="nom"
               class="form-control @error('nom') is-invalid @enderror"
               value="{{ old('nom') }}" required>
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-success">Enregistrer</button>
    <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection

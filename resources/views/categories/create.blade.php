@extends('layouts.app')

@section('content')
<h1>Ajouter une catégorie</h1>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de la catégorie</label>
        <input type="text" name="nom" id="nom"
               class="form-control @error('nom') is-invalid @enderror"
               value="{{ old('nom') }}" required>
        @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-success">Enregistrer</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection

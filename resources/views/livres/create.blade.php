@extends('layouts.app')

@section('content')
<h1>Ajouter un livre</h1>

<form method="POST" action="{{ route('livres.store') }}">
    @csrf

    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror"
               value="{{ old('titre') }}" required>
        @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="auteur_id" class="form-label">Auteur</label>
        <select name="auteur_id" id="auteur_id" class="form-select @error('author_id') is-invalid @enderror" required>
            <option value="">-- Sélectionnez un auteur --</option>
            @foreach($auteurs as $auteur)
                <option value="{{ $auteur->id }}" {{ old('auteur_id') == $auteur->id ? 'selected' : '' }}>
                    {{ $auteur->nom }}
                </option>
            @endforeach
        </select>
        @error('auteur_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="categorie_id" class="form-label">Catégorie</label>
        <select name="categorie_id" id="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror" required>
            <option value="">-- Sélectionnez une catégorie --</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
            @endforeach
        </select>
        @error('categorie_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror"
               value="{{ old('isbn') }}" required>
        @error('isbn')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="annee_publication" class="block font-semibold">Année de publication :</label>
        <input type="number" name="annee_publication" id="annee_publication" placeholder="Ex: 2023" value="{{ old('annee_publication') }}" class="w-full border p-2">
        @error('annee_publication')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="disponible" class="block text-gray-700">Disponible :</label>
        <input type="checkbox" name="disponible" id="disponible" value="1" {{ old('disponible') ? 'checked' : '' }}>

        @error('disponible')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>




    <button class="btn btn-success">Enregistrer</button>
    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection

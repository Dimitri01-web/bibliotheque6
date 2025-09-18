@extends('layouts.app')

@section('content')
<h1>Modifier le livre</h1>

<form method="POST" action="{{route('livres.update',$livre)}}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control @error('titre') is-invalid @enderror"
               value="{{ old('titre', $livre->titre) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="auteur_id" class="form-label">Auteur</label>
        <select name="auteur_id" id="auteur_id" class="form-select @error('auteur_id') is-invalid @enderror" required>
            <option value="">-- Sélectionnez un auteur --</option>
            @foreach($auteurs as $auteur)
                <option value="{{ $auteur->id }}" {{ (old('auteur_id', $livre->auteur_id) == $auteur->id) ? 'selected' : '' }}>
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
                <option value="{{ $categorie->id }}" {{ (old('categorie_id', $livre->categorie_id) == $categorie->id) ? 'selected' : '' }}>
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
               value="{{ old('isbn', $livre->isbn) }}" required>
        @error('isbn')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="annee_publication" class="form-label">Année de publication</label>
        <input type="text" name="annee_publication" id="titre" class="form-control @error('annee_publication') is-invalid @enderror"
               value="{{ old('annee_publication', $livre->annee_publication) }}" required>
        @error('annee_publication')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>





    <button class="btn btn-primary">Mettre à jour</button>
    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
</form>
@endsection

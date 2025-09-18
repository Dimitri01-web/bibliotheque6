@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l’emprunt</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('emprunts.update', $emprunt) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="livre_id" class="form-label">Livre</label>
            <select name="livre_id" id="livre_id" class="form-select">
                @foreach($livres as $livre)
                    <option value="{{ $livre->id }}" @if($livre->id == $emprunt->livre_id) selected @endif>
                        {{ $livre->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="membre_id" class="form-label">Membre</label>
            <select name="membre_id" id="membre_id" class="form-select">
                @foreach($membres as $membre)
                    <option value="{{ $membre->id }}" @if($membre->id == $emprunt->membre_id) selected @endif>
                        {{ $membre->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_emprunt" class="form-label">Date emprunt</label>
            <input type="date" name="date_emprunt" id="date_emprunt" class="form-control"
                   value="{{ $emprunt->date_emprunt }}">
        </div>

        <div class="mb-3">
            <label for="date_retour_prevue" class="form-label">Date retour prévue</label>
            <input type="date" name="date_retour_prevue" id="date_retour_prevue" class="form-control"
                   value="{{ $emprunt->date_retour_prevue }}">
        </div>

        <div class="mb-3">
            <label for="date_retour_effective" class="form-label">Date retour effective</label>
            <input type="date" name="date_retour_effective" id="date_retour_effective" class="form-control"
                   value="{{ $emprunt->date_retour_effective}}">
        </div>

        <button class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

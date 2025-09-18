@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouvel emprunt</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('emprunts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="livre_id" class="form-label">Livre</label>
            <select name="livre_id" id="livre_id" class="form-select">
                @foreach($livres as $livre)
                    <option value="{{ $livre->id }}">{{ $livre->titre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="membre_id" class="form-label">Membre</label>
            <select name="membre_id" id="membre_id" class="form-select">
                @foreach($membres as $membre)
                    <option value="{{ $membre->id }}">{{ $membre->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_emprunt" class="form-label">Date emprunt</label>
            <input type="date" name="date_emprunt" id="date_emprunt" class="form-control">
        </div>

        <div class="mb-3">
            <label for="date_retour_prevue" class="form-label">Date retour prévue</label>
            <input type="date" name="date_retour_prevue" id="date_retour_prevue" class="form-control">
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

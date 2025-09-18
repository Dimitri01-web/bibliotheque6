@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rapports d’emprunts</h1>

    <h3>Par période</h3>
    <form action="{{ route('rapports.emprunts.periode') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col">
                <input type="date" name="date_debut" class="form-control" required>
            </div>
            <div class="col">
                <input type="date" name="date_fin" class="form-control" required>
            </div>
            <div class="col">
                <button class="btn btn-primary">Afficher</button>
            </div>
        </div>
    </form>

    <h3>Par catégorie</h3>
    <form action="{{ route('rapports.emprunts.categorie') }}" method="GET" class="mb-4">
        <select name="categorie_id" class="form-select" required>
            <option value="">Choisir une catégorie</option>
            @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary mt-2">Afficher</button>
    </form>

    <h3>Par membre</h3>
    <form action="{{ route('rapports.emprunts.membre') }}" method="GET">
        <select name="membre_id" class="form-select" required>
            <option value="">Choisir un membre</option>
            @foreach ($membres as $membre)
                <option value="{{ $membre->id }}">{{ $membre->nom }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary mt-2">Afficher</button>
    </form>
</div>
@endsection

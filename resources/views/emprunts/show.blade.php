@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l’emprunt</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Livre :</strong> {{ $emprunt->livre->titre ?? 'Livre inconnu' }}</p>
            <p><strong>Membre :</strong> {{ $emprunt->membre->nom ?? 'Membre inconnu' }}</p>
            <p><strong>Date d’emprunt :</strong> {{ $emprunt->date_emprunt }}</p>
            <p><strong>Date de retour prévue :</strong> {{ $emprunt->date_retour_prevue }}</p>
            <p><strong>Date de retour réelle :</strong> {{ $emprunt->date_retour_reelle ?? 'Non retourné' }}</p>

            <p>
                <strong>Statut :</strong>
                @if ($emprunt->date_retour_reelle)
                    <span class="badge bg-success">Retourné</span>
                @else
                    <span class="badge bg-warning">En cours</span>
                @endif
            </p>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('emprunts.index') }}" class="btn btn-secondary">Retour à la liste</a>
        <a href="{{ route('emprunts.edit', $emprunt) }}" class="btn btn-warning">Modifier</a>

        <form action="{{ route('emprunts.destroy', $emprunt) }}" method="POST" onsubmit="return confirm('Supprimer cet emprunt ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>
</div>
@endsection

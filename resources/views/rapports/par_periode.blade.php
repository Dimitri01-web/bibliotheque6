@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rapport d’emprunts du {{ $dateDebut }} au {{ $dateFin }}</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Livre</th>
                <th>Membre</th>
                <th>Date emprunt</th>
                <th>Date retour prévue</th>
                <th>Date retour effective</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emprunts as $emprunt)
                <tr>
                    <td>{{ $emprunt->livre->titre }}</td>
                    <td>{{ $emprunt->membre->nom }}</td>
                    <td>{{ $emprunt->date_emprunt }}</td>
                    <td>{{ $emprunt->date_retour_prevue }}</td>
                    <td>{{ $emprunt->date_retour_effective ?? 'Pas encore retourné' }}</td>
                </tr>
            @empty
                <tr><td colspan="5">Aucun emprunt trouvé pour cette période.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('rapports.index') }}" class="btn btn-secondary">Retour aux rapports</a>
</div>
@endsection

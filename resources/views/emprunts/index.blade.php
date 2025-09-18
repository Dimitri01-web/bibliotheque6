@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des emprunts</h1>
    <a href="{{ route('emprunts.create') }}" class="btn btn-primary mb-3">Nouvel emprunt</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Livre</th>
                <th>Membre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emprunts as $emprunt)
                <tr>
                    <td>{{ $emprunt->livre->titre ?? 'Livre supprimé' }}</td>
                    <td>{{ $emprunt->membre->nom ?? 'Membre supprimé' }}</td>
                    <td>
                        <a href="{{ route('emprunts.show', $emprunt) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('emprunts.edit', $emprunt) }}" class="btn btn-warning btn-sm">Modifier</a>
                        @if(!$emprunt->date_retour_effective)
                            <form action="{{ route('emprunts.retour', $emprunt) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Confirmer le retour du livre ?')">Retourner</button>
                            </form>
                        @endif
                        <form action="{{ route('emprunts.destroy', $emprunt) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet emprunt ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Aucun emprunt enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $emprunts->links() }}
</div>
@endsection

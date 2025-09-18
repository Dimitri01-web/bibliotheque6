@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des membres</h1>
    <a href="{{route('membres.create')}}" class="btn btn-primary mb-3">Ajouter un membre</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Date d’adhésion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($membres as $membre)
                <tr>
                    <td>{{ $membre->nom }}</td>
                    <td>{{ $membre->email }}</td>
                    <td>{{ $membre->telephone }}</td>
                    <td>{{ $membre->date_adhesion ? \Carbon\Carbon::parse($membre->date_adhesion)->format('d/m/Y') : '-' }}</td>
                    <td>
                        <a href="{{route('membres.edit',$membre)}}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{route('membres.destroy',$membre)}}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce membre ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Aucun membre trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $membres->links() }}
</div>
@endsection

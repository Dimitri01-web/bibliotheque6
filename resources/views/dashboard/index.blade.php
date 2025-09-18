@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tableau de bord</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Livres</h5>
                    <p class="display-6">{{ $totalLivres }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Emprunts</h5>
                    <p class="display-6">{{ $totalEmprunts }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Retours</h5>
                    <p class="display-6">{{ $totalRetours }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Membres actifs</h5>
                    <p class="display-6">{{ $membresActifs }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

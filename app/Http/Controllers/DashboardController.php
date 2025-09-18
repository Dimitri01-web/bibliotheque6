<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Emprunt;
use App\Models\Membre;

class DashboardController extends Controller
{
    public function index()
    {
        // Nombre total de livres
        $totalLivres = Livre::count();

        // Nombre total d’emprunts
        $totalEmprunts = Emprunt::count();

        // Nombre total de retours (emprunts rendus)
        $totalRetours = Emprunt::whereNotNull('date_retour_effective')->count();

        // Nombre de membres actifs (qui ont au moins un emprunt en cours)
        $membresActifs = Membre::whereHas('emprunts', function($q) {
            $q->whereNull('date_retour_effective');
        })->count();

        return view('dashboard.index', compact(
            'totalLivres',
            'totalEmprunts',
            'totalRetours',
            'membresActifs'
        ));
    }
}

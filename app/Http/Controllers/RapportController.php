<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Categorie;
use App\Models\Membre;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    /**
     * Page d'accueil des rapports (menu ou formulaire).
     */
    public function index()
    {
        $categories = Categorie::all();
        $membres = Membre::all();

        return view('rapports.index', compact('categories', 'membres'));
    }

    /**
     * Rapports d’emprunts par période.
     */
    public function parPeriode(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
        ]);

        $emprunts = Emprunt::with(['livre', 'membre'])
            ->whereBetween('date_emprunt', [$validated['date_debut'], $validated['date_fin']])
            ->orderBy('date_emprunt', 'asc')
            ->get();

        return view('rapports.par_periode', [
            'emprunts'   => $emprunts,
            'dateDebut'  => $validated['date_debut'],
            'dateFin'    => $validated['date_fin'],
        ]);
    }

    /**
     * Rapports d’emprunts par catégorie.
     */
    public function parCategorie(Request $request)
    {
        $validated = $request->validate([
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $emprunts = Emprunt::with(['livre', 'membre'])
            ->whereHas('livre', function ($query) use ($validated) {
                $query->where('categorie_id', $validated['categorie_id']);
            })
            ->orderBy('date_emprunt', 'desc')
            ->get();

        return view('rapports.par_categorie', [
            'emprunts'  => $emprunts,
            'categorie' => Categorie::find($validated['categorie_id']),
        ]);
    }

    /**
     * Rapports d’emprunts par membre.
     */
    public function parMembre(Request $request)
    {
        $validated = $request->validate([
            'membre_id' => 'required|exists:membres,id',
        ]);

        $emprunts = Emprunt::with(['livre', 'membre'])
            ->where('membre_id', $validated['membre_id'])
            ->orderBy('date_emprunt', 'desc')
            ->get();

        return view('rapports.par_membre', [
            'emprunts' => $emprunts,
            'membre'   => Membre::find($validated['membre_id']),
        ]);
    }
}

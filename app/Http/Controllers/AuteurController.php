<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    /**
     * Afficher la liste des auteurs.
     */
    //public function index()
    //{
    //    $auteurs = Auteur::all(); // Récupérer tous les auteurs
    //    return view('auteurs.index', compact('auteurs'));
    //}

    public function index(Request $request)
    {
        $query = Auteur::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nom', 'like', "%{$search}%");
        }

        $auteurs = $query->paginate(10);

        return view('auteurs.index', compact('auteurs'));
    }

    /**
     * Afficher le formulaire de création d'un auteur.
     */
    public function create()
    {
        return view('auteurs.create');
    }

    /**
     * Enregistrer un nouvel auteur dans la base de données.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Auteur::create($validated);

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur créé avec succès.');
    }

    /**
     * Afficher un auteur spécifique.
     */
    public function show(Auteur $auteur)
    {
        return view('auteurs.show', compact('auteur'));
    }

    /**
     * Afficher le formulaire d’édition d’un auteur existant.
     */
    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', compact('auteur'));
    }

    /**
     * Mettre à jour un auteur existant dans la base de données.
     */
    public function update(Request $request, Auteur $auteur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $auteur->update($validated);

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur mis à jour avec succès.');
    }

    /**
     * Supprimer un auteur de la base de données.
     */
    public function destroy(Auteur $auteur)
    {
        $auteur->delete();

        return redirect()->route('auteurs.index')
                         ->with('success', 'Auteur supprimé avec succès.');
    }
}

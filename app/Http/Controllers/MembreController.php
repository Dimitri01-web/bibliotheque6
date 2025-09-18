<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Afficher la liste des membres.
     */
    public function index()
    {
        $membres = Membre::orderBy('nom')->paginate(10);
        return view('membres.index', compact('membres'));
    }

    /**
     * Afficher le formulaire de création d’un membre.
     */
    public function create()
    {
        return view('membres.create');
    }

    /**
     * Enregistrer un nouveau membre.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'          => 'required|string|max:255',
            'email'        => 'required|email|unique:membres,email',
            'telephone'    => 'nullable|string|max:20',
            'adresse'      => 'nullable|string|max:255',
            'date_adhesion'=> 'nullable|date',
        ]);

        Membre::create($request->all());

        return redirect()->route('membres.index')->with('success', 'Membre ajouté avec succès.');
    }

    /**
     * Afficher les détails d’un membre.
     */
    public function show(Membre $membre)
    {
        return view('membres.show', compact('membre'));
    }

    /**
     * Afficher le formulaire d’édition d’un membre.
     */
    public function edit(Membre $membre)
    {
        return view('membres.edit', compact('membre'));
    }

    /**
     * Mettre à jour un membre existant.
     */
    public function update(Request $request, Membre $membre)
    {
        $request->validate([
            'nom'          => 'required|string|max:255',
            'email'        => 'required|email|unique:membres,email,' . $membre->id,
            'telephone'    => 'nullable|string|max:20',
            'adresse'      => 'nullable|string|max:255',
            'date_adhesion'=> 'nullable|date',
        ]);

        $membre->update($request->all());

        return redirect()->route('membres.index')->with('success', 'Membre mis à jour avec succès.');
    }

    /**
     * Supprimer un membre.
     */
    public function destroy(Membre $membre)
    {
        $membre->delete();

        return redirect()->route('membres.index')->with('success', 'Membre supprimé avec succès.');
    }
}


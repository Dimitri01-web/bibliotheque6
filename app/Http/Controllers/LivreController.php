<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Auteur;
use App\Models\Categorie;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Afficher la liste des livres, avec option de recherche.
     */
    public function index(Request $request)
    {
        $query = Livre::with(['auteur', 'categorie']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('titre', 'like', "%{$search}%")
                  ->orWhereHas('auteur', function ($q) use ($search) {
                      $q->where('nom', 'like', "%{$search}%");
                  })
                  ->orWhereHas('categorie', function ($q) use ($search) {
                      $q->where('nom', 'like', "%{$search}%");
                  });
        }

        $livres = $query->paginate(10);

        return view('livres.index', compact('livres'));
    }

    /**
     * Afficher le formulaire de création d’un livre.
     */
    public function create()
    {
        $auteurs = Auteur::all();
        $categories = Categorie::all();
        return view('livres.create', compact('auteurs', 'categories'));
    }

    /**
     * Enregistrer un nouveau livre dans la base de données.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur_id' => 'required|exists:auteurs,id',
            'categorie_id' => 'required|exists:categories,id',
            'isbn' => 'required|string|max:20|unique:livres,isbn',
            'annee_publication' => 'required|integer',
            'disponible' => 'boolean',
        ]);

        Livre::create($validated);

        return redirect()->route('livres.index')
                         ->with('success', 'Livre créé avec succès.');
    }

    /**
     * Afficher les détails d’un livre spécifique.
     */
    public function show(Livre $livre)
    {
        return view('livres.show', compact('livre'));
    }

    /**
     * Afficher le formulaire d’édition d’un livre existant.
     */
    public function edit(Livre $livre)
    {
        $auteurs = Auteur::all();
        $categories = Categorie::all();
        return view('livres.edit', compact('livre', 'auteurs', 'categories'));
    }

    /**
     * Mettre à jour un livre existant dans la base de données.
     */
    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur_id' => 'required|exists:auteurs,id',
            'categorie_id' => 'required|exists:categories,id',
            'isbn' => 'required|string|max:20|unique:livres,isbn,' . $livre->id,
            'annee_publication' => 'required|integer',
            'disponible' => 'boolean',
        ]);

        $livre->update($validated);

        return redirect()->route('livres.index')
                         ->with('success', 'Livre mis à jour avec succès.');
    }

    /**
     * Supprimer un livre de la base de données.
     */
    public function destroy(Livre $livre)
    {
        $livre->delete();

        return redirect()->route('livres.index')
                         ->with('success', 'Livre supprimé avec succès.');
    }
}

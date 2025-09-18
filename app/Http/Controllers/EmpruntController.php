<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\Membre;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    /**
     * Afficher la liste des emprunts.
     */
    public function index()
    {
        $emprunts = Emprunt::with(['livre', 'membre'])
            ->orderByDesc('date_emprunt')
            ->paginate(10);

        return view('emprunts.index', compact('emprunts'));
    }

    /**
     * Afficher le formulaire pour créer un nouvel emprunt.
     */
    public function create()
    {
        $livres = Livre::where('disponible', true)->get(); // seulement les livres dispo
        $membres = Membre::all();

        return view('emprunts.create', compact('livres', 'membres'));
    }

    /**
     * Enregistrer un nouvel emprunt.
     */
    public function store(Request $request)
    {
        $request->validate([
            'livre_id'           => 'required|exists:livres,id',
            'membre_id'          => 'required|exists:membres,id',
            'date_emprunt'       => 'required|date',
            'date_retour_prevue' => 'required|date|after_or_equal:date_emprunt',
        ]);

        $livre = Livre::findOrFail($request->livre_id);

        if (!$livre->disponible) {
            return back()->withErrors(['livre_id' => 'Ce livre n’est pas disponible pour le moment.']);
        }

        Emprunt::create([
            'livre_id'           => $request->livre_id,
            'membre_id'          => $request->membre_id,
            'date_emprunt'       => $request->date_emprunt,
            'date_retour_prevue' => $request->date_retour_prevue,
        ]);

        // Mettre à jour la disponibilité du livre
        $livre->update(['disponible' => false]);

        return redirect()->route('emprunts.index')->with('success', 'Emprunt enregistré avec succès.');
    }

    /**
     * Afficher les détails d’un emprunt.
     */
    public function show(Emprunt $emprunt)
    {
        $emprunt->load(['livre', 'membre']);
        return view('emprunts.show', compact('emprunt'));
    }

    /**
     * Afficher le formulaire pour modifier un emprunt.
     */
    public function edit(Emprunt $emprunt)
    {
        $livres = Livre::all();
        $membres = Membre::all();

        return view('emprunts.edit', compact('emprunt', 'livres', 'membres'));
    }

    /**
     * Mettre à jour un emprunt existant.
     */
    public function update(Request $request, Emprunt $emprunt)
    {
        $request->validate([
            'livre_id'           => 'required|exists:livres,id',
            'membre_id'          => 'required|exists:membres,id',
            'date_emprunt'       => 'required|date',
            'date_retour_prevue' => 'required|date|after_or_equal:date_emprunt',
            'date_retour_reelle' => 'nullable|date',
        ]);

        $emprunt->update($request->all());

        return redirect()->route('emprunts.index')->with('success', 'Emprunt mis à jour avec succès.');
    }

    /**
     * Supprimer un emprunt.
     */
    public function destroy(Emprunt $emprunt)
    {
        // Si le livre est encore emprunté, le remettre dispo
        if (!$emprunt->date_retour_reelle) {
            $livre = $emprunt->livre;
            if ($livre) {
                $livre->update(['disponible' => true]);
            }
        }

        $emprunt->delete();

        return redirect()->route('emprunts.index')->with('success', 'Emprunt supprimé avec succès.');
    }

    /**
     * Marquer un emprunt comme retourné.
     */
    public function retour(Emprunt $emprunt)
    {
        if ($emprunt->date_retour_effective) {
            return back()->with('info', 'Cet emprunt est déjà retourné.');
        }

        $emprunt->update([
            'date_retour_effective' => now(),
        ]);

        // Remettre le livre disponible
        $livre = $emprunt->livre;
        if ($livre) {
            $livre->update(['disponible' => true]);
        }

        return redirect()->route('emprunts.index')->with('success', 'Livre marqué comme retourné.');
    }
}

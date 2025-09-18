<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory;

    /**
     * Les colonnes qui peuvent être remplies en masse.
     */
    protected $fillable = [
        'livre_id',
        'membre_id',
        'date_emprunt',
        'date_retour_prevue',
        'date_retour_effective',
    ];

    /**
     * Les colonnes qui doivent être transformées en date (Carbon).
     */
    protected $dates = [
        'date_emprunt',
        'date_retour_prevue',
        'date_retour_effective',
    ];

    /**
     * Relation : un emprunt appartient à un livre.
     */
    public function livre()
    {
        return $this->belongsTo(Livre::class);
    }

    /**
     * Relation : un emprunt appartient à un membre.
     */
    public function membre()
    {
        return $this->belongsTo(Membre::class);
    }

    /**
     * Vérifie si l’emprunt est en retard.
     */
    public function estEnRetard(): bool
    {
        if (!$this->date_retour_effective && $this->date_retour_prevue) {
            return now()->isAfter($this->date_retour_prevue);
        }
        return false;
    }
}

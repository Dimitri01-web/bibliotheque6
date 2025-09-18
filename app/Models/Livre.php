<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'auteur_id', 'categorie_id', 'isbn', 'annee_publication', 'disponible'];

public function auteur() {
return $this->belongsTo(Auteur::class);
}

public function categorie() {
return $this->belongsTo(Categorie::class);
}
}

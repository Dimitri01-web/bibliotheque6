<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;
 protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'date_adhesion',
    ];
    public function emprunts() {
return $this->hasMany(Emprunt::class);
}
}

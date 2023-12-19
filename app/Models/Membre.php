<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payer;

class Membre extends Model
{
    protected $table = 'membres';

    protected $primaryKey = 'membre_id';

    protected $fillable = [
        'nom', 'prenom', 'sexe', 'contact', 'photo',
    ];

    public function payers()
    {
        return $this->hasMany(Payer::class, 'membre_id');
    }

    // Vous pouvez ajouter d'autres relations ou méthodes si nécessaire
}

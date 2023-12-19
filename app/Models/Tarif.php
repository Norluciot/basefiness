<?php

// App/Models/Tarif.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payer;

class Tarif extends Model
{
    protected $table = 'tarifs';

    protected $primaryKey = 'tarif_id';

    protected $fillable = [
        'activite', 'prix_unitaire',
    ];

    // Relation avec la table Payer
    public function payers()
    {
        return $this->hasMany(Payer::class, 'tarif_id');
    }

    // Autres relations ou méthodes si nécessaire

}

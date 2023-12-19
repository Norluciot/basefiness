<?php

// app/Models/Acheter.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acheter extends Model
{
    protected $table = 'acheter';
    protected $primaryKey = 'acheter_id';

    protected $fillable = [
         'type_client', 'produit_id', 'date_achat', 'quantite_achete','total_achete',
        // Ajoutez d'autres colonnes spécifiques à la table "acheter" ici
    ];


    public function getClientTypeAttribute()
    {
        return $this->attributes['type_client'];
    }

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}

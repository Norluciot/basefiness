<?php

// app/Models/Produit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Acheter;

class Produit extends Model
{
    protected $table = 'produits';

    protected $primaryKey = 'produit_id';

    protected $fillable = [
        'designation',
        'quantite_stock',
        'prix_unitaire',
        // Ajoutez d'autres champs au besoin
    ];

    // Relation avec la table des commandes (exemple)
    public function achats()
    {
        return $this->hasMany(Acheter::class, 'produit_id');
    }

    // Vous pouvez ajouter d'autres relations avec d'autres tables étrangères au besoin
}

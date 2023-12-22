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
    // Dans le modèle Membre.php
    public function getLastPaymentDetailsAttribute()
    {
        $latestPayment = $this->payers()->latest()->first();

        if ($latestPayment) {
            return [
                'date_debut' => $latestPayment->date_debut,
                'date_fin' => $latestPayment->date_fin,
                'statut' => $latestPayment->statut,
            ];
        } else {
            return [
                'date_debut' => null,
                'date_fin' => null,
                'statut' => null,
            ];
        }
    }



    // Vous pouvez ajouter d'autres relations ou méthodes si nécessaire
}

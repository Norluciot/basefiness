<?php

// app/Models/Payer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payer extends Model
{
    protected $table = 'payers';
    protected $dates = [
        'date_debut',
        'date_fin',];

    protected $primaryKey = 'payer_id';

    protected $fillable = ['date_paiement', 'type_client', 'membre_id', 'visiteur_id', 'tarif_id', 'date_debut', 'date_fin', 'quantite_paye', 'total_paye', 'statut'];


    // Relations avec d'autres modèles
    public function membre()
    {
        return $this->belongsTo(Membre::class, 'membre_id');
    }

    public function visiteur()
    {
        return $this->belongsTo(Visiteur::class, 'visiteur_id');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id');
    }
    public function getRouteKeyName()
    {
        return 'payer_id';
    }
    // Dans le modèle Payer
    public function getDateFinAttribute($value)
    {
    return $value ? Carbon::parse($value) : null;
    }

}



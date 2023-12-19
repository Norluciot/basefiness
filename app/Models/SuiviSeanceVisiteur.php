<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuiviSeanceVisiteur extends Model
{
    protected $table = 'suivi_seances_visiteurs';

    protected $fillable = [
        'visiteur_id', 'payer_id', 'date_seance','seances_payees' ,'a_fait_seance', 'seance_gratuite_utilisee',
    ];

    // Relation avec la table des visiteurs
    public function visiteur()
    {
        return $this->belongsTo(Visiteur::class, 'visiteur_id');
    }

    // Relation avec la table des payers
    public function payer()
    {
        return $this->belongsTo(Payer::class, 'payer_id');
    }
    public function getSeancesGratuitesAttribute()
{
    return $this->seance_gratuite_utilisee;
}
}

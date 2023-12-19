<?php

// App/Models/Visiteur.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payer;
use App\Models\SuiviSeanceVisiteur;

class Visiteur extends Model
{
    protected $table = 'visiteurs';
    protected $primaryKey = 'visiteur_id';

    protected $fillable = [
        'visiteur_nom', 'visiteur_sexe', 'photo',
    ];

    // Les relations avec d'autres modèles si nécessaire.
    public function payers()
    {
        return $this->hasMany(Payer::class, 'visiteur_id');
    }
    public function suiviSeances()
    {
        return $this->hasOne(SuiviSeanceVisiteur::class, 'visiteur_id');
    }
    public function suivi_seances_visiteur()
    {
        return $this->hasMany(SuiviSeanceVisiteur::class, 'visiteur_id');
    }
    // Ajoutez d'autres relations ou méthodes si nécessaire
}

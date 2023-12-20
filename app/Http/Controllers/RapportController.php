<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payer;
use App\Models\Acheter;

class RapportController extends Controller
{
    public function rapportJournalier(Request $request)
    {
        // Récupérer la date à partir de la requête ou utiliser la date actuelle par défaut
        $date = $request->input('date', now()->toDateString());

        // Effectuer la requête pour récupérer les recettes pour la date spécifiée
        $recettesPayer = Payer::whereDate('date_paiement', $date)->sum('total_paye');
        $recettesAcheter = Acheter::whereDate('date_achat', $date)->sum('total_achete');

        // Autres opérations ou logique que vous souhaitez effectuer

        // Passer les données à la vue
        $data = [
            'recettesPayer' => $recettesPayer,
            'recettesAcheter' => $recettesAcheter,
            'date' => $date,
        ];

        // Retourner la vue avec les données
        return view('report.rapport', $data);
    }


    private function calculerRecetteJournaliere()
    {
        // Récupérer la date actuelle (aujourd'hui)
        $aujourdHui = now()->format('Y-m-d');

        // Récupérer le total payé pour aujourd'hui
        $totalPaye = Payer::whereDate('date_paiement', $aujourdHui)->sum('total_paye');

        // Récupérer le total acheté pour aujourd'hui
        $totalAchete = Acheter::whereDate('date_achat', $aujourdHui)->sum('total_achete');

        // Calculer la recette journalière en additionnant les totaux
        $recetteJournaliere = $totalPaye + $totalAchete;

        // Retourner les données sous forme de tableau associatif
        return [
            'date' => $aujourdHui,
            'total_paye' => $totalPaye,
            'total_achete' => $totalAchete,
            'recette_journaliere' => $recetteJournaliere,
        ];
    }






}

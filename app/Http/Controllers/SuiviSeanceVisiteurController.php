<?php

namespace App\Http\Controllers;

use App\Models\SuiviSeanceVisiteur;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuiviSeanceVisiteurController extends Controller
{
    public function index(Request $request)
{
    $query = Visiteur::query();

    // Recherche par nom de visiteur
    if ($request->has('search')) {
        $query->where('visiteur_nom', 'like', '%' . $request->input('search') . '%');
    }

    $visiteurs = $query->get();

    return view('suivi_seances_visiteurs.index', compact('visiteurs'));
}

    public function create()
    {
        // Code pour afficher le formulaire de création
    }

    public function store(Request $request)
    {
        $request->validate([
            'seances_payees.*.*.id' => 'required|exists:suivi_seances_visiteurs,id',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->seances_payees as $visiteurId => $seances) {
                $hasZeroSeances = false;

                foreach ($seances as $suiviId => $data) {
                    $suiviSeance = SuiviSeanceVisiteur::find($data['id']);

                    if ($suiviSeance) {
                        // Vérifiez si la case a été cochée avant d'accéder à 'isChecked'
                        $isChecked = isset($data['isChecked']) ? $data['isChecked'] : false;

                        $suiviSeance->a_fait_seance = $isChecked;
                        $suiviSeance->save();

                        // Vérifiez si seances_payees est égal à 0 et a_fait_seance est true
                        if ($suiviSeance->seances_payees == 0 && $isChecked) {
                            $hasZeroSeances = true;
                        }
                    }
                }

                // Si $hasZeroSeances est vrai, supprimez toutes les séances associées à ce visiteur
                if ($hasZeroSeances) {
                    SuiviSeanceVisiteur::where('visiteur_id', $visiteurId)->delete();
                }
            }
        });

        return redirect()->route('suivi_seances_visiteurs.index')->with('success', 'Les séances ont été enregistrées avec succès.');
    }












    public function show(SuiviSeanceVisiteur $suiviSeanceVisiteur)
    {
        // Code pour afficher un suivi de séance spécifique
    }

    public function edit(SuiviSeanceVisiteur $suiviSeanceVisiteur)
    {
        // Code pour afficher le formulaire d'édition
    }

    public function update(Request $request, SuiviSeanceVisiteur $suiviSeanceVisiteur)
    {
        // Code pour mettre à jour un suivi de séance
    }

    public function destroy(SuiviSeanceVisiteur $suiviSeanceVisiteur)
    {
        // Code pour supprimer un suivi de séance
    }
}

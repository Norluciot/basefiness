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
                $counter = 0; // Initialiser le compteur à zéro
                $seancesToDelete = []; // Tableau pour stocker les ID des séances à supprimer

                foreach ($seances as $suiviId => $data) {
                    $suiviSeance = SuiviSeanceVisiteur::find($data['id']);

                    if ($suiviSeance) {
                        $isChecked = isset($data['isChecked']) ? $data['isChecked'] : false;

                        if ($isChecked) {
                            $counter++; // Incrémenter le compteur si la case est cochée

                            if ($counter == 10) {
                                // Ajouter les ID des neuf séances précédentes à supprimer
                                $seancesToDelete = array_slice(array_keys($seances), 0, 10);
                            } else {
                                // Mettre à jour la séance
                                $suiviSeance->update([
                                    'a_fait_seance' => true,
                                    'seance_gratuite_utilisee' => false, // Assurez-vous que la séance gratuite n'est pas encore utilisée
                                ]);
                            }
                        }
                    }
                }

                // Supprimer les neuf séances précédentes si la dixième case est cochée
                if ($counter == 10) {
                    SuiviSeanceVisiteur::where('visiteur_id', $visiteurId)
                        ->whereIn('id', $seancesToDelete)
                        ->delete();
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

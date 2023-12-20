<?php

namespace App\Http\Controllers;

use App\Models\Payer;
use App\Models\Membre;
use App\Models\Visiteur;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\SuiviSeanceVisiteur;


class PayerController extends Controller
{
    public $data;
    public function index(Request $request)
    {
        $query = Payer::query();

        // Filtrer par date de paiement si spécifié dans la requête
        if ($request->has('date_paiement')) {
            $query->whereDate('date_paiement', $request->date_paiement);
        }

        $payers = $query->get();

        // Assurez-vous que $visiteurs est défini avant de le passer à la vue
        $visiteurs = Visiteur::all();

        return view('payer.index', compact('payers', 'visiteurs'));
    }


    public function create()
    {
        $membres = Membre::all();
        $visiteurs = Visiteur::all();
        $tarifs = Tarif::all();

        $this->data = [
            "membres" => $membres,
            "visiteurs" => $visiteurs,
            "tarifs" => $tarifs
        ];

        return view('payer.create', $this->data);
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
            'date_paiement' => ['required', 'date'],
            'type_client' => ['required', 'in:membre,visiteur'],
            // 'membre_id' => ['required_if:type_client,membre', 'exists:membres,membre_id'],
            // 'visiteur_id' => ['required_if:type_client,visiteur', 'exists:visiteurs,visiteur_id'], // Ajout de la validation pour visiteur_id
            'activite' => ['required', 'exists:tarifs,tarif_id'],
            'quantite_paye' => ['required', 'integer', 'min:1'],
            // 'date_debut' => ['required_if:type_client,membre', 'date'],
        ]);
    }

    public function store(Request $request)
    {
        // Utilisez le validateur pour valider les données
        $validator = $this->validator($request->all());

        // Si la validation échoue, redirigez avec les erreurs
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obtenir le tarif à partir de la base de données en utilisant l'ID
        $tarif = Tarif::findOrFail($request->activite);

        // Initialiser les valeurs par défaut
        $membreId = null;
        $dateDebut = null;
        $dateFin = null;

        // Vérifier le type de client
        if ($request->type_client === 'membre')
            {
                $membreId = $request->membre_id;
                $dateDebut = $request->date_debut;

                // Ajouter une logique pour calculer la date de fin en fonction de l'activité
                if ($tarif->activite === 'Abonnement Mensuel') {
                    $dateFin = Carbon::parse($dateDebut)->addDays(30);
                } elseif ($tarif->activite === 'Abonnement Semestriel') {
                    $dateFin = Carbon::parse($dateDebut)->addMonths(6);
                } elseif ($tarif->activite === 'Abonnement Annuel') {
                    $dateFin = Carbon::parse($dateDebut)->addYear();
                }
                $payer = Payer::create([
                    'date_paiement' => $request->date_paiement,
                    'type_client' => $request->type_client,
                    'membre_id' => $membreId,
                    'visiteur_id' => $request->visiteur_id,
                    'tarif_id' => $request->activite,
                    'date_debut' => $dateDebut,
                    'date_fin' => $dateFin,
                    'quantite_paye' => $request->quantite_paye,
                    'total_paye' => $request->quantite_paye * $tarif->prix_unitaire,
                    'statut' => Carbon::parse($dateDebut)->isFuture() ? 'Actif' : 'Expire',
                ]);

                return redirect('/payer')->with('success', 'Paiement enregistré avec succès!')->setStatusCode(302);

            }

        if ($request->type_client === 'visiteur')
            {
                $membreId = $request->visiteur_id;

                $payer = Payer::create([
                    'date_paiement' => $request->date_paiement,
                    'type_client' => $request->type_client,
                    'membre_id' => $membreId,
                    'visiteur_id' => $request->visiteur_id,
                    'tarif_id' => $request->activite,
                    'date_debut' => $dateDebut,
                    'date_fin' => $dateFin,
                    'quantite_paye' => $request->quantite_paye,
                    'total_paye' => $request->quantite_paye * $tarif->prix_unitaire,
                    'statut' => Carbon::parse($dateDebut)->isFuture() ? 'Actif' : 'Expire',
                ]);
                for ($i = 0; $i < $request->quantite_paye; $i++) {
                    SuiviSeanceVisiteur::create([
                        'visiteur_id' => $request->visiteur_id,
                        'payer_id' => $payer->id,
                        'date_seance' => now(), // Vous pouvez ajuster la date selon vos besoins
                        'seances_payees' => 1,
                        'a_fait_seance' => false,
                        'seance_gratuite_utilisee' => false,
                    ]);
                }
                $this->gererSeances(Visiteur::findOrFail($request->visiteur_id), $request->quantite_paye);
                return redirect('/suivi-seances-visiteurs')->with('success', 'Paiement enregistré avec succès!')->setStatusCode(302);
            }

        // Création d'un paiement


        // Enregistrement des séances payées dans la table suivi_seances_visiteurs


        // Gérer les séances pour le visiteur


        // Redirection vers la page de confirmation ou toute autre action souhaitée
        return redirect('/payer')->with('success', 'Paiement enregistré avec succès!')->setStatusCode(302);
    }




    public function show(Payer $payer)
    {
        return view('payer.show', compact('payer'));
    }

    public function edit(Payer $payer)
    {
        $membres = Membre::all();
        $visiteurs = Visiteur::all();
        $tarifs = Tarif::all();
        return view('payer.edit', compact('payer', 'membres', 'visiteurs', 'tarifs'));
    }

    public function update(Request $request, Payer $payer)
    {
        $request->validate([
            'membre_id' => 'required_without:visiteur_id|exists:membres,membre_id',
            'visiteur_id' => 'required_without:membre_id|exists:visiteurs,visiteur_id',
            'tarif_id' => 'required|exists:tarifs,id',
            'date_paiement' => 'required|date',
            'type_paiement' => 'required|in:espece,mobile_money',
        ]);

        // Effectue des opérations spécifiques en fonction du type de paiement, membre ou visiteur, etc.

        $payer->update($request->all());

        return redirect()->route('payer.index')->with('success', 'Paiement mis à jour avec succès!');
    }

    public function destroy(Payer $payer)
    {

        $payer->delete();

        return redirect()->route('payer.index')->with('success', 'Paiement supprimé avec succès!');
    }

    protected function gererSeances(Visiteur $visiteur, $quantitePayee)
    {
        // Récupérer le total des séances payées par le visiteur
        $totalSeancesPayees = $visiteur->payers()->sum('quantite_paye');

        // Mettre à jour la propriété seances_payees dans la table Suivi_seances_visiteur
        $suiviSeance = $visiteur->suivi_seances_visiteur()->latest()->first();

        // Mettre à jour le champ seances_payees avec la somme totale des séances payées
        $suiviSeance->update(['seances_payees' => $totalSeancesPayees]);

        // Vérifier si le visiteur a atteint ou dépassé la 9e séance payée
        if ($totalSeancesPayees >= 9) {
            // Attribuer une séance gratuite pour la prochaine séance
            $lastPayer = $visiteur->payers()->latest()->first();

            SuiviSeanceVisiteur::create([
                'visiteur_id' => $visiteur->visiteur_id,
                'payer_id' => $lastPayer->id,
                'date_seance' => now(), // Vous pouvez ajuster la date selon vos besoins
                'seances_payees' => $totalSeancesPayees - 9, // Le visiteur a une séance gratuite
                'a_fait_seance' => false, // Par défaut, le visiteur n'a pas encore fait la séance
                'seance_gratuite_utilisee' => false, // Par défaut, le visiteur n'a pas encore utilisé de séance gratuite
            ]);

            // Réinitialiser le compteur de séances payées dans la table Payer
            $lastPayer->update(['quantite_paye' => 0]);
        } else {
            // Aucune action spécifique nécessaire ici, car le champ seances_payees a déjà été mis à jour
        }
    }









}


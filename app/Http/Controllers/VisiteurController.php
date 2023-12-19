<?php

namespace App\Http\Controllers;

use App\Models\Visiteur;
use Illuminate\Http\Request;
use App\Models\Payer;
use Illuminate\Support\Facades\DB;

class VisiteurController extends Controller
{
    // Afficher la liste des visiteurs
    public function index(Request $request)
    {
        $query = $request->input('nom');

        // Si une requête de recherche est présente, filtrez les visiteurs en conséquence
        if ($query) {
            $visiteurs = Visiteur::where('visiteur_nom', 'like', '%' . $query . '%')->get();
        } else {
            // Si aucune requête de recherche, récupérez tous les visiteurs
            $visiteurs = Visiteur::all();
        }

        return view('visiteurs.index', compact('visiteurs'));
    }




    // Afficher le formulaire de création
    public function create()
    {
        return view('visiteurs.create');
    }

    // Stocker un nouveau visiteur
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'visiteur_nom' => 'required',
            'visiteur_sexe' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Enregistrement du visiteur
        $visiteur = Visiteur::create([
            'visiteur_nom' => $request->visiteur_nom,
            'visiteur_sexe' => $request->visiteur_sexe,
        ]);

        // Traitement de la photo s'il y en a une
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            // Assurez-vous que le fichier est une image
            if ($photo->isValid()) {
                $fileName = time() . '_' . $photo->getClientOriginalName();

                // Stockez le fichier dans le répertoire de stockage approprié
                $photo->storeAs('public/photos', $fileName);

                // Mettez à jour le champ 'photo' dans la base de données
                $visiteur->update(['photo' => $fileName]);
            } else {
                // En cas d'échec de validation de l'image
                return redirect()->route('visiteurs.create')->with('error', 'Le fichier photo n\'est pas valide.');
            }
        }

        // Redirection avec un message
        return redirect()->route('visiteurs.index')->with('success', 'Visiteur ajouté avec succès!');
    }

    // Afficher un visiteur spécifique
    public function show(Visiteur $visiteur)
    {
        return view('visiteurs.show', compact('visiteur'));
    }

    // Afficher le formulaire d'édition
    public function edit(Visiteur $visiteur)
    {
        return view('visiteurs.edit', compact('visiteur'));
    }

    // Mettre à jour un visiteur spécifique
// Mettre à jour un visiteur spécifique
public function update(Request $request, Visiteur $visiteur)
{
    // Validation des données du formulaire
    $request->validate([
        'visiteur_nom' => 'required',

    ]);

    // Mise à jour des données du visiteur existant
    $visiteur->update([
        'visiteur_nom' => $request->visiteur_nom,
        'visiteur_sexe' => $request->visiteur_sexe,
    ]);


    // Traitement de la photo s'il y en a une
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $fileName = time() . '_' . $photo->getClientOriginalName();
        $photo->storeAs('public/photos', $fileName);
        $visiteur->update(['photo' => $fileName]);
    }

    // Redirection avec un message
    return redirect()->route('visiteurs.index')->with('success', 'Visiteur mis à jour avec succès!');
}

    // Supprimer un visiteur spécifique
    public function destroy(Visiteur $visiteur)
    {
        $visiteur->delete();

        // Redirection avec un message
        return redirect()->route('visiteurs.index')->with('success', 'Visiteur supprimé avec succès!');
    }

    private function countVisiteurs()
    {
        return Visiteur::count();
    }


}

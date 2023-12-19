<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Payer;
use Illuminate\Http\Request;

class MembreController extends Controller
{
  
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Si une requête de recherche est présente, filtrez les membres en conséquence
        if ($query) {
            $resultats = Membre::where('nom', 'like', '%' . $query . '%')
                ->orWhere('prenom', 'like', '%' . $query . '%')
                ->get();

            return view('membres.index', compact('resultats'));
        }

        // Sinon, récupérez tous les membres
        $membres = Membre::all();
        return view('membres.index', compact('membres'));
    }

    // MembreController.php

    // Afficher le formulaire de création
    public function create()
    {
        return view('membres.create');
    }

    // Stocker un nouveau membre
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'contact' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // Enregistrement du membre
        $membre = Membre::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'sexe' => $request->sexe,
            'contact' => $request->contact,
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
                $membre->update(['photo' => $fileName]);
            } else {
                // En cas d'échec de validation de l'image
                return redirect()->route('membres.create')->with('error', 'Le fichier photo n\'est pas valide.');
            }
        }

        // Redirection avec un message
        return redirect()->route('membres.index')->with('success', 'Membre ajouté avec succès!');
    }


    // Afficher un membre spécifique
    public function show(Membre $membre)
    {
        return view('membres.show', compact('membre'));
    }

    // Afficher le formulaire d'édition
    public function edit(Membre $membre)
    {
        return view('membres.edit', compact('membre'));
    }

    // Mettre à jour un membre spécifique
    public function update(Request $request, Membre $membre)
    {
        // Validation des données du formulaire
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'sexe' => 'required',
            'contact' => 'required',
            // 'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mise à jour du membre
        $membre->update($request->all());

        // Redirection avec un message
        return redirect()->route('membres.index')->with('success', 'Membre mis à jour avec succès!');
    }

    // Supprimer un membre spécifique
    public function destroy(Membre $membre)
    {
        $membre->delete();

        // Redirection avec un message
        return redirect()->route('membres.index')->with('success', 'Membre supprimé avec succès!');
    }

    private function countMembres()
    {
        return Membre::count();
    }
}
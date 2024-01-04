<?php

// app/Http/Controllers/AcheterController.php

namespace App\Http\Controllers;

use App\Models\Acheter;
use App\Models\Produit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AcheterController extends Controller
{
    public function index(Request $request)
    {
        $query = Acheter::query();

        // Vérifie si une date est fournie dans la requête
        if ($request->has('date_achat')) {
            $query->whereDate('date_achat', $request->date_achat);
        } else {
            // Si aucune date n'est fournie, filtre par la date du jour
            $query->whereDate('date_achat', Carbon::now()->toDateString());
        }

        $achats = $query->get();

        return view('acheter.index', compact('achats'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('acheter.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_client' => 'required|in:visiteur,membre',
            'produit_id' => 'required|exists:produits,produit_id',
            'date_achat' => 'required|date',
            'quantite_achete' => 'required|integer|min:1',
        ]);

        // Vérifier la disponibilité en stock
        $produit = Produit::findOrFail($request->produit_id);

        if ($produit->quantite_stock < $request->quantite_achete) {
            // Stock insuffisant, rediriger avec un message d'erreur
            return redirect()->route('achats.create')->with('error', 'Rupture de stock. La quantité demandée n\'est pas disponible.');
        }

        // Enregistrez l'achat, en incluant le type de client
        $achat = Acheter::create([
            'type_client' => $request->type_client,
            'membre_id' => $request->type_client === 'membre' ? $request->client_id : null,
            'visiteur_id' => $request->type_client === 'visiteur' ? $request->client_id : null,
            'produit_id' => $request->produit_id,
            'date_achat' => $request->date_achat,
            'quantite_achete' => $request->quantite_achete,
            'total_achete'=> $request->total_achete,
        ]);

        // Mettez à jour la quantité en stock du produit
        $produit->quantite_stock -= $request->quantite_achete;
        $produit->save();

        return redirect()->route('achats.index')->with('success', 'Achat ajouté avec succès!');
    }


    public function show(Acheter $achat)
    {
        return view('acheter.show', compact('achat'));
    }

    public function edit(Acheter $achat)
    {
        $produits = Produit::all();
        return view('acheter.edit', compact('achat', 'produits'));
    }

    public function update(Request $request, Acheter $achat)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,produit_id',
            'date_achat' => 'required|date',
            'quantite_achete' => 'required|integer|min:1',
        ]);

        $achat->update($request->all());

        $produit = Produit::findOrFail($request->produit_id);
        $produit->quantite_stock -= $request->quantite_achete;
        $produit->save();

        return redirect()->route('achats.index')->with('success', 'Achat mis à jour avec succès!');
    }

    public function destroy(Acheter $achat)
    {
        $achat->delete();
        return redirect()->route('achats.index')->with('success', 'Achat supprimé avec succès!');
    }
}

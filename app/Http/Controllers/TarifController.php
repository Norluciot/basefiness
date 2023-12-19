<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarifs.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('tarifs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        // Ajoutez des règles de validation en fonction de vos besoins
        $request->validate([
            'activite' => 'required|in:Abonnement Mensuel,Abonnement Semestriel,Abonnement Annuel,Seance',
            'prix_unitaire' => 'required|numeric',
            // Ajoutez d'autres règles si nécessaire
        ]);

        Tarif::create([
            'activite' => $request->activite,
            'prix_unitaire' => $request->prix_unitaire,
            // Ajoutez d'autres champs si nécessaire
        ]);

        return redirect()->route('tarifs.index')->with('success', 'Tarif ajouté avec succès!');
    }



    /**
     * Display the specified resource.
     *
     *
     */
    public function show(Tarif $tarif)
    {
        return view('tarifs.show', compact('tarif'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', compact('tarif'));
    }

    /**
     * Update the specified resource in storage.
     *

     */
    public function update(Request $request, Tarif $tarif)
    {
        // Add validation rules based on your requirements
        $request->validate([
            // Your validation rules here
        ]);

        $tarif->update($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return redirect()->route('tarifs.index')->with('success', 'Tarif supprimé avec succès!');
    }

    public function getTarifs($activite)
    {
        $tarifs = Tarif::where('activite', $activite)->get(['activite', 'prix_unitaire']);

        dd($tarifs); // Vérifiez les données dans les logs
        return response()->json($tarifs);
    }


}




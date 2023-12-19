<?php
// app/Http/Controllers/ProduitController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $produits = Produit::all();
        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            'quantite_stock' => 'required|numeric',
            'prix_unitaire' => 'required|numeric',
            // Ajoutez d'autres validations au besoin
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Produit $produit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Produit $produit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produit $produit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'designation' => 'required',
            'quantite_stock' => 'required|numeric',
            'prix_unitaire' => 'required|numeric',
            // Ajoutez d'autres validations au besoin
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Produit $produit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès!');
    }
}

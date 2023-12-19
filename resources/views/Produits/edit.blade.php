<!-- resources/views/produits/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Éditer le Produit</h2>
    <form method="post" action="{{ route('produits.update', $produit->produit_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="designation">Désignation :</label>
            <input type="text" name="designation" class="form-control" value="{{ $produit->designation }}" required>
        </div>

        <div class="form-group">
            <label for="quantite_stock">Quantité en stock :</label>
            <input type="number" name="quantite_stock" class="form-control" value="{{ $produit->quantite_stock }}" required>
        </div>

        <div class="form-group">
            <label for="prix_unitaire">Prix unitaire :</label>
            <input type="number" name="prix_unitaire" class="form-control" value="{{ $produit->prix_unitaire }}" required>
        </div>

        <!-- Ajoutez d'autres champs pour les autres attributs du produit -->

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>
@endsection

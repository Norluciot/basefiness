<!-- resources/views/produits/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Créer un nouveau produit</h2>
    <form method="post" action="{{ route('produits.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="designation">Désignation :</label>
            <input type="text" name="designation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="quantite_stock">Quantité en stock :</label>
            <input type="number" name="quantite_stock" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prix_unitaire">Prix unitaire :</label>
            <input type="number" name="prix_unitaire" class="form-control" required>
        </div>

        <!-- Ajoutez d'autres champs pour les autres attributs du produit -->

        <button type="submit" class="btn btn-primary">Ajouter le produit</button>
    </form>
</div>

@endsection

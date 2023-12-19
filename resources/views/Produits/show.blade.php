<!-- resources/views/produits/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du Produit</h2>
    <div>
        <strong>Désignation :</strong> {{ $produit->designation }}
    </div>
    <div>
        <strong>Quantité en stock :</strong> {{ $produit->quantite_stock }}
    </div>
    <div>
        <strong>Prix unitaire :</strong> {{ $produit->prix_unitaire }}
    </div>

    <!-- Affichez d'autres détails pour les autres attributs du produit -->

    <a href="{{ route('produits.edit', $produit->produit_id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('produits.destroy', $produit->produit_id) }}" method="post" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">Supprimer</button>
    </form>
    <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection

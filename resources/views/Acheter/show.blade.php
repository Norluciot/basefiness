<!-- resources/views/produits/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de l'Achat</h2>
    <div>
        <strong>Type de client :</strong> {{ $achat->client_type }}
    </div>
    <div>
        <strong>Produit Achetée :</strong> {{ $achat->produit->designation }}
    </div>
    <div>
        <strong>Date d'Achat :</strong> {{ $achat->date_achat }}
    </div>
    <div>
        <strong>Quantité Achetée :</strong> {{ $achat->quantite_achete }}
    </div>
    <div>
        <strong>Total du Prix :</strong> {{ $achat->produit->prix_unitaire * $achat->quantite_achete }}
    </div>

    <a href="{{ route('achats.edit', $achat->acheter_id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('achats.destroy', $achat->acheter_id) }}" method="post" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet achat?')">Supprimer</button>
    </form>
    <a href="{{ route('achats.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>


@endsection

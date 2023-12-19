<!-- resources/views/produits/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Éditer l'Achat</h2>
    <form method="post" action="{{ route('achats.update', $achat->acheter_id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="client_type">Type de client :</label>
            <select name="client_type" class="form-control" required>
                <option value="membre" {{ $achat->client_type === 'membre' ? 'selected' : '' }}>Membre</option>
                <option value="visiteur" {{ $achat->client_type === 'visiteur' ? 'selected' : '' }}>Visiteur</option>
            </select>
        </div>

        <div class="form-group">
            <label for="produit_id">Produit :</label>
            <select name="produit_id" class="form-control" required>
                @foreach($produits as $produit)
                    <option value="{{ $produit->produit_id }}" {{ $achat->produit_id === $produit->produit_id ? 'selected' : '' }}>
                        {{ $produit->designation }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_achat">Date d'achat :</label>
            <input type="date" name="date_achat" class="form-control" value="{{ $achat->date_achat }}" required>
        </div>

        <div class="form-group">
            <label for="quantite_achete">Quantité achetée :</label>
            <input type="number" name="quantite_achete" class="form-control" value="{{ $achat->quantite_achete }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>

@endsection

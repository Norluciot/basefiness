<!-- resources/views/achats/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Achats</h2>
    <a href="{{ route('achats.create') }}" class="btn btn-primary">Effectuer un Achat</a>
    <br><br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('achats.index') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="date_achat">Filtrer par date :</label>
            <input type="date" name="date_achat" class="form-control" value="{{ request('date_achat') }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            @if(request()->has('date_achat'))
                <a href="{{ route('achats.index') }}" class="btn btn-outline-secondary">Actualiser</a>
            @endif
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date d'Achat</th>
                <th>Type Client</th>
                <th>Produit</th>
                <th>Prix Unitaire</th>
                <th>Quantité Achetée</th>
                <th class="text-right">Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($achats as $achat)
                <tr>
                    <td>{{ $achat->date_achat }}</td>
                    <td>{{ $achat->type_client }}</td>
                    <td>{{ $achat->produit->designation }}</td>
                    <td>{{ $achat->produit->prix_unitaire }}</td>
                    <td>{{ $achat->quantite_achete }}</td>
                    <td class="text-right">{{ $achat->quantite_achete * $achat->produit->prix_unitaire }}</td>
                    <td>
                        <a href="{{ route('achats.show', $achat->acheter_id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('achats.edit', $achat->acheter_id) }}" class="btn btn-primary">Éditer</a>
                        <form action="{{ route('achats.destroy', $achat->acheter_id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet achat?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

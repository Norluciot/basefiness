<!-- resources/views/produits/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Produits</h2>
    <a href="{{ route('produits.create') }}" class="btn btn-primary">Ajouter un Produit</a>
    <br><br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Désignation</th>
                <th>Quantité en stock</th>
                <th>Prix unitaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->produit_id }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ $produit->quantite_stock }}</td>
                    <td>{{ $produit->prix_unitaire }}</td>
                    <td>
                        <a href="{{ route('produits.show', $produit->produit_id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('produits.edit', $produit->produit_id) }}" class="btn btn-primary">Éditer</a>
                        <form action="{{ route('produits.destroy', $produit->produit_id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">Supprimer</button>
                        </form>
                        <!-- Ajoutez d'autres actions si nécessaire, comme la suppression -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

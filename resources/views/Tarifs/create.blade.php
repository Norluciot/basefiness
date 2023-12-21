<!-- resources/views/tarifs/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Créer un nouveau Activité</h2>
    <form method="post" action="{{ route('tarifs.store') }}">
        @csrf

        <div class="form-group">
            <label for="activite"> Type d' activité :</label>
            <select name="activite" class="form-control" required>
                <option value="Abonnement Mensuel">Abonnement Mensuel</option>
                <option value="Abonnement Semestriel">Abonnement Semestriel</option>
                <option value="Abonnement Annuel">Abonnement Annuel</option>
                <option value="Seance">Séance</option>
            </select>
        </div>

        <div class="form-group">
            <label for="prix_unitaire">Prix unitaire :</label>
            <input type="text" name="prix_unitaire" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark">Ajouter l'activité</button>
    </form>
</div>
@endsection

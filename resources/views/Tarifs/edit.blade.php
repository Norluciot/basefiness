<!-- resources/views/tarifs/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Éditer le Tarif</h2>
    <form method="post" action="{{ route('tarifs.update', $tarif->tarif_id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="activite">Activité :</label>
            <select name="activite" class="form-control" required>
                <option value="Abonnement" {{ $tarif->activite === 'Abonnement' ? 'selected' : '' }}>Abonnement</option>
                <option value="Seance" {{ $tarif->activite === 'Seance' ? 'selected' : '' }}>Séance</option>
            </select>
        </div>

        <div class="form-group">
            <label for="prix_unitaire">Prix unitaire :</label>
            <input type="text" name="prix_unitaire" class="form-control" value="{{ $tarif->prix_unitaire }}" required>
        </div>

        <div class="form-group" id="typeAbonnementField" style="{{ $tarif->activite === 'Abonnement' ? '' : 'display:none;' }}">
            <label for="type_abonnement">Type d'abonnement :</label>
            <select name="type_abonnement" class="form-control">
                <option value="Mensuel" {{ $tarif->type_abonnement === 'Mensuel' ? 'selected' : '' }}>Mensuel</option>
                <option value="Semestriel" {{ $tarif->type_abonnement === 'Semestriel' ? 'selected' : '' }}>Semestriel</option>
                <option value="Annuel" {{ $tarif->type_abonnement === 'Annuel' ? 'selected' : '' }}>Annuel</option>
            </select>
        </div>

        <button type="submit" class="btn btn-dark">Enregistrer les modifications</button>
    </form>
</div>

@endsection

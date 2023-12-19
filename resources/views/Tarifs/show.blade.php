<!-- resources/views/tarifs/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Détails du Tarif</h2>
        <div>
            <strong>Activité :</strong> {{ $tarif->activite }}
        </div>
        <div>
            <strong>Prix unitaire :</strong> {{ $tarif->prix_unitaire }} Ar
        </div>


        <!-- Ajoutez d'autres détails pour les autres attributs du tarif -->

        <a href="{{ route('tarifs.edit', $tarif->tarif_id) }}" class="btn btn-primary">Modifier</a>
        <form action="{{ route('tarifs.destroy', $tarif->tarif_id) }}" method="post" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tarif?')">Supprimer</button>
        </form>
        <a href="{{ route('tarifs.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
@endsection

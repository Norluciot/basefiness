<!-- resources/views/payers/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Éditer le Paiement</h2>
    <form method="post" action="{{ route('payers.update', $payer->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date_paiement">Date de paiement :</label>
            <input type="date" name="date_paiement" class="form-control" value="{{ $payer->date_paiement }}" required>
        </div>

        <div class="form-group">
            <label for="type_paiement">Type de paiement :</label>
            <select name="type_paiement" class="form-control" required>
                <option value="abonnement" {{ $payer->type_paiement === 'abonnement' ? 'selected' : '' }}>Abonnement</option>
                <option value="seances" {{ $payer->type_paiement === 'seances' ? 'selected' : '' }}>Séances</option>
            </select>
        </div>

        <div class="form-group">
            <label for="membre_visiteur_id">Membre/Visiteur :</label>
            <select name="membre_visiteur_id" class="form-control">
                @foreach($membres as $membre)
                    <option value="{{ $membre->membre_id }}" {{ $payer->membre_visiteur_id == $membre->membre_id ? 'selected' : '' }}>
                        {{ $membre->nom }} (Membre)
                    </option>
                @endforeach
                @foreach($visiteurs as $visiteur)
                    <option value="{{ $visiteur->visiteur_id }}" {{ $payer->membre_visiteur_id == $visiteur->visiteur_id ? 'selected' : '' }}>
                        {{ $visiteur->nom }} (Visiteur)
                    </option>
                @endforeach
            </select>
        </div>

        @if($payer->type_paiement === 'abonnement')
            <div class="form-group">
                <label for="tarif_id">Tarif :</label>
                <select name="tarif_id" class="form-control">
                    @foreach($tarifs as $tarif)
                        <option value="{{ $tarif->id }}" {{ $payer->tarif_id == $tarif->id ? 'selected' : '' }}>
                            {{ $tarif->activite }} - {{ $tarif->prix_unitaire }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="debut_abonnement">Date de début d'abonnement :</label>
                <input type="date" name="debut_abonnement" class="form-control" value="{{ $payer->debut_abonnement }}" required>
            </div>
        @elseif($payer->type_paiement === 'seances')
            <div class="form-group">
                <label for="nombre_seances">Nombre de séances :</label>
                <input type="number" name="nombre_seances" class="form-control" value="{{ $payer->nombre_seances }}" required>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>

@endsection

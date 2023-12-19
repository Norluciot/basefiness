<!-- resources/views/payers/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du Paiement</h2>
    <div>
        <strong>Date de Paiement :</strong> {{ $payer->date_paiement }}
    </div>
    <div>
        <strong>Type de Paiement :</strong> {{ $payer->type_paiement }}
    </div>
    <div>
        <strong>Membre/Visiteur :</strong> {{ $payer->membre ? $payer->membre->nom : 'N/A' }}
        {{ $payer->visiteur ? $payer->visiteur->nom : 'N/A' }}
    </div>

    @if($payer->type_paiement === 'abonnement')
        <div>
            <strong>Tarif :</strong> {{ $payer->tarif->activite }} - {{ $payer->tarif->prix_unitaire }}
        </div>
        <div>
            <strong>Date de début d'abonnement :</strong> {{ $payer->debut_abonnement }}
        </div>
        <div>
            <strong>Date de fin d'abonnement :</strong> {{ $payer->fin_abonnement }}
        </div>
    @elseif($payer->type_paiement === 'seances')
        <div>
            <strong>Nombre de séances :</strong> {{ $payer->nombre_seances }}
        </div>
    @endif

    <div>
        <strong>Statut :</strong> {{ $payer->statut }}
    </div>

    <a href="{{ route('payers.edit', $payer->id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('payers.destroy', $payer->id) }}" method="post" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement?')">Supprimer</button>
    </form>
    <a href="{{ route('payers.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>

@endsection

<!-- resources/views/visiteurs/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        .container {
            text-align: center;
        }

        .member-details {
            display: inline-block;
            text-align: left; /* Ajustez la position du texte selon vos besoins */
        }

        .photo-container {
            max-width: 300px; /* Ajustez la largeur maximale selon vos besoins */
            margin-bottom: 15px;
        }

        .member-photo {
            max-width: 100%;
            max-height: 100%;
        }

        .buttons-container {
            text-align: center; /* Ajustez la position des boutons selon vos besoins */
        }
    </style>

    <h2>Détails du Visiteur</h2>

    <div>
        <strong>Photo :</strong>
        @if($visiteur->photo)
            <img src="{{ asset('storage/' . $visiteur->photo) }}" alt="Photo">
        @else
            Aucune photo disponible.
        @endif
    </div>

    <div>
        <strong>Nom du Visiteur :</strong> {{ $visiteur->visiteur_nom }}
    </div>
    <div>
        <div>
            <strong>Sexe:</strong> {{ $visiteur->visiteur_sexe }}
        </div>

    <!-- Ajoutez d'autres détails pour les autres attributs du visiteur -->

    <a href="{{ route('visiteurs.edit', $visiteur->visiteur_id) }}" class="btn btn-primary">Modifier</a>
    <form action="{{ route('visiteurs.destroy', $visiteur->visiteur_id) }}" method="post" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce visiteur?')">Supprimer</button>
    </form>
    <a href="{{ route('visiteurs.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>

@endsection

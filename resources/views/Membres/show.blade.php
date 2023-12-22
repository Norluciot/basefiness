@extends('layouts.app')

@section('content')

    <style>
        .center-content {
            text-align: center;
            margin-top: 20px; /* Facultatif, ajustez selon vos besoins */
        }

        .member-details {
            text-align: left;
            margin: 20px;
            display: inline-block; /* Pour que le texte soit aligné à gauche dans le bloc */
        }

        .photo-container {
            max-width: 300px;
            margin-bottom: 20px;
            margin: 0 auto; /* Centre le conteneur de photo horizontalement */
        }

        .member-photo {
            max-width: 100%;
            max-height: 100%;
        }

        .buttons-container {
            text-align: center;
        }
    </style>
    <div class="container">
        <div class="container center-content">
            <div class="card text-bg-dark">
                <img width="350" class="rounded-5 text-center" src="{{ asset('storage/photos/' . $membre->photo) }}" alt="Photo">
                <div class="card-img-overlay justify-center">
                    <h2 class="card-title text-center">Détails du Membre</h2>
                    <p class="card-text"><strong>Nom :</strong> {{ $membre->nom }}</li></p>
                    <p class="card-text"><strong>Prénom :</strong> {{ $membre->prenom }}</li></p>
                    <p class="card-text"><strong>Sexe :</strong> {{ $membre->sexe }}</p>
                    <p class="card-text"><strong>Contact :</strong> {{ $membre->contact }}</p>
                    <p class="card-text"><strong>Début d'abonnement :</strong>
                        @if ($lastPaymentDetails['date_debut'])
                            {{ $lastPaymentDetails['date_debut']->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </p>
                    <p class="card-text"><strong>Fin d'abonnement :</strong>
                        @if ($lastPaymentDetails['date_fin'])
                            {{ $lastPaymentDetails['date_fin']->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </p>
                    {{-- <p class="card-text"><strong>Statut:</strong> {{ $lastPaymentDetails['statut'] ?? 'N/A' }}</p> --}}

                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br><br>

        <div class="buttons-container">
            <a href="{{ route('membres.edit', $membre->membre_id) }}" class="btn btn-dark">Modifier</a>
            <form action="{{ route('membres.destroy', $membre->membre_id) }}" method="post" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">Supprimer</button>
            </form>
            <a href="{{ route('membres.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>

    </div>

@endsection

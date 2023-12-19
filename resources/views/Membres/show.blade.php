@extends('layouts.app')

@section('content')
    <div class="container">
        <style>
            .container {
                text-align: center;
            }

            .member-details {
                display: inline-block;
                text-align: left;
            }

            .photo-container {
                max-width: 300px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                padding: 5px;
            }

            .member-photo {
                max-width: 100%;
                max-height: 100%;
            }

            .buttons-container {
                text-align: center;
            }
        </style>



@foreach ($membres as $membre)
        @if($membre->photo)
        <img class="member-photo" src="{{ asset('storage/photos/' . $membre->photo) }}" alt="Photo">
        @else
        Aucune photo disponible.
        @endif
        <h2>Détails du Membre</h2>
        <div class="member-details">
            <div class="photo-container">

            </div>

            <div>
                <strong>Nom :</strong> {{ $membre->nom }}
            </div>
            <div>
                <strong>Prénom :</strong> {{ $membre->prenom }}
            </div>
            <div>
                <strong>Sexe :</strong> {{ $membre->sexe }}
            </div>
            <div>
                <strong>Contact :</strong> {{ $membre->contact }}
            </div>
            <div>
                <strong>Début d'abonnement :</strong>
                @foreach ($payers as $payer)

                @if($membre->membre_id == $payer->membre_id)
                {{ $payer->date_debut }}
                @else
                N/A
                @endif
                @endforeach
            </div>
            <div>
                <strong>Fin d'abonnement :</strong>
                @foreach ($payers as $payer)

                @if($membre->membre_id == $payer->membre_id)
                {{ $payer->date_fin }}
                @else
                N/A
                @endif
                @endforeach
            </div>

            <div class="buttons-container">
                <a href="{{ route('membres.edit', $membre->membre_id) }}" class="btn btn-primary">Modifier</a>
                <form action="{{ route('membres.destroy', $membre->membre_id) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?')">Supprimer</button>
                </form>
                <a href="{{ route('membres.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>
        @endforeach
    </div>
    @endsection

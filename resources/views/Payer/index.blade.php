<!-- resources/views/achats/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Paiements</h2>
    <a href="{{ route('payer.create') }}" class="btn btn-primary">Effectuer un Paiement</a>


    <br><br>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('payer.index') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="date_paiement">Filtrer par date :</label>
            <input type="date" name="date_paiement" class="form-control" value="{{ request('date_paiement') }}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            @if(request()->has('date_paiement'))
                <a href="{{ route('payer.index') }}" class="btn btn-outline-secondary">Actualiser</a>
            @endif
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Type Client</th>
                <th>Nom</th>
                <th>Date de Paiement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payers as $payer)
                <tr>
                    <td>@if ($payer->membre)
                        Membre
                    @elseif ($payer->visiteur)
                        Visiteur
                    @else
                        Inconnu
                    @endif
                    </td>
                    <td>
                        @if ($payer->membre)
                            Mr/Mme : {{ $payer->membre->nom }}
                        @elseif ($payer->visiteur)
                            Mr/Mme : {{ $payer->visiteur->visiteur_nom }}
                        @else
                            Inconnu
                        @endif
                    </td>
                    <td>{{ 
                    $format = strftime("%d %b %Y %Hm:%m", $payer->created_at->getTimesTamp())
                    }}</td>
                    <td>
                        <a href="{{ route('payer.edit', ['payer' => $payer->payer_id]) }}" class="btn btn-primary">Éditer</a>

                        {{-- Ajoutez un formulaire de suppression ici si nécessaire --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

<!-- resources/views/achats/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Liste des Paiements</h2>
    <a href="{{ route('payer.create') }}" class="btn btn-dark">Effectuer un Paiement</a>


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
            <button type="submit" class="btn btn-outline-dark rounded-3">Rechercher</button>
            @if(request()->has('date_paiement'))
                <a href="{{ route('payer.index') }}" class="btn btn-outline-secondary">Actualiser</a>
            @endif
        </div>
    </form>



    <div class="table-responsive shadow-sm rounded-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col " class="bg-secondary text-white border-0 border-bottom-1 text-left">Type Client</th>
                    <th scope="col " class="bg-secondary text-white border-0 border-bottom- text-center">Identifiant</th>
                    {{-- <th scope="col " class="bg-secondary text-white border-0 border-bottom-1 text-center">Date de Paiement</th> --}}
                    <th scope="col " class="bg-secondary text-white border-0 border-bottom-1 text-center">Type d'activité</th>
                    <th scope="col " class="bg-secondary text-white border-0 border-bottom-1 text-center">Prix Unitaire</th>
                    <th scope="col " class="bg-secondary text-white border-0 border-bottom-1 text-center">Quantité Payé</th>
                    <th scope="col " class="bg-secondary text-white border-0 border-bottom-1 text-center">Total</th>
                    {{-- <th scope="col" class="bg-secondary text-white border-0 border-bottom-1 " >Modifier</th>
                    <th scope="col" class="bg-secondary text-white border-0 border-bottom-1 text-center" >Supprimer</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($payersGroupedByDate as $date => $payersByDate)
                    @foreach ($payersByDate as $payer)
                    <tr>
                        <td class="bg-white border-0">
                           {{$payer->type_client}}
                        </td>
                        <td class="bg-white border-0 text-center">
                            @if ($payer->membre)
                                {{ $payer->membre_id }}
                            @elseif ($payer->visiteur)
                                {{ $payer->visiteur_id }}
                            @else
                                Inconnu
                            @endif
                        </td>
                        {{-- <td class="bg-white border-0 text-center">
                                {{
                                    $format = strftime("%d %b %Y %Hm:%m", $payer->created_at->getTimesTamp())
                                }}
                        </td> --}}
                        <td class="bg-white border-0 text-center">
                            @if ($payer->tarifs)
                            @endif
                            {{$payer->tarif->activite }}

                        </td>
                        <td class="bg-white border-0 text-center">
                            @if ($payer->tarifs)
                            @endif
                            {{$payer->tarif->prix_unitaire}}

                        </td>
                        <td class="bg-white border-0 text-center">{{ $payer -> quantite_paye }}</td>
                        <td class="bg-white border-0 text-center">{{ $payer -> total_paye }}</td>
    {{-- COMMENTAIRE DES BOUTONS MODIFIER ET SUPPRIMES

                            <td class="bg-white border-0">
                                <a href="{{ route('payer.edit', ['payer' => $payer->payer_id]) }}" class="nav-link">
                                    <svg width="24" class="text-warning" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            </td>
                            <td class="bg-white border-0 text-center">
                                <form action="{{ route('payer.destroy', $payer->payer_id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce visiteur?')"><svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg></button>
                                </form>
                            </td> --}}

                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

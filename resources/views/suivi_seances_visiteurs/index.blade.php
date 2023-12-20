@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Suivi des Séances des Visiteurs</h1>

    {{-- Formulaire de recherche --}}
    <form action="{{ route('suivi_seances_visiteurs.index') }}" method="GET">
        <!-- ... (votre code de formulaire de recherche) -->
    </form>


    <form method="post" action="{{ route('suivi_seances_visiteurs.store') }}">
        @csrf
        <div class="table-responsive shadow-sm rounded-3">
            <table class="table caption-top text-capitalize">
                <thead>
                    <tr>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Visiteur</th>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Nom du Visiteur</th>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Séances Payées</th>
                        <th scope="col " class="bg-secondary text-white text-center border-0 border-bottom-1">Enregistrer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visiteurs as $visiteur)
                        <tr>
                            <td class="bg-white border-0">{{ $visiteur->visiteur_id }}</td>
                            <td class="bg-white border-0">{{ $visiteur->visiteur_nom }} {{ $visiteur->prenom }}</td>
                            <td class="bg-white border-0">
                                @foreach($visiteur->suivi_seances_visiteur as $suivi)
                                    <label>
                                        <input type="checkbox" name="seances_payees[{{ $visiteur->visiteur_id }}][{{ $suivi->id }}][isChecked]" value="1" {{ $suivi->a_fait_seance ? 'checked' : '' }}>
                                        <input type="hidden" name="seances_payees[{{ $visiteur->visiteur_id }}][{{ $suivi->id }}][id]" value="{{ $suivi->id }}">
                                    </label>
                                @endforeach
                            </td>
                            <td class="bg-white border-0 text-center">
                                <!-- Assurez-vous que le bouton "Enregistrer" est à l'intérieur de la boucle foreach -->
                                <button type="submit" class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                                      </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>
@endsection

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
        <table class="table">
            <thead>
                <tr>
                    <th>Visiteur</th>
                    <th>Nom du Visiteur</th>
                    <th>Séances Payées</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visiteurs as $visiteur)
                    <tr>
                        <td>{{ $visiteur->visiteur_id }}</td>
                        <td>{{ $visiteur->visiteur_nom }} {{ $visiteur->prenom }}</td>
                        <td>
                            @foreach($visiteur->suivi_seances_visiteur as $suivi)
                                <label>
                                    <input type="checkbox" name="seances_payees[{{ $visiteur->visiteur_id }}][{{ $suivi->id }}][isChecked]" value="1" {{ $suivi->a_fait_seance ? 'checked' : '' }}>
                                    <input type="hidden" name="seances_payees[{{ $visiteur->visiteur_id }}][{{ $suivi->id }}][id]" value="{{ $suivi->id }}">
                                </label>
                            @endforeach
                        </td>
                        <td>
                            <!-- Assurez-vous que le bouton "Enregistrer" est à l'intérieur de la boucle foreach -->
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection

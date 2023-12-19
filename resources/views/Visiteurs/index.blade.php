<!-- resources/views/visiteurs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des Visiteurs</h2>
        <a href="{{ route('visiteurs.create') }}" class="btn btn-primary">Ajouter un Visiteur</a>
        <br><br>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('visiteurs.index') }}" method="GET" class="mb-3">
            <div class="form-group">
                <label for="nom">Rechercher par nom :</label>
                <input type="text" name="nom" class="form-control" value="{{ request('nom') }}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                @if(request()->has('nom'))
                    <a href="{{ route('visiteurs.index') }}" class="btn btn-outline-secondary">Actualiser</a>
                @endif
            </div>
        </form>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Nom</th>
                    <th>Sexe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visiteurs as $visiteur)
                    <tr>
                        <td>{{ $visiteur->visiteur_id }}</td>
                        <td>{{ $visiteur->visiteur_nom }}</td>
                        <td>{{ $visiteur->visiteur_sexe }}</td>
                        <td>
                            <a href="{{ route('visiteurs.show', $visiteur->visiteur_id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('visiteurs.edit', $visiteur->visiteur_id) }}" class="btn btn-primary">Éditer</a>
                            <!-- Autres actions -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>


@endsection

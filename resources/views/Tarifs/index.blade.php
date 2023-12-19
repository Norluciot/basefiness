<!-- resources/views/tarifs/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Liste des Activites</h2>
        <a href="{{ route('tarifs.create') }}" class="btn btn-primary">Ajouter un Activté</a>
        <br><br>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type d'activité</th>
                    <th>Prix unitaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tarifs as $tarif)
                <tr>
                    <td>{{ $tarif->activite }}</td>
                    <td>{{ $tarif->prix_unitaire }} Ar</td>
                    <td>
                        <a href="{{ route('tarifs.edit', $tarif->tarif_id) }}" class="btn btn-primary">Éditer</a>
                        <form action="{{ route('tarifs.destroy', $tarif->tarif_id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet activité?')">Supprimer</button>
                        </form>
                        <!-- Autres actions -->
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection


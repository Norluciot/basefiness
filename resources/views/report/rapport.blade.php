<!-- report.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Rapport Journalier</h1>

        <form action="{{ route('rapport.journalier') }}" method="get">
            @csrf
            <label for="date">Sélectionner une date :</label>
            <input type="date" id="date" name="date" value="{{ $date }}">
            <button type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Totales des Abonnements et Seances</th>
                    <th>Totales des ventes de produits</th>
                    <th>Recette Journalière</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $recettesPayer }} Ariary</td>
                    <td>{{ $recettesAcheter }} Ariary</td>
                    <td>{{ $recettesPayer + $recettesAcheter }} Ariary</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

<!-- report.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Rapport Journalier</h1>

        <form action="{{ route('rapport.journalier') }}" method="get">
            @csrf
            <label for="date">Sélectionner une date :</label>
            <input type="date" id="date" name="date"  class="form-control" value="{{ $date }}"> <br>
            <button type="submit" class="btn btn-outline-dark rounded-3">Rechercher</button>
        </form>
        <br><br>
        <div class="table-responsive shadow-sm rounded-3">
            <table class="table caption-top text-capitalize">
                <thead>
                    <tr>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Date</th>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Totales des Abonnements et Seances</th>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Totales des ventes de produits</th>
                        <th scope="col " class="bg-secondary text-white border-0 border-bottom-1">Recette Journalière</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       <td class="bg-white border-0">{{ $date }}</td>
                       <td class="bg-white border-0">{{ $recettesPayer }} Ariary</td>
                       <td class="bg-white border-0">{{ $recettesAcheter }} Ariary</td>
                       <td class="bg-white border-0">{{ $recettesPayer + $recettesAcheter }} Ariary</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection

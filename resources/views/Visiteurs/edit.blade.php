<!-- resources/views/visiteurs/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Éditer le Visiteur</h2>
    <form method="post" action="{{ route('visiteurs.update', $visiteur->visiteur_id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="visiteur_nom">Nom du visiteur :</label>
            <input type="text" name="visiteur_nom" class="form-control" value="{{ $visiteur->visiteur_nom }}" required>
        </div>

        <div class="form-group">
            <label for="visisteur_sexe">Sexe :</label>
            <select name="visiteur_sexe" class="form-control" required>
                    <option value="homme" {{ $visiteur->visiteur_sexe == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ $visiteur->visiteur_sexe == 'femme' ? 'selected' : '' }}>Femme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="photo">Photo :</label>
            <input type="file" name="photo" class="form-control-file">
        </div>



        <button type="submit" class="btn btn-dark">Enregistrer les modifications</button>
    </form>
</div>
@endsection

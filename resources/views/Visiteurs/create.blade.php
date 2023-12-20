<!-- resources/views/Visiteurs/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Créer un nouveau visiteur</h2>
        <form method="post" action="{{ route('visiteurs.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="visiteur_nom">Nom :</label>
                <input type="text" name="visiteur_nom" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="visisteur_sexe">Sexe :</label>
                <select name="visiteur_sexe" class="form-control" required>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" name="photo" class="form-control-file">
            </div>

            <!-- Ajoutez d'autres champs pour les autres attributs du visiteur -->

            <button type="submit" class="btn btn-dark" onclick="return confirm('Êtes-vous sûr de vouloir ajouter ce visiteur ?')">Ajouter le visiteur</button>
        </form>
    </div>
@endsection

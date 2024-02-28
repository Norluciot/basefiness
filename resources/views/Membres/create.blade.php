<!-- resources/views/Membres/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Créer un nouveau membre</h2>
    <form method="post" action="{{ route('membres.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select name="sexe" class="form-control" required>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="contact">Contact :</label>
            <input type="text" name="contact" class="form-control" >
        </div>

        <div class="form-group">
            <label for="photo">Photo :</label>
            <input type="file" name="photo" class="form-control-file">
        </div>

        <!-- Ajoutez d'autres champs pour les autres attributs du membre -->

        <button type="submit" class="btn btn-dark" onclick="return confirm('Êtes-vous sûr de vouloir ajouter ce membre ?')">Ajouter le membre</button>
    </form>
</div>
@endsection

<!-- resources/views/membres/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Éditer le Membre</h2>
        <form method="post" action="{{ route('membres.update', $membre->membre_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" class="form-control" value="{{ $membre->nom }}" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" class="form-control" value="{{ $membre->prenom }}" required>
            </div>

            <div class="form-group">
                <label for="sexe">Sexe :</label>
                <select name="sexe" class="form-control" required>
                    <option value="homme" {{ $membre->sexe == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ $membre->sexe == 'femme' ? 'selected' : '' }}>Femme</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contact">Contact :</label>
                <input type="text" name="contact" class="form-control" value="{{ $membre->contact }}" required>
            </div>

            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" name="photo" class="form-control">
                @if($membre->photo)
                    <img src="{{ asset('storage/' . $membre->photo) }}" alt="Photo">
                @endif
            </div>

            <!-- Ajoutez d'autres champs pour les autres attributs du membre -->

            <button type="submit" class="btn btn-dark" onclick="return confirm('Êtes-vous sûr de vouloir modifier ce membre ?')">Enregistrer les modifications</button>
        </form>
    </div>
@endsection

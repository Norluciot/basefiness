<!-- resources/views/produits/create.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Effectuer un nouvel achat</h2>
     @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="post" action="{{ route('achats.store') }}">
        @csrf

        <div class="form-group">
            <label for="date_achat">Date d'achat :</label>
            <input type="date" name="date_achat" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="type_client">Type de client :</label>
            <select name="type_client" class="form-control" required>
                <option value="0">Veuillez sélectionner le type de client</option>
                <option value="membre">Membre</option>
                <option value="visiteur">Visiteur</option>
            </select>
        </div>

        <div class="form-group">
            <label for="produit_id">Produit :</label>
            <select name="produit_id" class="form-control" required>
                <option value="0">Veuillez sélectionner le produit</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->produit_id }}" data-prix="{{ $produit->prix_unitaire }}">{{ $produit->designation }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="prix_unitaire">Prix du produit :</label>
            <input type="text" id="prix_unitaire" readonly>
        </div>

        <div class="form-group">
            <label for="quantite_achete">Quantité achetée :</label>
            <input type="number" name="quantite_achete" id="quantite_achete" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="total_achete">Total du prix :</label>
            <input type="text" name="total_achete" id="total_achete" readonly>
        </div>


        <button type="submit" class="btn btn-dark">Effectuer l'achat</button>
    </form>
</div>

<script>
    // Script pour mettre à jour le prix du produit et le total du prix en temps réel
    document.addEventListener('DOMContentLoaded', function () {
    const produitSelect = document.querySelector('select[name="produit_id"]');
    const prixUnitaireInput = document.getElementById('prix_unitaire');
    const quantiteAcheteInput = document.getElementById('quantite_achete');
    const totalPrixInput = document.getElementById('total_achete'); // Ajout de cette ligne

    // Écouteur d'événement pour changer le prix du produit lorsque le produit est modifié
    produitSelect.addEventListener('change', function () {
        const selectedOption = produitSelect.options[produitSelect.selectedIndex];
        const prixUnitaire = parseFloat(selectedOption.dataset.prix);
        prixUnitaireInput.value = prixUnitaire.toFixed(2);
        updateTotalPrix();
    });

    // Écouteur d'événement pour mettre à jour le total du prix lorsque la quantité est modifiée
    quantiteAcheteInput.addEventListener('input', updateTotalPrix);

    // Fonction pour mettre à jour le total du prix
    function updateTotalPrix() {
        const prixUnitaire = parseFloat(prixUnitaireInput.value);
        const quantiteAchete = parseFloat(quantiteAcheteInput.value);
        const totalPrix = isNaN(prixUnitaire) || isNaN(quantiteAchete) ? '' : (prixUnitaire * quantiteAchete).toFixed(2);
        totalPrixInput.value = totalPrix;
    }
});

</script>

@endsection

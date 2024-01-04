@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nouveau Paiement</h1>

        <form action="{{ route('payer.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="date_paiement">Date du Paiement:</label>
                <input type="date" name="date_paiement" id="date_paiement" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="type_client">Type de Client:</label>
                <select name="type_client" id="type_client" class="form-control">
                    <option value="0">Veuillez sélectionner le type de client</option>
                    <option value="membre">Membre</option>
                    <option value="visiteur">Visiteur</option>
                </select>
            </div>

            <div id="membre_fields" class="form-group">
                <label for="membre_id">Membre:</label>
                <select name="membre_id" id="membre_id" class="form-control">
                    <option value="0">Veuillez sélectionner un membre</option>
                    @foreach ($membres as $mbr)
                        <option value="{{ $mbr['membre_id'] }}">{{ $mbr['membre_id'] }} ~ {{ $mbr['nom'] }} {{ $mbr['prenom'] }}</option>
                    @endforeach
                </select>
            </div>

            <div id="visiteur_fields" class="form-group" style="display: none;">
                <label for="visiteur_id">Visiteur:</label>
                <select name="visiteur_id" id="visiteur_id" class="form-control">
                    <option value="0">Veuillez sélectionner un visiteur</option>
                    @foreach($visiteurs as $vst)
                        <option value="{{ $vst['visiteur_id'] }}">{{ $vst['visiteur_id'] }} ~ {{ $vst['visiteur_nom'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="activite">Activité:</label>
                <select name="activite" id="activite" class="form-control">
                    <option value=""></option>
                    @foreach($tarifs as $tarif)
                        <option value="{{ $tarif->tarif_id}}" data-prix="{{ $tarif->prix_unitaire }}">{{ $tarif->activite }} - {{ $tarif->prix_unitaire }}</option>
                    @endforeach
                </select>
            </div>

            <div id="quantite_fields" class="form-group">
                <label for="quantite_paye">Quantité:</label>
                <input type="number" name="quantite_paye" id="quantite_paye" class="form-control">
            </div>

            <div id="abonnement_fields" class="form-group" style="display: none;">
                <label for="date_debut">Date de début d'Abonnement:</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control">
            </div>

            <div id="total_fields" class="form-group">
                <label for="total_paye">Total:</label>
                <input type="text" name="total_paye" id="total_paye" class="form-control" readonly>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark" onclick="return confirm('Êtes-vous sûr de vouloir enregistrer ce paiement ?')">Enregistrer</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeClientSelect = document.querySelector('select[name="type_client"]');
            const membreFields = document.getElementById('membre_fields');
            const visiteurFields = document.getElementById('visiteur_fields');
            const abonnementFields = document.getElementById('abonnement_fields');
            const activiteSelect = document.getElementById('activite');
            const quantiteInput = document.getElementById('quantite_paye');
            const totalInput = document.getElementById('total_paye');

            typeClientSelect.addEventListener('change', function () {
                if (typeClientSelect.value === 'membre') {
                    membreFields.style.display = 'block';
                    visiteurFields.style.display = 'none';
                    abonnementFields.style.display = 'block';
                } else if (typeClientSelect.value === 'visiteur') {
                    membreFields.style.display = 'none';
                    visiteurFields.style.display = 'block';
                    abonnementFields.style.display = 'none';
                }
            });

            // Écouteur d'événement pour changer le prix de l'activité lorsque l'activité est modifiée
            activiteSelect.addEventListener('change', updateTotal);

            // Écouteur d'événement pour mettre à jour le total lorsque la quantité est modifiée
            quantiteInput.addEventListener('input', updateTotal);

            // Fonction pour mettre à jour le total
            function updateTotal() {
                const prixUnitaire = parseFloat(activiteSelect.options[activiteSelect.selectedIndex].dataset.prix);
                const quantite = parseFloat(quantiteInput.value);

                console.log("Prix unitaire:", prixUnitaire);
                console.log("Quantité:", quantite);

                const total = isNaN(prixUnitaire) || isNaN(quantite) ? '' : (prixUnitaire * quantite).toFixed(2);
                totalInput.value = total;
            }
        });
    </script>
@endsection

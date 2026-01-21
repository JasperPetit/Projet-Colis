<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation des Devis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Boutons spécifiques validation */
        .btn-action { padding: 8px 12px; margin: 0 5px; color: white; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .btn-valider { background-color: #28a745; }
        .btn-valider:hover { background-color: #218838; }
        .btn-refuser { background-color: #dc3545; }
        .btn-refuser:hover { background-color: #c82333; }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="titre">
            <h1>Service Financier : Validation</h1>
            <a href="accueil" class="btn-nouvelle-commande" style="background-color: #6c757d;">
                <i class="fas fa-arrow-left"></i> Retour Dashboard
            </a>
        </div>

        <input type="text" id="searchBar" onkeyup="filtrerCommandes()" placeholder="Rechercher (nom, fournisseur, prix...)"> 

        <div id="listeDevis"> 
            <?php foreach ($listeDevis as $devi) { ?>
                <div class="commande-card" style="flex-wrap: wrap;">
                    
                    <div class="commande-info">
                        <h3><?= htmlspecialchars($devi['name'] ?? 'Devis n°'.$devi['idDevis'])?></h3>
                        <p>📄 n°<?= !empty($devi['idDevis']) ? htmlspecialchars($devi['idDevis']) : 'N/A' ?></p>
                        <p>🏢 Fournisseur : <?= !empty($devi['nomEntreprise']) ? htmlspecialchars($devi['nomEntreprise']) : 'Inconnu' ?></p>
                        <p>👤 Demandeur :  <?= !empty($devi['nom']) ? htmlspecialchars($devi['nom'] .' '. $devi['Prenom']) : 'Inconnu' ?></p>
                        <p>📍 Département : <?= !empty($devi['nomDepartement']) ? htmlspecialchars($devi['nomDepartement']) : 'Non défini' ?></p>
                        <p>💰 Montant : <strong><?= !empty($devi['prix']) ? htmlspecialchars($devi['prix']) . ' €' : 'N/A' ?></strong></p>
                        <p>📅 Date : <?= !empty($devi['Date_']) ? htmlspecialchars($devi['Date_']) : 'Inconnue' ?></p>
                    </div>
                    
                    <div class="commande-actions">
                        <?php
                            $statut = $devi["SignatureOuiOuNon"];
                            
                            // SI C'EST NULL (En attente) => ON AFFICHE LES BOUTONS
                            if (is_null($statut) || $statut === '') { 
                        ?>
                            <div style="display:flex;">
                                <a href="index.php?action=validerDevis&id=<?= $devi['idDevis'] ?>" class="btn-action btn-valider">
                                    <i class="fas fa-check"></i> Valider
                                </a>
                                <a href="index.php?action=refuserDevis&id=<?= $devi['idDevis'] ?>" class="btn-action btn-refuser">
                                    <i class="fas fa-times"></i> Refuser
                                </a>
                            </div>
                        <?php 
                            } else { 
                            // SINON => ON AFFICHE LE BADGE (Comme sur pageInfosDevis)
                                $classeStatut = ($statut == 1) ? "statut-accepte" : "statut-refuse";
                                $texteStatut = ($statut == 1) ? "Accepté" : "Rejeté";
                        ?>
                            <span class="statue-devis <?= $classeStatut ?>">
                                <?= htmlspecialchars($texteStatut) ?>
                            </span>
                        <?php } ?>

                        <?php if (!empty($devi['imageDevis'])): ?>
                            <a href="uploads/<?= htmlspecialchars($devi['imageDevis']) ?>" target="_blank" class="commande-détails">Voir le fichier</a>
                        <?php endif; ?>
                        
                        <a href="javascript:void(0);" onclick="toggleDetails(<?= $devi['idDevis'] ?>)" class="commande-détails">Voir détails</a>
                    </div>

                    <div id="details-<?= $devi['idDevis'] ?>" style="display: none; width: 100%; margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; color: #555;">
                        <strong>Détails :</strong><br>
                        <?= nl2br(htmlspecialchars($devi['details'] ?? 'Aucun détail.')) ?>
                    </div>
                </div>
            <?php } ?>
        </div> 
    </main>

    <script>
        function filtrerCommandes() {
            var input = document.getElementById("searchBar");
            var filter = input.value.toUpperCase();
            var container = document.getElementById("listeDevis");
            var cards = container.getElementsByClassName("commande-card");
            for (var i = 0; i < cards.length; i++) {
                var h3 = cards[i].getElementsByTagName("h3")[0];
                var txtValue = h3.textContent || h3.innerText;
                cards[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
        function toggleDetails(id) {
            var div = document.getElementById('details-' + id);
            div.style.display = (div.style.display === "none") ? "block" : "none";
        }
    </script>
</body>
</html>
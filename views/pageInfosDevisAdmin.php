<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Devis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>

        <div class="titre">
            <h1>Liste des Devis </h1>
            <a href="formulaireDevis" class="btn-nouvelle-commande">
                <i class="fas fa-plus"></i> Ajouter un devis
            </a>
        </div>

         <input type="text" id="searchBar" onkeyup="filtrerCommandes()" placeholder="Rechercher une commande"> 

        <div id="listeDevis"> 
            <?php foreach ($listeDevis as $devi) { ?>
                <div class="commande-card" style="flex-wrap: wrap;">
                    
                    <div class="commande-info">
                        <h3><?= htmlspecialchars($devi['name'] ?? 'Devi n°'.$devi['idDevis'])?></h3>
                        <p>📄n°<?= !empty($devi['idDevis']) ? htmlspecialchars($devi['idDevis']) : 'numero de devis non trouvé' ?></p>

                        <p>
                            🏢 Fournisseur : <?= !empty($devi['nomEntreprise']) ? htmlspecialchars($devi['nomEntreprise']) : 'Fournisseur inconnu' ?>
                        </p>
                        <p>
                            👤 Commandeur :  <?= !empty($devi['nom']) ? htmlspecialchars($devi['nom'] .' '. $devi['Prenom']) : 'Demandeur inconnu' ?>
                        </p>
                        <p>
                            📍Departement : <?= !empty($devi['nomDepartement']) ? htmlspecialchars($devi['nomDepartement']) : 'Departement inconnu' ?>
                        </p>
                        <p>📅 Ajout : <?= !empty($devi['Date_']) ? htmlspecialchars($devi['Date_']) : 'inconnu' ?></p>
                    </div>
                    
                    <div class="commande-actions">
                        <?php
                            $statut = $devi["SignatureOuiOuNon"];
                            $affichage = '';
                            $classeStatut = '';
                            
                            if(is_null($statut)){
                                $affichage = "En attente";
                                $classeStatut = "statut-non-signe"; 
                            }
                            elseif($statut == 1){
                                $affichage = "Accepté";
                                $classeStatut = "statut-accepte";
                            }
                            elseif($statut == 0){
                                $affichage = "Rejeté";
                                $classeStatut = "statut-refuse";
                            }
                        ?>

                        <span class="statue-devis <?= $classeStatut ?>">
                            <?= htmlspecialchars($affichage) ?>
                        </span>
                        <a href="ModifierDevis?modifier=<?= $devi['idDevis']?>"class="commande-détails">Modifier le devi</a>
                        <?php if (!empty($devi['imageDevis'])): ?>
                            <a href="uploads/<?= htmlspecialchars($devi['imageDevis']) ?>" target="_blank" class="commande-détails">Voir le fichier</a>
                        <?php endif; ?>
                        <a href="javascript:void(0);" onclick="toggleDetails(<?= $devi['idDevis'] ?>)" class="commande-détails">Voir détails</a>
                        <form method="POST" action="SupprimerDevis" style="display: inline; margin: 0; padding: 0; border: none; background: none;" onsubmit="return confirmerSuppressionCommande('<?= htmlspecialchars($devi['idDevis']) ?>')">
                            <input type="hidden" name="idDevis" value="<?= $devi['idDevis'] ?>">    
                            <button type="submit" name="supprimer_devis" class="bouton-supprimer">
                                Supprimer
                            </button>
                        </form>
                    </div>
                    <div id="details-<?= $devi['idDevis'] ?>" style="display: none; width: 100%; margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; color: #555;">
                        <strong>Détails :</strong><br>
                        <?= nl2br(htmlspecialchars($devi['details'] ?? 'Aucun détail.')) ?>
                    </div>
                </div>
            <?php } ?>
        </div> </main>

    <script src="script.js"></script>
    <script>
        function confirmerSuppressionCommande(idDevis) {
            return confirm("Êtes-vous sûr de vouloir supprimer le devi '" + idDevis + "' ?\n\nCette action est irréversible.");
        }
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
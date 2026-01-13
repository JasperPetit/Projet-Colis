<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <?php include "DBconnect.php" ;?>

        <div class="titre">
            <h1>Mes Commandes</h1>
            <a href="pageAjouterCommande.php" class="btn-nouvelle-commande">
                <i class="fas fa-plus"></i> Nouvelle commande
            </a>
        </div>

        <input type="text" id="searchBar" onkeyup="filtrerCommandes()" placeholder="Rechercher une commande">

        <div id="listeCommandes">
            <?php
                $queryListeCommandes = $db->query("SELECT C.*, F.nomEntreprise, co.*
                                                    FROM Commande C 
                                                    LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
                                                    LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
                                                    JOIN Colis co USING (NumeroBonDeCommande)
                                                    ORDER BY C.Date_ DESC");
                $resListeCommandes = $queryListeCommandes->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($resListeCommandes as $commande) { ?>
                <div class="commande-card">
                    
                    <div class="commande-info">
                        <h3>Commande n°<?= htmlspecialchars($commande['NumeroBonDeCommande']) ?></h3>
                        
                        <p>📅 de livraison : <?= htmlspecialchars($commande['Date_']) ?></p>

                        <p>
                            📦 <?=$commande['nbColis']?>
                            👤 <?= !empty($commande['nomEntreprise']) ? htmlspecialchars($commande['nomEntreprise']) : 'Fournisseur inconnu' ?>
                        </p>

                    </div>
                    
                    <div class="commande-actions">
                        <?php
                            $statut = $commande['statut'];
                            $classeStatut = '';
                            
                            if ($statut == 'livré' || $statut == 'livré') {
                                $classeStatut = 'statut-livre';
                            } elseif ($statut == 'en_cours' || $statut == 'en_cours') {
                                $classeStatut = 'statut-en-cours';
                            } elseif ($statut == 'retard' || $statut == 'Retard' || $statut == 'retard') {
                                $classeStatut = 'statut-retard';
                            }
                        ?>

                        <span class="statue-colis <?= $classeStatut ?>">
                            <?= htmlspecialchars($statut) ?>
                        </span>

                        <p>📅 d'arrivée prévue : <?=$commande['DateAriveePrevu']?></p>

                        <a href="#pasFait" class="commande-détails">Voir détails</a>
                    </div>

                    <br>
                    <br>
                    
                </div>
            <?php } ?>
        </div>
    </main>

    <script src="script.js"></script>
    <script>
        function filtrerCommandes() {
            var input = document.getElementById("searchBar");
            var filter = input.value.toUpperCase();
            var container = document.getElementById("listeCommandes");
            var cards = container.getElementsByClassName("commande-card");

            for (var i = 0; i < cards.length; i++) {
                var h3 = cards[i].getElementsByTagName("h3")[0];
                var txtValue = h3.textContent || h3.innerText;
                cards[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    </script>
</body>
</html>
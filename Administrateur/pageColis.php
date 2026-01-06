<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de colis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <?php include "DBconnect.php" ;?>

        <div class="titre">
            <h1>Gestion de colis</h1>
        </div>

        <input type="text" id="searchBar" onkeyup="filtrerCommandes()" placeholder="Rechercher une commande">

        <div id="listeCommandes">
            <?php
                $queryListeCommandes = $db->query("SELECT co.*, F.nomEntreprise, C.statut, C.Date_ as DateCommande
                                                    FROM Colis co
                                                    JOIN Commande C ON co.NumeroBonDeCommande = C.NumeroBonDeCommande
                                                    LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
                                                    LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
                                                    ORDER BY co.idColis DESC"); 
                $resListeCommandes = $queryListeCommandes->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($resListeCommandes as $colis) { ?>
                <div class="colis-section">
                    
                    <div class="colis-info">
                        <h3>Colis n°<?= htmlspecialchars($colis['NumeroBonDeCommande']) ?></h3>
                        
                        <p>📅 de livraison : <?= htmlspecialchars($colis['DateCommande']) ?></p>

                        <p>
                            👤 Fournisseur : <?= !empty($colis['nomEntreprise']) ? htmlspecialchars($colis['nomEntreprise']) : 'Fournisseur inconnu' ?>
                        </p>

                    </div>
                    
                    <div class="commande-actions">
                        
                        <?php
                            $statut = $colis['statut'];
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

                        <p>📅 d'arrivée prévue : <?= htmlspecialchars($colis['DateAriveePrevu']) ?></p>
                        <a href="#" class="commande-détails">Voir détails</a>
                    </div>
                    <br>
                    <br>

                </div>
            <?php } ?>
        </div>
    </main>

    <script>
        function filtrerCommandes() {
            var input = document.getElementById("searchBar");
            var filter = input.value.toUpperCase();
            var container = document.getElementById("listeCommandes");
            var cards = container.getElementsByClassName("colis-section");

            for (var i = 0; i < cards.length; i++) {
                var h3 = cards[i].getElementsByTagName("h3")[0];
                var txtValue = h3.textContent || h3.innerText;
                cards[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }
    </script>
</body>
</html>
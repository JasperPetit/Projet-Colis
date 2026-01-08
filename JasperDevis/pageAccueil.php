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

        <h1 id="titre-accueil">Suivi Colis - IUT de Villetaneuse</h1> <br>

        <div class="conteneur-cartes-accueil">
            <div class="colis-en-attente">
                <h3>Colis en attente</h3>

                <?php 
                    $queryColisEnAttente = $db->query("SELECT * FROM Commande WHERE statut='en_cours'");
                    $resColisEnAttente = $queryColisEnAttente->fetchAll(PDO::FETCH_ASSOC);
                    echo "<p>" . count($resColisEnAttente) ."</p>";                
                ?>

            </div>


            <div class="commande-en-cours">
                <h3>Commande en cours</h3>

                <?php
                    $queryColisEnCours = $db->query("SELECT * FROM Commande WHERE ConfirmerOuiOuNon='0'");
                    $resColisEnCours = $queryColisEnCours->fetchAll(PDO::FETCH_ASSOC);
                    echo "<p>" . count($resColisEnCours) ."</p>";
                ?>

            </div>

            <div class="commande-en-retard">
                <h3>Commande en retard</h3>

                <?php
                    $queryColisEnCours = $db->query("SELECT * FROM Commande WHERE statut='retard'");
                    $resColisEnCours = $queryColisEnCours->fetchAll(PDO::FETCH_ASSOC);
                    echo "<p>" . count($resColisEnCours) ."</p>";
                ?>

            </div>


            <div class="dernier-colis-livré">
                <h3>Dernier colis livré</h3>

                <?php
                    $queryDernierColis = $db->query("SELECT * FROM Commande WHERE statut = 'livré' ORDER BY Date_ DESC, NumeroBonDeCommande DESC LIMIT 1");
                    $resDernierColis = $queryDernierColis->fetch(PDO::FETCH_ASSOC);
                    echo "<p>Bon de commande :</p>";
                    echo "<p><strong>nº " . $resDernierColis["NumeroBonDeCommande"] ."</strong></p>";
                    echo "<p><em>Livré le " . $resDernierColis["Date_"] . ".</em></p>"
                ?>
            </div>
        </div>
    </main>
</body>
</html>
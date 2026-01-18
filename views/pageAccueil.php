

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis - Accueil</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1 id="titre-accueil">Suivi Colis - IUT de Villetaneuse</h1> <br>

        <div class="conteneur-cartes-accueil">
            <div class="colis-en-attente">
                <h3>Colis en attente</h3>
                <p><?= $nbAttente ?></p>                
            </div>

            <div class="commande-en-cours">
                <h3>Commande en cours</h3>
                <p><?= $nbEnCours ?></p>
            </div>

            <div class="commande-en-retard">
                <h3>Commande en retard</h3>
                <p><?= $nbRetard ?></p>
            </div>

            <div class="dernier-colis-livré">
                <h3>Dernier colis livré</h3>

                <?php if ($dernierColis): ?>
                    <p>Bon de commande :</p>
                    <p><strong>nº <?= htmlspecialchars($dernierColis["NumeroBonDeCommande"]) ?></strong></p>
                    <p><em>Livré le <?= htmlspecialchars($dernierColis["Date_"]) ?>.</em></p>
                <?php else: ?>
                    <p>Aucun colis livré.</p>
                <?php endif; ?>
                
            </div>
        </div>
    </main>
</body>
</html>
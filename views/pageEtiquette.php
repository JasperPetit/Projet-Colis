

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bordereau</title>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fichierCSS/etiquette.css">
</head>
<body>

    <div class="etiquette">
        <div class="header">
            <div class="logo">SERVICE POSTAL</div>
            <div class="date">Date : <?php echo $colis['Date_']; ?></div>
        </div>

        <div class="infos-grid">
            <div class="case">
                <div class="titre-section">Poids</div>
                <strong><?php echo $colis['Poids']; ?> KG</strong>
            </div>
            <div class="case">
                <div class="titre-section">Format</div>
                STANDARD
            </div>
            <div class="case">
                <div class="titre-section">Expéditeur</div>
                Siège Social<br> Université Sorbonne Paris Nord
            </div>
        </div>

        <div class="destinataire">
            <div class="titre-section">Adresse de livraison :</div>
            <div class="adresse-grosse">
                <?php echo htmlspecialchars($colis['AdresseArivee']); ?>
            </div>
        </div>

        <div class="footer">
            <div class="code-barres">*<?php echo $colis['NumeroBonDeCommande']; ?>*</div>
            <div class="numero-lisible"><?php echo $colis['NumeroBonDeCommande']; ?></div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>
<?php
require_once 'config.php';
require_once 'services/ExpeditionService.php';

// 1. Vérification de sécurité
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur : Aucun numéro de commande fourni.");
}

$id = htmlspecialchars($_GET['id']);
$colis = null;

// 2. Récupération des données via ton Service
try {
    $service = new ExpeditionService($db);
    // On réutilise ta fonction de recherche qui marche bien
    $resultats = $service->rechercherEtiquettes($id);
    
    if (!empty($resultats)) {
        // On prend le premier résultat (car l'ID est unique)
        $colis = $resultats[0];
    } else {
        die("Erreur : Colis introuvable.");
    }
} catch (Exception $e) {
    die("Erreur système : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bordereau #<?php echo $id; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- CONFIGURATION DE LA PAGE D'IMPRESSION --- */
        @page {
            size: A6 landscape; /* Format Étiquette (10x15cm) */
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0; /* Gris à l'écran */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* --- LE STYLE DE L'ÉTIQUETTE --- */
        .etiquette {
            width: 148mm;  /* Largeur A6 */
            height: 105mm; /* Hauteur A6 */
            background: white;
            padding: 5mm;
            box-sizing: border-box;
            border: 2px solid #000;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* En-tête (Logo + Date) */
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .logo { font-weight: bold; font-size: 1.2rem; text-transform: uppercase; }
        .date { font-size: 0.9rem; }

        /* Bloc Destinataire (Gros) */
        .destinataire {
            flex: 1;
            padding: 10px;
            border: 2px solid #000;
            margin-bottom: 10px;
        }
        .titre-section { font-size: 0.8rem; text-transform: uppercase; color: #555; margin-bottom: 5px; }
        .adresse-grosse { font-size: 1.4rem; font-weight: bold; line-height: 1.3; }

        /* Infos Colis (Poids / Expéditeur) */
        .infos-grid {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        .case { border: 1px solid #000; padding: 5px; flex: 1; }

        /* Pied de page (Code Barres) */
        .footer {
            text-align: center;
            margin-top: auto; /* Pousse vers le bas */
        }
        
        .code-barres {
            font-family: 'Libre Barcode 39', cursive;
            font-size: 3rem; /* Taille du code barres */
            white-space: nowrap;
        }
        
        .numero-lisible {
            font-size: 1rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        /* --- CACHER LES ÉLÉMENTS INUTILES À L'IMPRESSION --- */
        @media print {
            body { background: white; height: auto; display: block; }
            .etiquette { border: none; width: 100%; height: 100%; }
            .no-print { display: none; }
        }
    </style>
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
                Siège Social<br> Université Sorbonne Paris Nord</br>
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
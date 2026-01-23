<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Colis - Suivi Colis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main>
        <h1><i class="fas fa-box-open"></i> Modifier le Colis</h1>
        <p>Modification des détails techniques pour le colis n°<?= htmlspecialchars($colis['idColis'] ?? '') ?></p>

        <?php if (isset($erreur) && $erreur): ?>
            <div style="color: #991B1B; background: #FEE2E2; padding: 15px; border-radius: 10px; border: 1px solid #F87171; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=ModifierColis&idColis=<?= htmlspecialchars($colis['idColis']) ?>" method="POST">
    
            <label for="idColis">Numéro de Colis (non modifiable) :</label>
            <input type="text" id="idColis" value="<?= htmlspecialchars($colis['idColis'] ?? '') ?>" readonly style="background-color: #f1f5f9; cursor: not-allowed;">
            <br>
            
            <label for="num_commande">Lié à la commande :</label>
            <input type="text" id="num_commande" value="<?= htmlspecialchars($colis['NumeroBonDeCommande'] ?? '') ?>" readonly style="background-color: #f1f5f9; cursor: not-allowed;">
            <br>

            <label for="taille"><i class="fas fa-ruler-vertical"></i> Taille (cm) :</label>
            <input type="number" id="taille" name="Taille" step="0.01" placeholder="Ex: 120.5"
                   value="<?= htmlspecialchars($colis['Taille'] ?? '') ?>" required>
            <br>

            <label for="poids"><i class="fas fa-weight-hanging"></i> Poids (kg) :</label>
            <input type="number" id="poids" name="Poids" step="0.01" placeholder="Ex: 15.00"
                   value="<?= htmlspecialchars($colis['Poids'] ?? '') ?>" required>
            <br>

            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <button type="submit" class="btn-nouvelle-commande">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                
                <a href="javascript:history.back()" class="btn-reinitialiser" style="text-decoration: none; display: flex; align-items: center;">
                    <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Annuler
                </a>
            </div>
        </form>
    </main>
</body>
</html>
<?php 


    if (!$fournisseur) {
        header("Location: afficherFournisseur");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Fournisseur - <?= htmlspecialchars($fournisseur['nomEntreprise']) ?></title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1>Modifier le Fournisseur</h1>
        
        <?php if ($erreur): ?>
            <div style="color: red; background: #fee2e2; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <form action="ModifierFournisseur?modifier=<?= $fournisseur['idFournisseur'] ?>" method="POST">
            <input type="hidden" name="idFournisseur" value="<?= $fournisseur['idFournisseur'] ?>">
    
            <label for="nom_entreprise">Nom du fournisseur :</label>
            <input type="text" id="nom_entreprise" name="nomEntreprise" 
                   value="<?= htmlspecialchars($fournisseur['nomEntreprise']) ?>" required>
            <br>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" 
                   value="<?= htmlspecialchars($fournisseur['adresse']) ?>" required>
            <br>

            <label for="num_telephone">Numéro de téléphone :</label>
            <input type="text" id="num_telephone" name="NumeroTelephone" 
                   value="<?= htmlspecialchars($fournisseur['NumeroTelephone']) ?>" required>
            <br>

            <label for="mail_entrprise">Mail du fournisseur :</label>
            <input type="text" id="mail_entrprise" name="Mail" 
                   value="<?= htmlspecialchars($fournisseur['Mail']) ?>" required>
            <br>

            <div style="display: flex; gap: 10px;">
                <button type="submit">Enregistrer les modifications</button>
                <a href="afficherFournisseur" class="btn-reinitialiser" style="text-decoration:none;">Annuler</a>
            </div>
        </form>
    </main>
</body>
</html>
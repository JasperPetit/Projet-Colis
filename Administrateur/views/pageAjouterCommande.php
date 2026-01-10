<?php 
    require_once "../config/DBconnect.php"; 
    require_once "../models/CommandeModel.php"; 
    require_once "../controllers/AjoutCommandeController.php"; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis - Ajouter Commande</title>
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1>Ajout de Commande</h1>

        <?php if ($erreur): ?>
            <div style="color: red; background: #fee2e2; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <form action="pageAjouterCommande.php" method="POST">
    
            <label for="num_commande">Numéro de commande :</label>
            <input type="text" id="num_commande" name="NumeroBonDeCommande" placeholder="ex: CMD-2025-00" required>
            <br>

            <label for="date">Date de commande :</label>
            <input type="date" id="date" name="Date_" required>
            <br>

            <label for="nb_colis">Nombre de colis :</label>
            <input type="number" id="nb_colis" name="nbColis" min="1" value="1">
            <br>

            <label for="fournisseur">Fournisseur :</label>
            <select id="fournisseur" name="idFournisseur">

                <?php foreach ($resNomEntreprise as $entreprise): ?>
                    <option value="<?= $entreprise['idFournisseur'] ?>">
                        <?= htmlspecialchars($entreprise['nomEntreprise']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
            <br>

            <label for="adresse">Adresse d'arrivée :</label><br>
            <textarea id="adresse" name="AdresseArivee" rows="3" required></textarea>
            <br>

            <button type="submit">Enregistrer la commande</button>
        </form>
    </main>
</body>
</html>
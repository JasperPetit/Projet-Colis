

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commande - Suivi Colis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1><i class="fas fa-edit"></i> Modifier la Commande</h1>
        <p>Modification des informations pour la coammande n°<?= htmlspecialchars($commande['NumeroBonDeCommande'] ?? '') ?></p>

        <?php if ($erreur): ?>
            <div style="color: #991B1B; background: #FEE2E2; padding: 15px; border-radius: 10px; border: 1px solid #F87171; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <form action="ModifierCommande?modifier=<?= htmlspecialchars($commande['NumeroBonDeCommande']) ?>" method="POST">
    
            <label for="num_commande">Numéro de commande (non modifiable) :</label>
            <input type="text" id="num_commande" name="NumeroBonDeCommande" 
                   value="<?= htmlspecialchars($commande['NumeroBonDeCommande'] ?? '') ?>" readonly style="background-color: #f1f5f9;">
            <br>
            
            <label for="idDevis">Sélectionner le devis :</label>
            <select name="idDevis" id="idDevis" required>
                <option value="">Choisir un devis</option>
                <?php foreach ($listeDevis as $devis): ?>
                    <option value="<?= $devis['idDevis'] ?>" 
                        <?= (isset($commande) && $commande['idDevis'] == $devis['idDevis']) ? 'selected' : '' ?>>
                        Devis n°<?= htmlspecialchars($devis['idDevis']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>


            <input type="hidden" name="ancienDevis" value="<?= $commande['imageBonDeCommande'] ?>">

            <br>

            <label for="date">Date d'arrivée prévue :</label>
            <input type="date" id="date" name="DateArrivee" 
                   value="<?= htmlspecialchars($commande['Date_'] ?? '') ?>" required>
            <br>

            <label for="nb_colis">Nombre de colis :</label>
            <input type="number" id="nb_colis" name="nbColis" min="1" 
                   value="<?= htmlspecialchars($commande['nbColis'] ?? '1') ?>">
            <br>

            <label>Fichier du bon de commande (pdf,jpg,jpeg):</label>
            <input type="file" name="ImageCommande" accept=".pdf, .jpg, .jpeg" 
                    value="<?=   $commande['imageBonDeCommande'] ?>">
            <br>

            <label for="adresseDepart">Adresse de départ :</label>
            <input type="text" id="adresseDepart" name="AdresseDepart" 
                   value="<?= htmlspecialchars($commande['AdresseDepart'] ?? '') ?>" required>
            <br>

            <label for="adresseArrivee">Adresse d'arrivée :</label>
            <input type="text" id="adresseArrivee" name="AdresseArivee" 
                   value="<?= htmlspecialchars($commande['AdresseArivee'] ?? '') ?>" required>
            <br>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-nouvelle-commande">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="afficherCommande" class="btn-reinitialiser" style="text-decoration: none;">
                    Annuler
                </a>
            </div>
        </form>
    </main>
</body>
</html>
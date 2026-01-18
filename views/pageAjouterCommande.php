

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis - Ajouter Commande</title>
    <link rel="stylesheet" href="public/style.css">
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

        <form action="AjouterCommande" method="POST" enctype="multipart/form-data">
    
            <label for="num_commande">Numéro de commande :</label>
            <input type="text" id="num_commande" name="NumeroBonDeCommande" placeholder="ex: CMD-2025-00" required>
            <br>
            
            <label for="idDevis">Sélectionner le devis :</label>
            <select name="idDevis" id="idDevis" required>

                <option value="">Choisir un devis</option>
                <?php foreach ($listeDevis as $devis): ?>
                    <option value="<?= $devis['idDevis'] ?>">
                        Devis n°<?= htmlspecialchars($devis['idDevis']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
            <br>

            <label for="date">Date de commande :</label>
            <input type="date" id="date" name="DateArrivee" required>
            <br>

            <label for="nb_colis">Nombre de colis :</label>
            <input type="number" id="nb_colis" name="nbColis" min="1" value="1">
            <br>

            <label>Fichier du bon de commande (pdf,jpg,jpeg):</label>
            <input type="file" name="ImageCommande" accept=".pdf, .jpg, .jpeg" required>
            <br>

            <label for="adresse">Adresse de départ :</label>
            <input type="text" id="adresseDepart" name="AdresseDepart" rows="3" required></input>
            <br>

            <label for="adresse">Adresse d'arrivée :</label>
            <input type="text" id="adresseArrivee" name="AdresseArivee" rows="3" required></input>
            <br>

            <button type="submit">Enregistrer la commande</button>
        </form>
    </main>
</body>
</html>
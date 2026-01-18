<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>

        <?php //include "DBconnect.php" ;?>

        <h1>Ajout de Devis</h1>
        <?php if (isset($_GET['error']) && $_GET['error'] == 'doublon') : ?>
            <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f87171;">
                <strong>Erreur :</strong> Ce numéro de devis existe déjà ! Veuillez en choisir un autre.
            </div>
        <?php endif; ?>

        <form action="ajouter_devis" method="POST" enctype="multipart/form-data">
    
            <label for="num_devis">Numéro de devis :</label>
            <input type="text" id="num_devis" name="NumeroDevis" placeholder="ex: CMD-2025-001" required>
            <br>

            <label for="nom">Nom du projet :</label>
            <input type="text" id="nom" name="name" required>
            <br>


            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" step="any" required>
            <br>

            <label for="fournisseur">Fournisseur :</label>
            <select id="fournisseur" name="idFournisseur">

                <?php foreach ($resFournisseurs as $entreprise) { ?>

                    <option value="<?=$entreprise['idFournisseur']?>"><?= $entreprise['nomEntreprise'] ?></option>

                <?php } ?>

            </select>
            <br>

            <label>Lien du devis (pdf,jpg,jpeg):</label>
            <input type="file" name="ImageDevis" accept=".pdf, .jpg, .jpeg" required>
            <br>


            <label for="details">Details sur le projet :</label>
            <textarea id="details" name="details" rows="4"></textarea>
            <br>

            <button type="submit">Enregistrer le devis</button>

            <? echo $_SERVER["REQUEST_URI"]; ?>
        </form>
    </main>
</body>
</html>
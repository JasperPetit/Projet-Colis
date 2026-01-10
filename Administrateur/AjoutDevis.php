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

        <h1>Ajout de Commande</h1>

        <?php 
            $queryNomEntreprise = $db->query("SELECT nomEntreprise FROM Fournisseur");
            $resNomEntreprise = $queryNomEntreprise->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <form action="pageAjouterCommande.php" method="POST">
    
            <label for="num_devis">Numéro de commande :</label>
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

                <?php foreach ($resNomEntreprise as $entreprise) { ?>

                    <option value="<?=$entreprise['nomEntreprise']?>"><?= $entreprise['nomEntreprise'] ?></option>

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
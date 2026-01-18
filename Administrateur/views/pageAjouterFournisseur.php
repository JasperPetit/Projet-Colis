<?php 
    require_once "../Administrateur/config/DBconnect.php";            
    require_once "../Administrateur/models/FournisseurModel.php"; 
    require_once "../Administrateur/controllers/AjoutFournisseurController.php"; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis - Nouveau Fournisseur</title>
    <link rel="stylesheet" href="../Administrateur/public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1>Ajout de nouveau Fournisseur</h1>

        <form action="pageAjouterFournisseur.php" method="POST">
    
            <label for="nom_entreprise">Nom du fournisseur :</label>
            <input type="text" id="nom_entreprise" name="nomEntreprise" placeholder="Entrer le nom de l'entreprise..." required>
            <br>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" placeholder="Entrer l'adresse de l'entreprise..." required>
            <br>

            <label for="num_telephone">Numéro de téléphone :</label>
            <input type="text" id="num_telephone" name="NumeroTelephone" placeholder="Entrer le numéro de téléphone..." required>
            <br>

            <label for="mail_entrprise">Mail du fournisseur :</label>
            <input type="text" id="mail_entrprise" name="Mail" placeholder="Entrer l'adresse mail..." required>
            <br>

            <button type="submit">Enregistrer le fournisseur</button>

        </form>
    </main>
</body>
</html>
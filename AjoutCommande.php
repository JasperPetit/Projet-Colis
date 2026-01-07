<?php 
require_once 'db.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
<h1>Bienvuenue sur la page d'ajout de commande</h1>


<form action="infosCommande.php" method="POST">

    <h2>Ajouter une commandee</h2>

    <label>Numéro Bon de Commande :</label>
    <input type="number" name="NumeroBonDeCommande" required><br>


    <label>Adresse de Départ (Fournisseur) :</label>
    <input type="text" name="AdresseDepart" required><br>

    <label>Adresse d'Arrivée (Département) :</label>
    <input type="text" name="AdresseArivee" placeholder="99 Av. J.B. Clément, 93430 Villetaneuse" required><br>

    <label>Nombre de colis (le nombre de colis indiqué sur le devis, sinon 1):</label>
    <input type="number" name="nbColis"  required><br>

    <label>Lien image :</label>
    <input type="file" name="image_file" accept=".pdf, .jpg, .jpeg" required><br>

    <button type="submit">Ajouter la commande</button>

</form>
</body>
</html>
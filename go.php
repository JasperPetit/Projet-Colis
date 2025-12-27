<?php require_once 'db.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Bienvuenue sur la page demandeur</h1>

<h2>Ajouter un colis</h2>

<form action="infos.php" method="POST">
    <label for="NCommande">Numero de la commade : </label>    
    <input type="text" name="NCommande" placeholder="12345">
    
    <label for="Taille">Taille du colis: </label>    
    <input type="text" name="Taille" placeholder="20">
    
    <label for="Poids">Poids du colis : </label>    
    <input type="text" name="Poids" placeholder="15">

    <label for="dateArr">Date d'arrivée prévu du colis : </label>    
    <input type="date" name="dateArr">

    <button type="submit" >Envoyer</button>

</form>





</body>
</html>
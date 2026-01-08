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
    
            <label for="num_commande">Numéro de commande :</label>
            <input type="text" id="num_commande" name="NumeroBonDeCommande" placeholder="ex: CMD-2025-001" required>
            <br>

            <label for="date">Date de commande :</label>
            <input type="date" id="date" name="Date_" required>
            <br>

            <label for="nb_colis">Nombre de colis :</label>
            <input type="number" id="nb_colis" name="nbColis" min="1" value="1">
            <br>

            <label for="fournisseur">Fournisseur :</label>
            <select id="fournisseur" name="idFournisseur">

                <?php foreach ($resNomEntreprise as $entreprise) { ?>

                    <option value="<?=$entreprise['nomEntreprise']?>"><?= $entreprise['nomEntreprise'] ?></option>

                <?php } ?>

            </select>
            <br>

            <label for="adresse">Adresse d'arrivée :</label><br>
            <textarea id="adresse" name="AdresseArivee" rows="3"></textarea>
            <br>

            <button type="submit">Enregistrer la commande</button>

        </form>
    </main>
</body>
</html>
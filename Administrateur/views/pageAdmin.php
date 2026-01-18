<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de colis</title>
    <link rel="stylesheet" href="../Administrateur/public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <main>
        <div class="titre">
            <h1>Administration</h1>
        </div>

        <div id="gestion-utilisateurs">
            <h3>Gestion des utilisateurs</h3>
            <p>Gérez les comptes utilisateurs et leurs permissions</p>
            <a href="pageVoirUtilisateurs.php"><button>Voir les utilisateurs</button></a>
            <a href="pageAjouterUtilisateur.php"><button>Ajouter utilisateur</button></a>
        </div>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <main>
        <div class="titre">
            <h1>Ajouter un utilisateur</h1>
        </div>

        <div id="gestion-utilisateurs">
            <h3>Nouvel utilisateur</h3>
            <p>Complétez le formulaire pour créer un nouveau compte utilisateur</p>

            <?php if ($erreur): ?>
                <div style="color: red; padding: 10px; margin: 10px 0; border: 1px solid red; border-radius: 5px; background-color: #f8d7da;">
                    <?= htmlspecialchars($erreur) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required><br>

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required><br>

                <label for="role">Rôle :</label>
                <input type="text" id="role" name="Role" required><br>

                <label for="mdpCAS">Mot de passe :</label>
                <input type="password" id="mdpCAS" name="mdpCAS" required><br>

                <div style="display: flex; gap: 10px;">
                    <button type="submit">Ajouter l'utilisateur</button>
                    <a href="pageAdmin"><button type="button" style="background-color: var(--text-muted);">Annuler</button></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
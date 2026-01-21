<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Site de suivi de colis USPN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="fichierCSS/style.css">
    <link rel="stylesheet" href="fichierCSS/login.css">
</head>
<body class="page-login">
    <div class="conteneur-connexion">
        <div class="entete-connexion">
            <img src="data/logo.png" alt="Logo">
            <h1>Ouvrir une session</h1>
            <p>Université Sorbonne Paris Nord</p>
        </div>

        <div class="corps-connexion">
            <?php if (!empty($erreur)): ?>
                <div class="message-erreur">
                    <i class="fa fa-circle-exclamation"></i>
                    <span><?php echo $erreur; ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?action=connexion">
                <div class="groupe-input">
                    <label>Identifiant CAS</label>
                    <div class="conteneur-input">
                        <i class="fa fa-user"></i>
                        <input type="text" name="identifiant" placeholder="Entrez votre identifiant" required>
                    </div>
                </div>

                <div class="groupe-input">
                    <label>Mot de passe</label>
                    <div class="conteneur-input">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="mot_de_passe" placeholder="Entrez votre mot de passe" required>
                    </div>
                </div>

                <button type="submit" class="bouton-connexion">
                    <i class="fa fa-sign-in-alt"></i> Se connecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>
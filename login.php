<?php
session_start();
require_once 'config.php';

$erreur = '';


if (isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];
    
    if ($identifiant !== '' && $mot_de_passe !== '') {
        try {
            $sql = "SELECT * FROM Utilisateur WHERE identifiantCAS = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $identifiant, SQLITE3_TEXT);
            $resultat = $stmt->execute();
            $utilisateur = $resultat->fetchArray(SQLITE3_ASSOC);
            

            if ($utilisateur && $utilisateur['mdpCAS'] == $mot_de_passe) {

                $_SESSION['utilisateur_id'] = $utilisateur['identifiantCAS'];
                $_SESSION['nom_complet'] = $utilisateur['Prenom'] . ' ' . $utilisateur['nom'];
                $_SESSION['role'] = $utilisateur['Role'];
                
                header('Location: index.php');
                exit();
            } else {
                $erreur = 'Identifiant ou mot de passe incorrect';
            }
        } catch (Exception $e) {
            $erreur = 'Erreur de connexion à la base de données';
        }
    } else {
        $erreur = 'Veuillez remplir tous les champs';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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




            <form method="POST" >
                <div class="groupe-input">
                    <a >Identifiant CAS</a>
                    <div class="conteneur-input">
                        <i class="fa fa-user"></i>
                        <input type="text" name="identifiant" placeholder="Entrez votre identifiant" required>
                    </div>
                </div>

                <div class="groupe-input">
                    <a >Mot de passe</a>
                    <div class="conteneur-input">
                        <i class="fa fa-lock"></i>
                        <input type="password"  name="mot_de_passe" placeholder="Entrez votre mot de passe" required>
                    </div>
                </div>

                <button type="submit" class="bouton-connexion">
                    <i class="fa fa-sign-in-alt"></i> Se connecter
                </button>
            </form>
        </div>

        <div class="pied-connexion">
            © 2026 Université Sorbonne Paris Nord
        </div>
    </div>
</body>
</html>
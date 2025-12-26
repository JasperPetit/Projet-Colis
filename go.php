<?php
// 1. On démarre la session PHP pour garder les infos en mémoire
session_start();

// 2. On récupère les informations envoyées par Apache
// $_SERVER['REMOTE_USER'] contient le login (ex: jdupont)
$login = $_SERVER['REMOTE_USER'] ?? null;

// $_SERVER['HTTP_CAS_DISPLAYNAME'] contient le nom complet (ex: Jean Dupont)
$nomComplet = $_SERVER['HTTP_CAS_DISPLAYNAME'] ?? 'Invité';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Page Protégée</title>
    <style>
        body { font-family: sans-serif; margin: 40px; line-height: 1.6; }
        .card { border: 1px solid #ccc; padding: 20px; border-radius: 8px; background: #f9f9f9; }
        .highlight { color: #0056b3; font-weight: bold; }
    </style>
</head>
<body>

    <div class="card">
        <h1>Espace Privé de l'Université</h1>

        <?php if ($login): ?>
            <p>Félicitations, vous êtes connecté !</p>
            <ul>
                <li>Votre identifiant (UID) : <span class="highlight"><?php echo $login; ?></span></li>
                <li>Votre identité : <span class="highlight"><?php echo $nomComplet; ?></span></li>
            </ul>
            
            <hr>
            <p>Cette page n'est visible <strong>que</strong> par les membres de l'université.</p>
            
            <p><a href="https://cas.univ-votre-etab.fr/cas/logout">Se déconnecter du CAS</a></p>
            
        <?php else: ?>
            <p>Si vous voyez ce message, c'est que la protection Apache est mal configurée.</p>
        <?php endif; ?>
    </div>

</body>
</html>
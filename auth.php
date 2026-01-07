<?php
/**
 * Exemple d'intégration phpCAS
 */

// 1. Chargement de la librairie via Composer
require_once 'vendor/autoload.php';

// 2. Configuration du serveur CAS
$cas_host = 'cas.mon-etablissement.fr';
$cas_port = 443;
$cas_context = '/cas';

// 3. Initialisation du client phpCAS
// On utilise CAS_VERSION_2_0 ou CAS_VERSION_3_0 selon votre serveur
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

// 4. Sécurité SSL (IMPORTANT)
// En développement : phpCAS::setNoCasServerValidation();
// En production :
// phpCAS::setCasServerCACert('/chemin/vers/certificat_ca.pem');
phpCAS::setNoCasServerValidation(); 

// 5. Gestion de la déconnexion
if (isset($_GET['logout'])) {
    phpCAS::logout();
}

// 6. Forcer l'authentification
// Si l'utilisateur n'est pas connecté, il est redirigé vers le serveur CAS
phpCAS::forceAuthentication();

// --- À ce stade, l'utilisateur est forcément authentifié ---
$username = phpCAS::getUser();
$attributes = phpCAS::getAttributes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Page Sécurisée CAS</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        .card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; background: #f9f9f9; }
        .logout-btn { color: white; background: #d9534f; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>

    <h1>Espace Personnel</h1>
    
    <div class="card">
        <p>Bienvenue, <strong><?php echo htmlspecialchars($username); ?></strong> !</p>
        
        <h3>Vos informations (Attributs) :</h3>
        <ul>
            <?php foreach ($attributes as $key => $value): ?>
                <li><strong><?php echo htmlspecialchars($key); ?> :</strong> 
                    <?php echo is_array($value) ? implode(', ', $value) : htmlspecialchars($value); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <p style="margin-top: 20px;">
        <a href="?logout=" class="logout-btn">Se déconnecter</a>
    </p>

</body>
</html>
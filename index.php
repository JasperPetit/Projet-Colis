<?php
// index.php - LE ROUTEUR
session_start();
define('ROOT', __DIR__);

// 1. Connexion BDD
require_once 'config/DBconnect.php';

// 2. Chargement des Modèles (Tes fonctions SQL)
require_once 'models/ColisModel.php';
require_once 'models/CommandeModel.php';
require_once 'models/FournisseurModel.php';
require_once 'models/UtilisateurModel.php';
require_once 'models/Devis.php'; 

// 3. Récupération de la page
$page = $_GET['page'] ?? $_GET['action'] ?? 'accueil';

// --- ZONE DE TRAITEMENT (Controllers) ---

// Traitement Jasper (Devis) - Cas spécial car orienté Objet
if ($page === 'ajouter_devis_traitement') {
    require_once 'controllers/DevisController.php';
    $controller = new \App\Controllers\DevisController($db);
    $controller->AjouterDevis(); // Gère l'ajout et la redirection
    exit();
}

// --- ZONE D'AFFICHAGE (Views) ---

// On commence le HTML (Header + Navbar)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSA Digital Solution</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<main>
<?php

switch($page) {
    case 'accueil':
        // On charge les données via le contrôleur
        require 'controllers/AccueilController.php'; 
        // Puis on affiche la vue
        require 'views/accueil.php';
        break;

    case 'commandes':
        require 'controllers/CommandeController.php';
        require 'views/mes_commandes.php';
        break;

    case 'ajouter_commande':
        require 'controllers/AjoutCommandeController.php';
        require 'views/ajouter_commande.php';
        break;

    case 'colis':
        require 'controllers/ColisController.php';
        require 'views/colis.php';
        break;

    case 'fournisseurs':
        require 'controllers/FournisseurController.php';
        require 'views/fournisseurs.php';
        break;
    
    case 'ajouter_fournisseur':
        require 'controllers/AjoutFournisseurController.php';
        require 'views/ajouter_fournisseur.php';
        break;

    case 'admin':
        // pageAdmin.php contenait sa propre logique, on l'inclut directement
        require 'views/admin.php';
        break;

    case 'voir_utilisateurs':
        require 'controllers/UtilisateurController.php';
        require 'views/voir_utilisateurs.php';
        break;

    case 'ajouter_utilisateur':
        require 'controllers/AjoutUtilisateurController.php';
        require 'views/ajouter_utilisateur.php';
        break;

    case 'finance':
        require 'views/service_financier.php';
        break;

    // Partie Jasper
    case 'mes_devis':
    case 'pageInfosDevis':
        require 'controllers/DevisController.php';
        $controller = new \App\Controllers\DevisController($db);
        $listeDevis = $controller->AfficherDevis(); // Tu devras peut-être adapter cette méthode dans DevisController
        require 'views/mes_devis.php';
        break;

    case 'ajouter_devis':
    case 'formulaire':
        require 'views/ajouter_devis.php';
        break;

    default:
        echo "<h1>Erreur 404</h1><p>Page introuvable.</p>";
        break;
}
?>
</main>

<script src="assets/js/script.js"></script>
</body>
</html>
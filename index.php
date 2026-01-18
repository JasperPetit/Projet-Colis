<?php 

require_once 'autoload.php';

$pdo = require_once __DIR__ . '/config/DBconnect.php';
$routes = [
    'accueil' => ['AccueilController','AfficherAccueil'],
    'ajouter_devis' => ['DevisController','AjouterDevis'],
    //action sur les commandes
    'afficherCommande' => ['CommandeController','afficherCommande'],
    'SupprimerCommande' => ['CommandeController','SupprimerCommande'],
    'AjouterCommande' => ['CommandeController','ajouterCommande'],
    'ModifierCommande' => ['CommandeController','ModifierCommande'],

    //devis
    'ajouter_devis' => ['DevisController','AjouterDevis'],
    'formulaireDevis' => ['DevisController','AfficherFormulaire'],
    'pageInfosDevis' => ['DevisController','AfficherDevis'],
    'SupprimerDevis' => ['DevisController','SupprimerDevis'],

    //colis
    'afficherColis' => ['ColisController', 'afficherColis'],

    //fournisseur
    'afficherFournisseur' => ['FournisseurController','AfficherFournisseur'],
    'ajouterFournisseur' => ['FournisseurController','ajouterFournisseur'],
    'ModifierFournisseur' => ['FournisseurController','ModifierFournisseur'],
    'SupprimerFournisseur' => ['FournisseurController','SupprimerFournisseur'],

    //admin
    'pageAdmin' => ['UtilisateurController','AfficherAdmin'],
    'pageVoirUtilisateurs' => ['UtilisateurController','AfficherListe'],
    'pageAjouterUtilisateur' => ['UtilisateurController','AjouterUtilisateur']


];
$action = $_GET['action'] ?? 'accueil';

if (array_key_exists($action, $routes)) {
    
    $simpleControllerName = $routes[$action][0];
    $methodName           = $routes[$action][1];

    // On reconstitue le Namespace complet : App\Controllers\NomController
    $controllerClass = "App\\Controllers\\" . $simpleControllerName;

    // L'autoload va se déclencher automatiquement ici grâce au class_exists !
    if (class_exists($controllerClass)) {
        
        // Instanciation
        $controller = new $controllerClass($pdo);
        
        // Appel de la méthode
        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            die("Erreur : La méthode $methodName n'existe pas.");
        }

    } else {
        die("Erreur : Le contrôleur $controllerClass est introuvable (Vérifie le namespace ou le nom du fichier).");
    }

} else {
    // Gestion 404 simple
    echo $_GET['action'];
    echo "<h1>Page introuvable</h1>";
}



?>
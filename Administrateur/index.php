<?php 

require_once '../Administrateur/config/DBconnect.php';
/**require_once 'Devis.php';*/
/**require_once '../Administrateur/controllers/DevisController.php';*/
/**require_once '../Administrateur/controllers/AjoutCommandeController.php';*/


$routes = [
    'ajouter_devis' => ['DevisController','AjouterDevis'],
    'formulaire' => ['DevisController','AfficherFormulaire'],
    'formulaireCommande' => ['AjoutCommandeController','afficherFormulaire'],
    'AjouterCommande' => ['AjoutCommandeController','ajouterCommande'],
    'pageInfosDevis' => ['DevisController','AfficherDevis']
];

$action = $_GET['action'] ?? null;

if ($action && array_key_exists($action, $routes)) {
    $controllerName = $routes[$action][0];
    $methodName     = $routes[$action][1];

    require_once '../Administrateur/controllers/' . $controllerName . '.php';
    $controller = new $controllerName($db);
    $controller->$methodName();
} else {
    require_once '../Administrateur/views/pageAccueil.php';
}

?>
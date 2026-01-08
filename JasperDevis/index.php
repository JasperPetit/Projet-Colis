<?php 

require_once 'DBconnect.php';
require_once 'Devis.php';
require_once 'DevisController.php';


$routes = [
    'ajouter_devis' => ['DevisController','AjouterDevis'],
    'formulaire' => ['DevisController','AfficherFormulaire']
];

$action = $_GET['action'] ?? null;

if ($action && array_key_exists($action, $routes)) {
    $controllerName = $routes[$action][0];
    $methodName     = $routes[$action][1];

    require_once $controllerName . '.php';
    $controller = new $controllerName($db);
    $controller->$methodName();
} else {
    require_once 'pageAccueil.php';
}

?>
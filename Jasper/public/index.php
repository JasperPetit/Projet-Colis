<?php 

// 1. On définit la racine du projet (on remonte d'un cran depuis "public")
define('ROOT', dirname(__DIR__)); 

// 2. Autoloader (pour charger tes classes Controller, Model, Service automatiquement)
spl_autoload_register(function ($class_name) {
    // Liste des dossiers où chercher les classes
    $folders = [
        ROOT . '/src/Controller/',
        ROOT . '/src/Model/',
        ROOT . '/src/Service/'
    ];

    foreach ($folders as $folder) {
        $file = $folder . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// 3. On inclut la config (BDD) en utilisant ROOT
require_once ROOT . '/config/database.php';

// 4. Routage
$action = $_GET['action'] ?? 'accueil';


$routes = [
    'ajouter_devis' => ['DevisController','AjouterDevis'],
    'formulaire' => ['DevisController','AfficherFormulaire'],

    'pageInfosDevis' => ['DevisController','AfficherDevis']
];

$action = $_GET['action'] ?? null;

if ($action && array_key_exists($action, $routes)) {
    $controllerName = $routes[$action][0];
    $methodName     = $routes[$action][1];

    $controller = new $controllerName($db);
    $controller->$methodName();
} else {
    require_once ROOT . '/templates/pageAccueil.php';
}

?>
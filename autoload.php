<?php
/**
 * Fichier d'autoload pour les modèles et contrôleurs
 * À inclure dans chaque fichier qui utilise les classes MVC
 */

// Définition du chemin de base
define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);

// Inclusion automatique des modèles
require_once ROOT_PATH . 'models/FactureModel.php';
require_once ROOT_PATH . 'models/BudgetModel.php';

// Inclusion automatique des contrôleurs
require_once ROOT_PATH . 'controllers/DashboardController.php';
require_once ROOT_PATH . 'controllers/FactureController.php';
require_once ROOT_PATH . 'controllers/PaiementController.php';
?>

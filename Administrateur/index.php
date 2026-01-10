<?php 

require_once 'DBconnect.php';
require_once 'Devis.php';
require_once 'DevisController.php';

$action = $_GET['action'] ?? 'afficher_formulaire';

$path = $_SERVER["REQUEST_URI"];
?>
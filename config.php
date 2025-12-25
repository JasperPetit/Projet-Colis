<?php
// On affiche les erreurs pour comprendre si le chemin échoue encore
ini_set('display_errors', 1);
error_reporting(E_ALL);

// __DIR__ donne le dossier où se trouve config.php
// On ajoute ensuite le chemin vers le dossier data
$chemin_base_donnees = __DIR__ . '/data/database.db';

try {
    // On vérifie si le fichier existe vraiment avant d'essayer de l'ouvrir
    if (!file_exists($chemin_base_donnees)) {
        die("Erreur fatale : Le fichier de base de données est introuvable dans : " . $chemin_base_donnees);
    }

    $db = new SQLite3($chemin_base_donnees);
    
    // Optionnel : on active les contraintes de clés étrangères
    $db->exec('PRAGMA foreign_keys = ON;');
    
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


$nom_complet="medhi moi";

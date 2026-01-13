<?php
session_start(); 

ini_set('display_errors', 1);
error_reporting(E_ALL);

$chemin_base_donnees = __DIR__ . '/data/database.db';

try {
    if (!file_exists($chemin_base_donnees)) {
        die("Erreur : Le fichier de base de données est introuvable dans : " . $chemin_base_donnees);
    }
    
    $db = new SQLite3($chemin_base_donnees);
    $db->exec('PRAGMA foreign_keys = ON;');
    
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


$nom_complet = $_SESSION['nom_complet'] ?? 'Utilisateur';
$role_utilisateur = $_SESSION['role'] ?? '';
?>
<?php
try {
    // __DIR__ donne le chemin du dossier 'config'.
    // On remonte d'un cran (..) pour aller dans 'data'.
    $dbPath = __DIR__ . '/../data/database.db';

    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die(); // Arrête le script si la connexion échoue
}
?>
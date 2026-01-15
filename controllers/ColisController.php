<?php
// controllers/ColisController.php

// 1. On charge le modèle (indispensable pour avoir les fonctions)
require_once __DIR__ . '/../models/ColisModel.php';

// 2. On récupère les données
// ATTENTION : On ne met plus ($db) car le modèle utilise "global $db"
$resListeColis = getListeColisComplete();
$fournisseursFiltre = getFournisseursAyantColis();

// 3. Fonction utilitaire pour l'affichage (Couleur des badges)
// On ajoute "if (!function_exists...)" pour éviter les erreurs si elle est déjà chargée
if (!function_exists('getClasseStatutColis')) {
    function getClasseStatutColis($statut) {
        switch (strtolower($statut)) {
            case 'livré': return 'statut-livre';
            case 'en_cours': return 'statut-en-cours';
            case 'retard': return 'statut-retard';
            default: return '';
        }
    }
}

// 4. On charge la vue pour afficher la page
require_once __DIR__ . '/../views/colis.php';
?>
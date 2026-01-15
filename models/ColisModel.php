<?php
// models/ColisModel.php

// Fonction pour récupérer la liste complète des colis
function getListeColisComplete() {
    global $db; 

    $sql = "SELECT co.idColis, co.NumeroBonDeCommande, co.DateAriveePrevu, 
            F.nomEntreprise, C.statut, C.Date_ as DateCommande
            FROM Colis co
            JOIN Commande C ON co.NumeroBonDeCommande = C.NumeroBonDeCommande
            LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
            LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
            ORDER BY co.idColis DESC";

    // Vérification que $db existe bien
    if (!$db) { return []; }

    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour les filtres (fournisseurs ayant des colis)
function getFournisseursAyantColis() {
    global $db; 

    $sql = "SELECT DISTINCT F.nomEntreprise 
            FROM Fournisseur F 
            JOIN Commandé_a_ CA ON F.idFournisseur = CA.idFournisseur
            JOIN Commande C ON CA.idDevis = C.idDevis
            JOIN Colis co ON C.NumeroBonDeCommande = co.NumeroBonDeCommande
            WHERE F.nomEntreprise IS NOT NULL
            ORDER BY F.nomEntreprise";

    if (!$db) { return []; }

    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>
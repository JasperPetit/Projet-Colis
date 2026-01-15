<?php

    function getAllFournisseurs($db) {
        $sql = "SELECT F.idFournisseur, F.nomEntreprise, F.adresse, F.NumeroTelephone, F.Mail, 
                COUNT(CA.idDevis) as nb_commandes
                FROM Fournisseur F
                LEFT JOIN Commandé_a_ CA ON F.idFournisseur = CA.idFournisseur
                GROUP BY F.idFournisseur";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteFournisseur($db, $id) {
        $query = $db->prepare("DELETE FROM Fournisseur WHERE idFournisseur = ?");
        return $query->execute([$id]);
    }

    function ajouterFournisseur($db, $nom, $adresse, $tel, $mail) {
        // Calcul automatique de l'ID pour éviter les erreurs de clé primaire
        $sql = "INSERT INTO Fournisseur (idFournisseur, nomEntreprise, adresse, NumeroTelephone, Mail) 
                VALUES ((SELECT IFNULL(MAX(idFournisseur), 0) + 1 FROM Fournisseur), ?, ?, ?, ?)";
        $query = $db->prepare($sql);
        return $query->execute([$nom, $adresse, $tel, $mail]);
    }
    function getFournisseurs() {
    global $db; // <--- AJOUTE CETTE LIGNE
    // ...
    }

?>
<?php
    // Pour la page Fournisseurs
    function getAllFournisseurs($db) {
        $sql = "SELECT F.*, 
                (SELECT COUNT(*) FROM Commandé_a_ CA WHERE CA.idFournisseur = F.idFournisseur) as nb_commandes
                FROM Fournisseur F";
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



    // Pour la page Modifier Fournisseur
    function getFournisseurById($db, $id) {
        $query = $db->prepare("SELECT * FROM Fournisseur WHERE idFournisseur = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function modifierFournisseur($db, $id, $nom, $adresse, $tel, $mail) {
        $sql = "UPDATE Fournisseur SET 
                nomEntreprise = ?, 
                adresse = ?, 
                NumeroTelephone = ?, 
                Mail = ? 
                WHERE idFournisseur = ?";
        $query = $db->prepare($sql);
        return $query->execute([$nom, $adresse, $tel, $mail, $id]);
    }
?>
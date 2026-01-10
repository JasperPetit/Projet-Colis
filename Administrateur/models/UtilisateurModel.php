<?php
    // Pour la page VoirUtilisateurs
    function getAllUtilisateurs($db) {
        $sql = "SELECT * FROM Utilisateur";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteUtilisateur($db, $id) {
        $query = $db->prepare("DELETE FROM Utilisateur WHERE identifiantCAS = ?");
        return $query->execute([$id]);
    }



    // Pour la page AjouterUilisateur
    function ajouterUtilisateur($db, $prenom, $nom, $role, $mdp) {
        $sql = "INSERT INTO Utilisateur (Prenom, nom, Role, mdpCAS) VALUES (?, ?, ?, ?)";
        $query = $db->prepare($sql);
        return $query->execute([$prenom, $nom, $role, $mdp]);
    }
?>
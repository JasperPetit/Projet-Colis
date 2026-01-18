<?php
namespace App\Models;
use \PDO;
class UtilisateurModel {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    // Pour la page VoirUtilisateurs
    function getAllUtilisateurs() {
        $sql = "SELECT * FROM Utilisateur";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteUtilisateur($id) {
        $query = $this->pdo->prepare("DELETE FROM Utilisateur WHERE identifiantCAS = ?");
        return $query->execute([$id]);
    }



    // Pour la page AjouterUilisateur
    function ajouterUtilisateur( $prenom, $nom, $role, $mdp) {
        $sql = "INSERT INTO Utilisateur (Prenom, nom, Role, mdpCAS) VALUES (?, ?, ?, ?)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([$prenom, $nom, $role, $mdp]);
    }
}
?>
<?php
namespace App\Models;
use \PDO;
class FournisseurModel{

    private $pdo;

    public function __construct($db){
        $this->pdo = $db;
    }


    // Pour la page Fournisseurs
    function getAllFournisseurs() {
        $sql = "SELECT F.*, 
                (SELECT COUNT(*) FROM Commandé_a_ CA WHERE CA.idFournisseur = F.idFournisseur) as nb_commandes
                FROM Fournisseur F";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function deleteFournisseur( $id) {
        $query = $this->pdo->prepare("DELETE FROM Fournisseur WHERE idFournisseur = ?");
        return $query->execute([$id]);
    }

    public function ajouterFournisseur($nom, $adresse, $tel, $mail) {
        // Calcul automatique de l'ID pour éviter les erreurs de clé primaire
        $sql = "INSERT INTO Fournisseur (idFournisseur, nomEntreprise, adresse, NumeroTelephone, Mail) 
                VALUES ((SELECT IFNULL(MAX(idFournisseur), 0) + 1 FROM Fournisseur), ?, ?, ?, ?)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([$nom, $adresse, $tel, $mail]);
    }




    // Pour la page Modifier Fournisseur
    function getFournisseurById($id) {
        $query = $this->pdo->prepare("SELECT * FROM Fournisseur WHERE idFournisseur = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function modifierFournisseur($id, $nom, $adresse, $tel, $mail) {
        $sql = "UPDATE Fournisseur SET 
                nomEntreprise = ?, 
                adresse = ?, 
                NumeroTelephone = ?, 
                Mail = ? 
                WHERE idFournisseur = ?";
        $query = $this->pdo->prepare($sql);
        return $query->execute([$nom, $adresse, $tel, $mail, $id]);
    }
}
?>
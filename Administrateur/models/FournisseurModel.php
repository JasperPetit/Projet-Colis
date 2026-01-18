<?php
class FournisseurModel{

    private $pdo;

    public function __construct($db){
        $this->pdo = $db;
    }

    public function getAllFournisseurs() {
        $sql = "SELECT F.idFournisseur, F.nomEntreprise, F.adresse, F.NumeroTelephone, F.Mail, 
                COUNT(CA.idDevis) as nb_commandes
                FROM Fournisseur F
                LEFT JOIN Commandé_a_ CA ON F.idFournisseur = CA.idFournisseur
                GROUP BY F.idFournisseur";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteFournisseur($id) {
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
}

?>
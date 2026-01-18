<?php
// models/FinanceModel.php

class FinanceModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer tous les devis avec les infos complètes (pour la liste type "Jasper")
    public function getAllDevisComplets() {
        $sql = "SELECT d.*, 
                u.nom, u.Prenom, 
                f.nomEntreprise, 
                dept.nomDepartement
                FROM devis d
                LEFT JOIN Commandé_a_ ca ON d.idDevis = ca.idDevis
                LEFT JOIN Fournisseur f ON ca.idFournisseur = f.idFournisseur
                LEFT JOIN Utilisateur u ON d.identifiantCAS = u.identifiantCAS
                LEFT JOIN Appartient_a aa ON u.identifiantCAS = aa.identifiantCAS
                LEFT JOIN Departement dept ON aa.idDepartement = dept.idDepartement
                ORDER BY d.Date_ DESC";
        
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour le statut (1 = Validé, 0 = Refusé)
    public function updateStatutDevis($idDevis, $statut) {
        $sql = "UPDATE devis SET SignatureOuiOuNon = ? WHERE idDevis = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$statut, $idDevis]);
    }
}
?>
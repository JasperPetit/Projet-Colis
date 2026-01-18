<?php
// models/FinanceModel.php

class FinanceModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupère l'état des budgets par département
    public function getBudgets() {
        $sql = "SELECT d.idDepartement, d.nomDepartement, d.BudgetDepartement,
                (SELECT IFNULL(SUM(dv.prix), 0) FROM devis dv
                 JOIN Utilisateur u ON dv.identifiantCAS = u.identifiantCAS
                 JOIN Appartient_a aa ON u.identifiantCAS = aa.identifiantCAS
                 WHERE aa.idDepartement = d.idDepartement AND dv.SignatureOuiOuNon = 1) as BudgetDepense
                FROM Departement d";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère les devis en attente de validation (SignatureOuiOuNon = 0)
    public function getDevisAValider() {
        $sql = "SELECT dv.*, f.nomEntreprise, u.nom, d.nomDepartement 
                FROM devis dv
                LEFT JOIN Commandé_a_ ca ON dv.idDevis = ca.idDevis
                LEFT JOIN Fournisseur f ON ca.idFournisseur = f.idFournisseur
                LEFT JOIN Utilisateur u ON dv.identifiantCAS = u.identifiantCAS
                LEFT JOIN Appartient_a aa ON u.identifiantCAS = aa.identifiantCAS
                LEFT JOIN Departement d ON aa.idDepartement = d.idDepartement
                WHERE dv.SignatureOuiOuNon = 0 OR dv.SignatureOuiOuNon IS NULL";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Met à jour le statut d'un devis (1 = Validé, 2 = Refusé)
    public function updateStatutDevis($idDevis, $statut) {
        try {
            $stmt = $this->db->prepare("UPDATE devis SET SignatureOuiOuNon = ? WHERE idDevis = ?");
            $stmt->execute([$statut, $idDevis]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
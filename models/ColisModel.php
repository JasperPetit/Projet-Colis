<?php
namespace App\Models;
use \PDO;
class ColisModel{

    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    // Fonctions pour la page Colis
    public function getListeColisComplete() {
        $sql = "SELECT co.idColis, co.NumeroBonDeCommande, co.DateAriveePrevu, 
                F.nomEntreprise, C.statut, C.Date_ as DateCommande
                FROM Colis co
                JOIN Commande C ON co.NumeroBonDeCommande = C.NumeroBonDeCommande
                LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
                LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
                ORDER BY co.idColis DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFournisseursAyantColis() {
        $sql = "SELECT DISTINCT F.nomEntreprise 
                FROM Fournisseur F 
                JOIN Commandé_a_ CA ON F.idFournisseur = CA.idFournisseur
                JOIN Commande C ON CA.idDevis = C.idDevis
                JOIN Colis co ON C.NumeroBonDeCommande = co.NumeroBonDeCommande
                WHERE F.nomEntreprise IS NOT NULL
                ORDER BY F.nomEntreprise";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function marquerCommeLivre($idColis) {
        $sql = "UPDATE Colis SET LivréOuiOuNon = '1' WHERE idColis = :id";

        $prepare = $this->pdo->prepare($sql);
        $prepare->execute([':id' => $idColis]);
        $sql = "SELECT NumeroBonDeCommande FROM Colis WHERE idColis = :id";
        $TousColis = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $etat = 'livré';
        foreach($TousColis as $coli){
            if($coli['LivréOuiOuNon']==0){
                $etat = 
            }
        }
}
}
?>
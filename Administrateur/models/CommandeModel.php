<?php
class CommandeModel{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Pour la page Accueil
    public function getCommandesByStatut($db, $statut) {
        $query = $db->prepare("SELECT * FROM Commande WHERE statut = ?");
        $query->execute([$statut]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommandesNonConfirmees($db) {
        $query = $db->query("SELECT * FROM Commande WHERE ConfirmerOuiOuNon = '0'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDernierColisLivre($db) {
        $query = $db->query("SELECT * FROM Commande WHERE statut = 'livré' ORDER BY Date_ DESC, NumeroBonDeCommande DESC LIMIT 1");
        return $query->fetch(PDO::FETCH_ASSOC);
    }



    // Pour la page MesCommandes
    public function getListeCommandesCompletes($db) {
        $sql = "SELECT C.*, F.nomEntreprise, co.DateAriveePrevu
                FROM Commande C 
                LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
                LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
                LEFT JOIN Colis co USING (NumeroBonDeCommande)
                ORDER BY C.Date_ DESC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }



    // Pour la page AjouteCommande
    public function getListeNomsFournisseurs($db) {
        $query = $db->query("SELECT idFournisseur, nomEntreprise FROM Fournisseur");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterCommande($db, $numero, $adresse, $date, $nbColis,$idDevis) {
        $queryIdDevis = $db->query("SELECT MAX(idDevis) as maxId FROM Commande");
        $resIdDevis = $queryIdDevis->fetch(PDO::FETCH_ASSOC);
        


        // Prépare l'insertion en incluant l'idDevis calculé
        $sql = "INSERT INTO Commande (idDevis, NumeroBonDeCommande, AdresseArivee, Date_, nbColis, statut, ConfirmerOuiOuNon) 
                VALUES (?, ?, ?, ?, ?, 'en_cours', 0)";
        
        $query = $db->prepare($sql);
        
        // 4. Exécuter avec toutes les valeurs dans le bon ordre
        return $query->execute([$idDevis, $numero, $adresse, $date, $nbColis,]);
    }
}
?>
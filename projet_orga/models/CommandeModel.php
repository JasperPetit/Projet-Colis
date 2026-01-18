<?php
namespace App\Models;
use \PDO;
class CommandeModel{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Pour la page Accueil
    public function getCommandesByStatut( $statut) {
        $query = $this->pdo->prepare("SELECT * FROM Commande WHERE statut = ?");
        $query->execute([$statut]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommandesNonConfirmees() {
        $query = $this->pdo->query("SELECT * FROM Commande WHERE ConfirmerOuiOuNon = '0'");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDernierColisLivre() {
        $query = $this->pdo->query("SELECT * FROM Commande WHERE statut = 'livré' ORDER BY Date_ DESC, NumeroBonDeCommande DESC LIMIT 1");
        return $query->fetch(PDO::FETCH_ASSOC);
    }



    // Pour la page MesCommandes
    public function getListeCommandesCompletes() {
        $sql = "SELECT C.*, F.nomEntreprise, D.Date_ AS DateDepart
                FROM Commande C 
                INNER JOIN devis D ON C.idDevis = D.idDevis
                LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
                LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
                ORDER BY D.Date_ DESC"; 
                
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteCommande($numeroBonDeCommande) {
        $query = $this->pdo->prepare("DELETE FROM Commande WHERE NumeroBonDeCommande = ?");
        return $query->execute([$numeroBonDeCommande]);
    }

    function getDateDepart( $idDevis) {
        $query = $this->pdo->prepare("SELECT Date_ FROM devis WHERE idDevis = ?");
        $query->execute([$idDevis]);
        $resDateDepart = $query->fetch(PDO::FETCH_ASSOC);
        return $resDateDepart['Date_'];
    }

    function getClasseCSSStatut($statut) {
        $s = strtolower($statut);
        if ($s == 'livré') return 'statut-livre';
        if ($s == 'en_cours') return 'statut-en-cours';
        if ($s == 'retard') return 'statut-retard';
        return '';
    }



    // Pour la page AjouteCommande



    function ajouterCommande($numero, $adresseDepart, $adresseArivee, $dateDepartDossier, $nbColis, $idDevis, $dateArriveeSaisie) {
        $sql = "INSERT INTO Commande (idDevis, AdresseDepart, NumeroBonDeCommande, AdresseArivee, Date_, nbColis, statut, ConfirmerOuiOuNon) 
                VALUES (?, ?, ?, ?, ?, ?, 'en_cours', 0)";
        
        $query = $this->pdo->prepare($sql);
        return $query->execute([$idDevis, $adresseDepart, $numero, $adresseArivee, $dateArriveeSaisie, $nbColis]);
    }



    
    // Pour la page ModifierCommande
    function modifierCommande($numero, $adresseDepart, $adresseArivee, $nbColis, $idDevis, $dateArriveeSaisie) {
        // On met à jour les colonnes de la table Commande
        $sql = "UPDATE Commande SET 
                idDevis = ?, 
                AdresseDepart = ?, 
                AdresseArivee = ?, 
                Date_ = ?, 
                nbColis = ? 
                WHERE NumeroBonDeCommande = ?";
        
        $query = $this->pdo->prepare($sql);
        

        // L'ordre des variables doit correspondre aux "?" ci-dessus
        return $query->execute([
            $idDevis, 
            $adresseDepart, 
            $adresseArivee, 
            $dateArriveeSaisie, // Stockée dans Date_
            $nbColis, 
            $numero
        ]);
    }
    
}
?>
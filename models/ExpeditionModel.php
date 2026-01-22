<?php
namespace App\models;
use \PDO;

class ExpeditionModel {
    private $pdo;

    public function __construct($base_de_donnees) {
        $this->pdo = $base_de_donnees;
    }

    public function recupNbDeColis() {

        return $this->pdo->query("SELECT COUNT(*) FROM Commande")->fetchColumn();
    }

    public function nbColisRetard(){

        return $this->pdo->query("SELECT COUNT(*) FROM Commande WHERE statut='retard'")->fetchColumn();
    }

    public function nbColisLivré(){

        return $this->pdo->query("SELECT COUNT(*) FROM Commande WHERE statut='livré'")->fetchColumn();
    }

    public function nbColisEnTransit(){

        return $this->pdo->query("SELECT COUNT(*) FROM Commande WHERE statut='en_cours'")->fetchColumn();
    }



    public function recupererTroisDernieresCommandes() {

        $requete_sql = "SELECT NumeroBonDeCommande, AdresseDepartment, statut, nbColis, nomDepartement
                        FROM Commande 
                        LEFT JOIN devis USING (idDevis) 
                        LEFT JOIN Appartient_a USING (identifiantCAS)
                        LEFT JOIN Departement USING (idDepartement) 
                        ORDER BY NumeroBonDeCommande ASC LIMIT 3";

        $resultat_recent = $this->pdo->query($requete_sql);
        return $resultat_recent->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rechercherEtiquettes($terme) {

        $requete_sql = "SELECT c.NumeroBonDeCommande, c.AdresseArivee, c.Date_, 
                       col.Poids, col.Taille
                       FROM Commande c
                       LEFT JOIN Colis col ON c.NumeroBonDeCommande = col.NumeroBonDeCommande
                       WHERE c.AdresseArivee LIKE :texte 
                       OR c.NumeroBonDeCommande = :num
                       ORDER BY c.Date_ DESC";

        $resultat_recherche = $this->pdo->prepare($requete_sql);
        
        $resultat_recherche->execute([
            ':texte' => '%' . $terme . '%',
            ':num' => $terme
        ]);

        return $resultat_recherche->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupererHistoriqueComplet() {

        $requete_sql = "SELECT c.NumeroBonDeCommande, c.AdresseArivee, c.Date_, c.nbColis, c.statut, 
                       col.Poids, u.Prenom, u.nom, dep.nomDepartement
                       FROM Commande c 
                       LEFT JOIN Colis col USING (NumeroBonDeCommande) 
                       LEFT JOIN devis d USING (idDevis) 
                       LEFT JOIN Utilisateur u USING (identifiantCAS)
                       LEFT JOIN Appartient_a a USING (identifiantCAS) 
                       LEFT JOIN Departement dep USING (idDepartement) 
                       ORDER BY c.Date_ DESC";

        $resultat_historique = $this->pdo->query($requete_sql);
        return $resultat_historique->fetchAll(PDO::FETCH_ASSOC);
    }

    public function chercherCommande($numero) {

        if (empty($numero)) {
            return null;
        }

        $requete_sql = "SELECT c.*, dep.nomDepartement, c.AdresseArivee, c.statut
                        FROM Commande c 
                        LEFT JOIN devis USING (idDevis)
                        LEFT JOIN Appartient_a USING (identifiantCAS) 
                        LEFT JOIN Departement dep USING (idDepartement)
                        WHERE c.NumeroBonDeCommande = :id";
                
        $resultat_unique = $this->pdo->prepare($requete_sql);
        $resultat_unique->execute([':id' => $numero]);

        return $resultat_unique->fetch(PDO::FETCH_ASSOC);
    }


    public function recupererNumeroBonParIdentifiantCas($identifiant_cas) {
        $requete_sql = "SELECT Commande.NumeroBonDeCommande 
                        FROM Commande 
                        INNER JOIN devis ON Commande.idDevis = devis.idDevis 
                        INNER JOIN Utilisateur ON devis.identifiantCAS = Utilisateur.identifiantCAS 
                        WHERE Utilisateur.identifiantCAS = :cas";

        $resultat_cas = $this->pdo->prepare($requete_sql);
        $resultat_cas->execute([':cas' => $identifiant_cas]);
        
        $ligne = $resultat_cas->fetch(PDO::FETCH_ASSOC);
        return $ligne ? $ligne['NumeroBonDeCommande'] : null;
    }

    public function recupererToutesLesCommandesParUtilisateur($identifiant_cas) {
        $requete_sql = "SELECT Commande.*, devis.prix 
                        FROM Commande 
                        INNER JOIN devis ON Commande.idDevis = devis.idDevis 
                        WHERE devis.identifiantCAS = :cas";

        $resultat_user = $this->pdo->prepare($requete_sql);
        $resultat_user->execute([':cas' => $identifiant_cas]);

        return $resultat_user->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupereToutesLesInfosParCommandes($NumeroBonDeCommande) {
        $requete_sql = "SELECT cmd.NumeroBonDeCommande, cmd.AdresseArivee, cmd.nbColis, 
                               c.Poids, c.DateAriveeReel, c.DateAriveePrevu
                        FROM Colis c 
                        INNER JOIN Commande cmd ON c.NumeroBonDeCommande = cmd.NumeroBonDeCommande 
                        WHERE cmd.NumeroBonDeCommande = :numBon";

        $resultat_infos = $this->pdo->prepare($requete_sql);
        $resultat_infos->execute([':numBon' => $NumeroBonDeCommande]);
        
        return $resultat_infos->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
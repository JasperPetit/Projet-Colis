<?php
require_once 'commande.php';



class CommandeDAO {
    private $connexion_bdd;

    public function __construct($base_de_donnees) {
        $this->connexion_bdd = $base_de_donnees;
    }

    public function recupererNumeroBonParIdentifiantCas($identifiant_cas) {

        $requete_sql = "SELECT Commande.NumeroBonDeCommande 
                        FROM Commande 
                        INNER JOIN devis ON Commande.idDevis = devis.idDevis 
                        INNER JOIN Utilisateur ON devis.identifiantCAS = Utilisateur.identifiantCAS 
                        WHERE Utilisateur.identifiantCAS = :cas";

        $preparation = $this->connexion_bdd->prepare($requete_sql);

        $preparation->bindValue(':cas', $identifiant_cas, SQLITE3_INTEGER);


        $resultat = $preparation->execute();
        $ligne = $resultat->fetchArray(SQLITE3_ASSOC);


        if ($ligne) {
            return $ligne['NumeroBonDeCommande'];
        } else {
            return null;
        }
    }


    public function recupererToutesLesCommandesParUtilisateur($identifiant_cas) {

        $requete_sql = "SELECT Commande.*, devis.prix 
                        FROM Commande 
                        INNER JOIN devis ON Commande.idDevis = devis.idDevis 
                        WHERE devis.identifiantCAS = :cas";

        $preparation = $this->connexion_bdd->prepare($requete_sql);
        $preparation->bindValue(':cas', $identifiant_cas, SQLITE3_INTEGER);
        
        $resultat = $preparation->execute();

        $liste_commandes = [];

  
        while ($commande_trouvee = $resultat->fetchArray(SQLITE3_ASSOC)) {
            $liste_commandes[] = $commande_trouvee;
        }

        return $liste_commandes;
    }


    public function recupereToutesLesInfosParCommandes($NumeroBonDeCommande) {

        $requete_sql = "SELECT cmd.NumeroBonDeCommande, cmd.AdresseArivee, cmd.nbColis, 
                               c.Poids, c.DateAriveeReel, c.DateAriveePrevu
                        FROM Colis c 
                        INNER JOIN Commande cmd ON c.NumeroBonDeCommande = cmd.NumeroBonDeCommande 
                        WHERE cmd.NumeroBonDeCommande = :numBon";

        $preparation = $this->connexion_bdd->prepare($requete_sql);
        $preparation->bindValue(':numBon', $NumeroBonDeCommande, SQLITE3_INTEGER);
        $resultat = $preparation->execute();
        $liste_details = [];
        while ($ligne = $resultat->fetchArray(SQLITE3_ASSOC)) {
            $liste_details[] = $ligne;
        }
        return $liste_details;
    }


    public function recupererLesTroisDernieresCommandes() {

        $requete_sql = "SELECT NumeroBonDeCommande, AdresseDepartment, statut, nbColis, nomDepartement
        FROM Commande LEFT JOIN devis USING (idDevis) LEFT JOIN Appartient_a USING (identifiantCAS)
        LEFT JOIN Departement USING (idDepartement) ORDER BY NumeroBonDeCommande ASC LIMIT 3";

        $preparation = $this->connexion_bdd->prepare($requete_sql);
        $resultat = $preparation->execute();
        $liste_commandes = [];
        $compteur = 0;

        while ($ligne = $resultat->fetchArray(SQLITE3_ASSOC)) {
        $liste_commandes[] = $ligne;
        }
        return $liste_commandes;
        }

        
    public function recupNbDeColis() {

        $requete_sql = "SELECT COUNT(*) FROM Commande";


        $resultat = $this->connexion_bdd->querySingle($requete_sql);

        if ($resultat !== false && $resultat !== null) {
            return $resultat;
        } else {
            return 0;
        }
    }

    public function trouverCommandesParCritere($recherche) {

        $requete_sql = "SELECT c.NumeroBonDeCommande, c.AdresseArivee, c.Date_, 
                       col.Poids, col.Taille
                FROM Commande c
                LEFT JOIN Colis col ON c.NumeroBonDeCommande = col.NumeroBonDeCommande
                WHERE c.AdresseArivee LIKE :texte 
                   OR c.NumeroBonDeCommande = :num
                ORDER BY c.Date_ DESC";

        $preparation = $this->connexion_bdd->prepare($requete_sql);
        $preparation->bindValue(':texte', '%' . $recherche . '%', SQLITE3_TEXT);
        $preparation->bindValue(':num', $recherche, SQLITE3_TEXT);
        $resultat = $preparation->execute();

        $liste = [];
        while ($ligne = $resultat->fetchArray(SQLITE3_ASSOC)) {
            $liste[] = $ligne;
        }
        
        return $liste;
    }

    public function recupererToutesLesCommandes() {
    
    $requete_sql = "SELECT c.NumeroBonDeCommande, c.AdresseArivee, c.Date_, c.nbColis, c.statut, col.Poids, u.Prenom, u.nom, dep.nomDepartement
    FROM Commande c LEFT JOIN Colis col USING (NumeroBonDeCommande) LEFT JOIN devis d USING (idDevis) LEFT JOIN Utilisateur u USING (identifiantCAS)
    LEFT JOIN Appartient_a a USING (identifiantCAS) LEFT JOIN Departement dep USING (idDepartement) ORDER BY c.Date_ ASC";

    $resultat = $this->connexion_bdd->query($requete_sql);
    
    $liste = [];
    while ($ligne = $resultat->fetchArray(SQLITE3_ASSOC)) {
        $liste[] = $ligne;
    }
    
    return $liste;
}


    public function recupererColisEnRetard(){
        $requete_sql = "SELECT COUNT(*) FROM commande WHERE statut='retard'";

        $resultat= $this->connexion_bdd->querySingle($requete_sql);
        return $resultat;
    }

    public function recupererColisLivré(){
        $requete_sql = "SELECT COUNT(*) FROM commande WHERE statut='livré'";

        $resultat= $this->connexion_bdd->querySingle($requete_sql);
        return $resultat;
    }

    public function recupererColisEnTransit(){
        $requete_sql = "SELECT COUNT(*) FROM commande WHERE statut='en_cours'";

        $resultat= $this->connexion_bdd->querySingle($requete_sql);
        return $resultat;
    }


    public function recupererParNumero($numeroBon) {
        $sql = "SELECT c.*, dep.nomDepartement FROM Commande c LEFT JOIN devis USING (idDevis)
        LEFT JOIN Appartient_a USING (identifiantCAS) LEFT JOIN Departement dep USING (idDepartement)
        WHERE c.NumeroBonDeCommande = :id";
                
        $preparation = $this->connexion_bdd->prepare($sql);
        
        $preparation->bindValue(':id', $numeroBon);

        $resultat = $preparation->execute();

        return $resultat->fetchArray(SQLITE3_ASSOC);
}



}
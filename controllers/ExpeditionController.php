<?php
namespace App\Controllers;

use Exception;
use App\models\ExpeditionModel;

class ExpeditionController {

    private $modele;

    public function __construct($connexion_bdd) {
        $this->modele = new ExpeditionModel($connexion_bdd);
    }

    // LE TABLEAU DE BORD
    public function afficherTableauDeBord() {

        $nom_complet = $_SESSION['nom_complet'];
        $role_utilisateur = $_SESSION['role'];

    

        $nbColisEnretard = $this->modele->nbColisRetard();
        $nbColisLivré= $this->modele->nbColisLivré();
        $nbColisEnTransit = $this->modele->nbColisEnTransit();
        

        $total = $this->modele->recupNbDeColis();

        $dernieres_commandes = $this->modele->recupererTroisDernieresCommandes();

        $mois = [1=>'janvier', 2=>'février', 3=>'mars', 4=>'avril', 5=>'mai', 6=>'juin', 7=>'juillet', 8=>'août', 9=>'septembre', 10=>'octobre', 11=>'novembre', 12=>'décembre'];
        $date = date('d') . ' ' . $mois[date('n')] . ' ' . date('Y');

        require_once  'views/pageTableauDeBord.php';
    }

    // SUIVI DES COLIS 
    public function afficherSuiviColis() {

        $nom_complet = $_SESSION['nom_complet'];
        $role_utilisateur = $_SESSION['role'] ;

        $liste_commandes = $this->modele->recupererHistoriqueComplet();
        $nombre_total_colis = count($liste_commandes);

        require_once  'views/pageSuiviColis.php';
    }

    // NOUVEL ENVOI 
    public function afficherNouvelEnvoi() {

        $nom_complet = $_SESSION['nom_complet'];
        $role_utilisateur = $_SESSION['role'];

        $resultats = [];
        $message = "";
        $recherche = "";

        if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
            $recherche = htmlspecialchars($_GET['recherche']);
    
            $resultats = $this->modele->rechercherEtiquettes($recherche);
            
            if (empty($resultats)) {
                $message = "Aucun colis trouvé pour : " . $recherche;
            }
        }

        require_once   'views/pageNouvelEnvoi.php';
    }
    
  


    public function imprimerEtiquette() {
    $id_bon = htmlspecialchars($_GET['id']);
    $colis = null;

    try {
        $resultats = $this->modele->rechercherEtiquettes($id_bon);
        
        if (!empty($resultats)) {
            $colis = $resultats[0];
        } else {
            die("Erreur : Colis introuvable.");
        }
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
    require_once 'views/pageEtiquette.php';
    }

    public function deconnecter() {
        session_destroy();
        header('Location: index.php?action=login');     
        exit();
    }
}
?>
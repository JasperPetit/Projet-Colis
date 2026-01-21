<?php 
namespace App\Controllers;

use App\Models\DevisService as ModelsDevisService;
use App\Models\FournisseurModel;
use PDO;
use PDOException;
use Exception;

class DevisController{

    private $pdo;
    private $service;
    private $FournisseurModel;

    public function __construct($db)
    {
        $this->pdo = $db;
        $this->service = new ModelsDevisService($db);
        $this->FournisseurModel = new FournisseurModel($db);
    }

    public function AjouterDevis(){

        

            try{
            $this->service->AjouterDevis($_POST,$_FILES,$_SESSION);

            header('Location: pageInfosDevis?success=1');
            exit();
            }
            catch (PDOException $e){
                if($e->getCode() == '23000'){
                    header('Location: formulaireDevis?error=doublon');            
                }
                else{
                    die("Erreur SQL inattendue : " . $e->getMessage());
                }
                exit();
            }
    }
    
    public function SupprimerDevis(){
        // 1. Vérification sécurisée
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_devis'])){
            
            // On utilise l'opérateur de coalescence (??) pour éviter les erreurs "Undefined index"
            $idDevis = $_POST['idDevis'] ?? null;

            if (!empty($idDevis)) {
                try {
                    $this->service->SupprimerDevis($idDevis);
                    header("Location: pageInfosDevis?success=suppression");
                    exit();
                } catch (Exception $e) {
                    // Erreur technique (ex: contrainte SQL)
                    header("Location: pageInfosDevis?error=technique");
                    exit();
                }
            } else {
                // L'ID est vide -> On redirige avec une erreur explicite
                header("Location: pageInfosDevis?error=id_manquant");
                exit();
            }
        }
        
        // Si on arrive ici (pas POST ou pas le bon bouton), on redirige vers la liste
        header("Location: pageInfosDevis");
        exit();
    
    }


//    public function ModifierDevis(){

//    }

    public function AfficherDevis(){
        $listeDevis = $this->service->getAllDevis();

        require_once 'views/pageInfosDevisAdmin.php';
    }


    public function AfficherFormulaire(){
        $resFournisseurs = $this->FournisseurModel->getAllFournisseurs();
        require_once 'views/pageAjoutDevis.php';
    }
}

?>
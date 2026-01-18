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
            $this->service->AjouterDevis($_POST,$_FILES);

            header('Location: pageInfosDevis?success=1');
            exit();
            }
            catch (PDOException $e){
                if($e->getCode() == '23000'){
                    header('Location: index.php?action=formulaire&error=doublon');            
                }
                else{
                    die("Erreur SQL inattendue : " . $e->getMessage());
                }
                exit();
            }
    }
    
    public function SupprimerDevis(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_devis'])){
            $idDevis = $_POST['idDevis'];
            if (!empty($idDevis)) {
                try {
                    $this->service->SupprimerDevis($idDevis);
                    header("Location: pageInfosDevis");
                    exit();
                } catch (Exception $e) {
                    header("Location: pageInfosDevis");
                }
        }
    }
    }

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
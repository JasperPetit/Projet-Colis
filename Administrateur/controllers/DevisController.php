<?php 

require_once '../Administrateur/Service/DevisService.php';

class DevisController{

    private $pdo;
    private $service;

    public function __construct($db)
    {
        $this->pdo = $db;
        $this->service = new DevisService($db);
    }

    public function AjouterDevis(){

        

            try{
            $this->service->AjouterDevis($_POST,$_FILES);

            header('Location: pageAccueil.php?success=1');
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
    

    public function AfficherDevis(){
        $model = new Devis($this->pdo);
        $listeDevis = $model->getAllDevis();

        require_once 'pageInfosDevis.php';
    }


    public function AfficherFormulaire(){
        require_once 'AjoutDevis.php';
    }
}

?>
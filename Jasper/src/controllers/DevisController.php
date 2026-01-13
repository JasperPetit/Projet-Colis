<?php 

namespace App\Controllers;

use App\models\Devis;
use PDO;
use PDOException;

class DevisController{

    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    public function AjouterDevis(){

        $nomFichier = "";
        
        // Si un fichier a été envoyé
        if (!empty($_FILES['ImageDevis']['name'])) {
            $nomFichier = $_FILES['ImageDevis']['name'];
            
            // On le déplace directement dans le dossier "uploads"
            // ATTENTION : Le dossier "uploads" doit exister physiquement !
            move_uploaded_file($_FILES['ImageDevis']['tmp_name'], "uploads/" . $nomFichier);
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tab = [
            'NumeroDevis' => $_POST['NumeroDevis'],
            'name' => $_POST['name'],
            'prix' => $_POST['prix'],
            'idFournisseur' => $_POST['idFournisseur'],
            'details' => $_POST['details'],
            'nomFichier' => $nomFichier,

            'dateAujourdhui' => date('Y-m-d'),
            'identifiant' => "Jasper",
            'signatureParDefaut' => null,
            'idFournisseur' => $_POST['idFournisseur']
        ];

        $model = new Devis($this->pdo);

        try{
        $model->AjouterDevis($tab);
        $model->AjouterFournisseurDevis($tab);

        header('Location: '.ROOT.'/templates/pageAccueil.php?success=1');
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
    }

    public function AfficherDevis(){
        $model = new Devis($this->pdo);
        $listeDevis = $model->getAllDevis();

        require_once ROOT . '/templates/pageInfosDevis.php';
    }


    public function AfficherFormulaire(){
        require_once ROOT . '/templates/AjoutDevis.php';
    }
}

?>
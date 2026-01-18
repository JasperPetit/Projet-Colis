<?php 
namespace App\Models;
use App\Models\DevisModeel;

class DevisService {

    private $devisModel;
    
    public function __construct($pdo)
    {
        $this->devisModel = new Devis($pdo);
    }

    public function getAllDevis(){
        return $this->devisModel->getAllDevis();
    }


    public function AjouterDevis($POST,$FILES){
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
                'identifiant' => 1,
                'signatureParDefaut' => null,
                'idFournisseur' => $_POST['idFournisseur']
            ];

    

        $this->devisModel->AjouterDevis($tab);
        $this->devisModel->AjouterFournisseurDevis($tab);
        }
    }

    public function RecupererIdDevis(){
        return $this->devisModel->getDevisId();
    }
}

?>
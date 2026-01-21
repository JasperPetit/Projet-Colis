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


    public function AjouterDevis($POST,$FILES,$SESSION){
        $nomFichier = "";
        
        // Si un fichier a été envoyé
        if (!empty($FILES['ImageDevis']['name'])) {
            $nomFichier = $FILES['ImageDevis']['name'];
            
            // On le déplace directement dans le dossier "uploads"
            // ATTENTION : Le dossier "uploads" doit exister physiquement !
            move_uploaded_file($FILES['ImageDevis']['tmp_name'], "uploads/" . $nomFichier);
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tab = [
                'NumeroDevis' => $POST['NumeroDevis'],
                'name' => $POST['name'],
                'prix' => $POST['prix'],
                'idFournisseur' => $POST['idFournisseur'],
                'details' => $POST['details'],
                'nomFichier' => $nomFichier,

                'dateAujourdhui' => date('Y-m-d'),
                'identifiant' => $SESSION['utilisateur_id'],
                'signatureParDefaut' => null,
                'idFournisseur' => $POST['idFournisseur']
            ];

    

        $this->devisModel->AjouterDevis($tab);
        $this->devisModel->AjouterFournisseurDevis($tab);
        }
    }

    public function RecupererIdDevis(){
        return $this->devisModel->getDevisId();
    }

    public function SupprimerDevis($idDevis){
        $this->devisModel->SupprimerCommandé($idDevis);
        return $this->devisModel->SupprimerDevis($idDevis);
    }
}

?>
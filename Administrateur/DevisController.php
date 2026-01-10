<?php 

use Devis;

class DevisController{

    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    public function AjouterDevis(){

        $nomFichier = "";
            if (isset($_FILES['ImageDevis']) && $_FILES['ImageDevis']['error'] === 0) {
                $nomFichier = $_FILES['ImageDevis']['name'];
                // Pensez à faire le move_uploaded_file ici si vous voulez stocker le fichier
                move_uploaded_file($_FILES['ImageDevis']['tmp_name'], "uploads/" . $nomFichier);
            }

        $tab = [
            'NumeroDevis' => $_POST['NumeroDevis'],
            'name' => $_POST['name'],
            'prix' => $_POST['prix'],
            'idFournisseur' => $_POST['idFournisseur'],
            'details' => $_POST['details'],
            'nomFichier' => $nomFichier,

            'dateAujourdhui' => date('Y-m-d'),
            'identifiant' => "Jasper",
            'signatureParDefaut' => 0
        ];

        $model = new Devis($this->pdo);
        $model->AjouterDevis($tab);
        header('Location: pageAcceuil.php');
        exit();


    }

}

?>
<?php 

// controllers/DevisController.php

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
            // Assure-toi que le dossier "uploads" existe à la racine du projet
            move_uploaded_file($_FILES['ImageDevis']['tmp_name'], __DIR__ . "/../uploads/" . $nomFichier);
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
                'signatureParDefaut' => null
            ];

            $model = new Devis($this->pdo);

            try{
                $model->AjouterDevis($tab);
                $model->AjouterFournisseurDevis($tab);

                // CORRECTION : Redirection vers le routeur (page Accueil ou Mes Devis)
                header('Location: index.php?page=mes_devis&success=1');
                exit();
            }
            catch (PDOException $e){
                if($e->getCode() == '23000'){
                    // CORRECTION : Redirection vers la page du formulaire via le routeur
                    header('Location: index.php?page=ajouter_devis&error=doublon');            
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

        // CORRECTION : On pointe vers le bon fichier dans views/
        require_once __DIR__ . '/../views/mes_devis.php';
    }


    public function AfficherFormulaire(){
        // CORRECTION : On pointe vers le bon fichier dans views/
        require_once __DIR__ . '/../views/ajouter_devis.php';
    }
}
?>
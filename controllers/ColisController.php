<?php
namespace App\Controllers;
use App\Models\ColisModel;
class ColisController{


    private $pdo;
    private $ColisModel;

    public function __construct($db)
    {
        $this->pdo = $db;
        $this->ColisModel = new ColisModel($db);
    }


    public function afficherColis(){
        $resListeColis = $this->ColisModel->getListeColisComplete();
        $fournisseursFiltre = $this->ColisModel->getFournisseursAyantColis();
        require_once 'views/pageColis.php';
    }
    public function afficherColisPostale(){
        $resListeColis = $this->ColisModel->getListeColisComplete();
        $fournisseursFiltre = $this->ColisModel->getFournisseursAyantColis();
        require_once 'views/pageColis.php';
    }
    public function validerLivraison() {
            // On vérifie que la requête est bien en POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // On récupère les données proprement
                $id = $_POST['id'] ?? null;
                $idCommande = $_POST['idCommande'] ?? null;

                if ($id && $idCommande) {
                    // On appelle le modèle
                    $this->ColisModel->marquerCommeLivre($id, $idCommande);
                }
            }

            // Redirection
            header('Location: index.php?action=afficherColisPostale');
            exit();
        }
}
?>
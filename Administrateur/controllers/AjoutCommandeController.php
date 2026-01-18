<?php

require_once '../Administrateur/models/CommandeModel.php';
require_once '../Administrateur/Service/DevisService.php';
require_once '../Administrateur/models/FournisseurModel.php';

class AjoutCommandeController{

    private $pdo;
    private $CommandeModel;
    private $DevisService;
    private $FournisseurModel;

    function __construct($db)
    {
        $this->pdo = $db;
        $this->CommandeModel = new CommandeModel($db);
        $this->DevisService = new DevisService($db);
        $this->FournisseurModel = new FournisseurModel($db);
    }
    function ajouterCommande(){
        

    // Si le formulaire a été envoyé (méthode POST) on traite les données 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $erreur = null;
            $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';
            $Date = $_POST['Date_'] ?? '';
            $nbColis = $_POST['nbColis'] ?? '';
            $AdresseArivee = $_POST['AdresseArivee'] ?? '';
            $idDevis = $_POST['idDevis'];

            if (!empty($NumeroBonDeCommande) && !empty($Date) && !empty($AdresseArivee)) {
                try {
                    $this->CommandeModel->ajouterCommande($this->pdo, $NumeroBonDeCommande, $AdresseArivee, $Date, $nbColis,$idDevis);
                    
                    // Redirection vers la liste des commandes
                    header("Location: pageMesCommandes.php");
                    exit();
                } catch (Exception $e) {
                    $erreur = "Erreur SQL : " . $e->getMessage();
                }
            } else {
                $erreur = "Veuillez remplir les champs obligatoires !";
            }
        }

    }

    public function afficherFormulaire(){
        $idDevis = $this->DevisService->RecupererIdDevis();
        $resNomEntreprise = $this->CommandeModel->getListeNomsFournisseurs($this->pdo);
        require_once '../Administrateur/views/pageAjouterCommande.php';
    }
}
?>
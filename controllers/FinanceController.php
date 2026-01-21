<?php
// controllers/FinanceController.php

namespace App\Controllers;
require_once __DIR__ . '/../models/FinanceModel.php';
use App\Models\FinanceModel;
use App\Models\Devis;

class FinanceController {
    private $financeModel;
    private $devisModel;
    public function __construct($db) {
        $this->financeModel = new FinanceModel($db);
        $this->devisModel = new Devis($db);
    }

    // Afficher la liste des devis pour le financier
    public function afficherListeFinance() {
        // On appelle la fonction du modèle qu'on vient de mettre à jour
        $listeDevis = $this->devisModel->getAllDevis();
        
        // On charge la NOUVELLE vue (celle qui ressemble à pageInfosDevis)
        require_once __DIR__ . '/../views/service_financier.php';
    }

    // Action : Valider un devis
    public function validerDevis() {
        if (isset($_GET['id'])) {
            $idDevis = $_GET['id'];
            $this->financeModel->updateStatutDevis($idDevis, 1); // 1 = Accepté
        }
        // Redirection vers la liste
        header('Location: pageServiceFinancierDevis');
        exit();
    }

    // Action : Refuser un devis
    public function refuserDevis() {
        if (isset($_GET['id'])) {
            $idDevis = $_GET['id'];
            $this->financeModel->updateStatutDevis($idDevis, 0); // 0 = Refusé
        }
        // Redirection vers la liste
        header('Location: pageServiceFinancierDevis');
        exit();
    }
}
?>
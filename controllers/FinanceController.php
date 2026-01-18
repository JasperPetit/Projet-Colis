<?php
// controllers/FinanceController.php

namespace App\Controllers;
require_once __DIR__ . '/../models/FinanceModel.php';
use FinanceModel;

class FinanceController {
    private $financeModel;

    public function __construct($db) {
        $this->financeModel = new FinanceModel($db);
    }

    // Afficher la liste des devis pour le financier
    public function afficherListeFinance() {
        // On appelle la fonction du modèle qu'on vient de mettre à jour
        $listeDevis = $this->financeModel->getAllDevisComplets();
        
        // On charge la NOUVELLE vue (celle qui ressemble à pageInfosDevis)
        require_once __DIR__ . '/../views/page_finance_devis.php';
    }

    // Action : Valider un devis
    public function validerDevis() {
        if (isset($_GET['id'])) {
            $idDevis = $_GET['id'];
            $this->financeModel->updateStatutDevis($idDevis, 1); // 1 = Accepté
        }
        // Redirection vers la liste
        header('Location: index.php?action=finance');
        exit();
    }

    // Action : Refuser un devis
    public function refuserDevis() {
        if (isset($_GET['id'])) {
            $idDevis = $_GET['id'];
            $this->financeModel->updateStatutDevis($idDevis, 0); // 0 = Refusé
        }
        // Redirection vers la liste
        header('Location: index.php?action=finance');
        exit();
    }
}
?>
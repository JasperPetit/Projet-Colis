<?php
// controllers/FinanceController.php

namespace App\Controllers;
require_once __DIR__ . '/../models/FinanceModel.php';
use FinanceModel; // On utilise la classe qu'on vient de créer

class FinanceController {
    private $model;

    public function __construct($db) {
        // On initialise le modèle avec la connexion BDD
        $this->model = new FinanceModel($db);
    }

    // Affiche la page principale du service financier
    public function afficherFinance() {
        // 1. On récupère les données via le modèle
        $resBudgets = $this->model->getBudgets();
        $commandes_a_valider = $this->model->getDevisAValider();

        // 2. On inclut la vue (et elle aura accès aux variables $resBudgets, etc.)
        require_once __DIR__ . '/../views/service_financier.php';
    }

    // Traite le formulaire de validation/refus
    public function traiterValidation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id_devis'])) {
            $idDevis = $_POST['id_devis'];
            // Si action est 'valider' on met 1, sinon (refuser) on met 2
            $statut = ($_POST['action'] === 'valider') ? 1 : 2;

            $succes = $this->model->updateStatutDevis($idDevis, $statut);

            // On redirige vers la page finance pour rafraîchir
            if ($succes) {
                header('Location: index.php?page=finance&success=1');
            } else {
                header('Location: index.php?page=finance&error=1');
            }
            exit();
        }
    }
}
?>
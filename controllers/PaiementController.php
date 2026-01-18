<?php
// Contrôleur pour la gestion des paiements 
class PaiementController {
    private $factureModel;

    public function __construct($factureModel = null) {
        require_once __DIR__ . '/../models/FactureModel.php';
        
        $this->factureModel = $factureModel ?? new FactureModel();
    }

    // Liste les factures en attente de paiement
    public function index() {
        $facturesEnAttente = $this->factureModel->getByType('attente');
        
        // Vérifier s'il y a des factures en attente
        $enAttenteExist = count($facturesEnAttente) > 0;
        
        return [
            'factures_attente' => $facturesEnAttente,
            'en_attente_exist' => $enAttenteExist
        ];
    }

    // Valide un paiement par index (pour JSON)
    public function validerParIndex($index) {
        if ($this->factureModel->updateStatusByIndex($index, 'paye')) {
            header('Location: payer.php');
            exit;
        } else {
            return ['error' => 'Erreur lors de la validation du paiement'];
        }
    }

    // Valide un paiement par ID
    public function valider($id) {
        $this->factureModel->updateStatus($id, 'paye');
        header('Location: payer.php');
        exit;
    }
}
?>

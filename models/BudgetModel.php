<?php
/**
 * Modèle pour la gestion du budget
 */
class BudgetModel {
    private $fichierJson = 'bdd.json';

    public function __construct() {
        // Initialiser le fichier JSON s'il n'existe pas
        if (!file_exists($this->fichierJson)) {
            file_put_contents($this->fichierJson, json_encode([
                "budget_total" => 50000,
                "factures" => []
            ]));
        }
    }

    /**
     * Récupère le budget total
     */
    public function getBudgetTotal() {
        $data = json_decode(file_get_contents($this->fichierJson), true);
        return isset($data['budget_total']) ? (int)$data['budget_total'] : 50000;
    }

    /**
     * Met à jour le budget total
     */
    public function updateBudgetTotal($montant) {
        $data = json_decode(file_get_contents($this->fichierJson), true);
        $data['budget_total'] = (int)$montant;
        file_put_contents($this->fichierJson, json_encode($data));
        return true;
    }

    /**
     * Calcule le pourcentage d'utilisation du budget
     */
    public function getPourcentageUtilisation($revenus) {
        $budget = $this->getBudgetTotal();
        if ($budget > 0) {
            return ($revenus / $budget) * 100;
        }
        return 0;
    }

    /**
     * Retourne la couleur du budget selon le pourcentage
     */
    public function getCouleurBudget($pourcentage) {
        return ($pourcentage > 80) ? 'red' : '#4caf50';
    }
}
?>

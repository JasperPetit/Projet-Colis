<?php
/**
 * Contrôleur pour le tableau de bord
 */
class DashboardController {
    private $factureModel;
    private $budgetModel;

    public function __construct($factureModel = null, $budgetModel = null) {
        require_once __DIR__ . '/../models/FactureModel.php';
        require_once __DIR__ . '/../models/BudgetModel.php';
        
        $this->factureModel = $factureModel ?? new FactureModel();
        $this->budgetModel = $budgetModel ?? new BudgetModel();
    }

    /**
     * Affiche le tableau de bord
     */
    public function index() {
        // Récupération des données
        $factures = $this->factureModel->getAll();
        $budgetTotal = $this->budgetModel->getBudgetTotal();
        
        // Calculs automatiques
        $stats = $this->factureModel->getStats();
        
        // Pourcentage du budget
        $pourcentageBudget = $this->budgetModel->getPourcentageUtilisation($stats['revenus']);
        $couleurBudget = $this->budgetModel->getCouleurBudget($pourcentageBudget);
        
        // Données à retourner
        return [
            'factures' => $factures,
            'budget_total' => $budgetTotal,
            'revenus' => $stats['revenus'],
            'attente' => $stats['attente'],
            'nb_attente' => $stats['nb_attente'],
            'nb_payes' => $stats['nb_payes'],
            'pourcentage_budget' => $pourcentageBudget,
            'couleur_budget' => $couleurBudget
        ];
    }
}
?>

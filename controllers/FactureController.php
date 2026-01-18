<?php
/**
 * Contrôleur pour la gestion des factures
 */
class FactureController {
    private $factureModel;

    public function __construct($factureModel = null) {
        require_once __DIR__ . '/../models/FactureModel.php';
        
        $this->factureModel = $factureModel ?? new FactureModel();
    }

    /**
     * Liste toutes les factures
     */
    public function index() {
        $factures = $this->factureModel->getAll();
        return ['factures' => $factures];
    }

    /**
     * Affiche le formulaire d'ajout
     */
    public function createForm() {
        return [];
    }

    /**
     * Traite la création d'une nouvelle facture
     */
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return ['error' => 'Méthode non autorisée'];
        }

        // Validation des données
        if (empty($_POST['client']) || empty($_POST['montant'])) {
            return ['error' => 'Tous les champs sont requis'];
        }

        // Préparation des données
        $data = [
            'client' => $_POST['client'],
            'montant' => $_POST['montant'],
            'type' => $_POST['type'] ?? 'attente'
        ];

        // Création de la facture
        $nouvelleFacture = $this->factureModel->create($data);

        if ($nouvelleFacture) {
            // Redirection vers l'accueil
            header('Location: index.php');
            exit;
        } else {
            return ['error' => 'Erreur lors de la création de la facture'];
        }
    }

    /**
     * Recherche des factures
     */
    public function search($query) {
        if (empty($query)) {
            return $this->index();
        }

        $factures = $this->factureModel->search($query);
        return ['factures' => $factures, 'query' => $query];
    }

    /**
     * Récupère une facture par son ID
     */
    public function show($id) {
        $facture = $this->factureModel->getById($id);
        
        if (!$facture) {
            return ['error' => 'Facture non trouvée'];
        }

        return ['facture' => $facture];
    }
}
?>

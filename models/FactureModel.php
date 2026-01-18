<?php
/**
 * Modèle pour la gestion des factures
 * Supporte à la fois le stockage JSON et base de données
 */
class FactureModel {
    private $fichierJson = 'bdd.json';
    private $pdo = null;
    private $useDatabase = false;

    public function __construct($pdo = null) {
        if ($pdo !== null) {
            $this->pdo = $pdo;
            $this->useDatabase = true;
        }
        
        // Initialiser le fichier JSON s'il n'existe pas
        if (!$this->useDatabase && !file_exists($this->fichierJson)) {
            file_put_contents($this->fichierJson, json_encode([
                "budget_total" => 50000,
                "factures" => []
            ]));
        }
    }

    /**
     * Récupère toutes les factures
     */
    public function getAll() {
        if ($this->useDatabase) {
            return $this->getAllFromDatabase();
        } else {
            return $this->getAllFromJson();
        }
    }

    /**
     * Récupère toutes les factures depuis JSON
     */
    private function getAllFromJson() {
        $data = json_decode(file_get_contents($this->fichierJson), true);
        return $data['factures'] ?? [];
    }

    /**
     * Récupère toutes les factures depuis la base de données
     */
    private function getAllFromDatabase() {
        $stmt = $this->pdo->query("SELECT * FROM factures ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une facture par son ID
     */
    public function getById($id) {
        if ($this->useDatabase) {
            $stmt = $this->pdo->prepare("SELECT * FROM factures WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $factures = $this->getAllFromJson();
            foreach ($factures as $facture) {
                if ($facture['id'] == $id) {
                    return $facture;
                }
            }
            return null;
        }
    }

    /**
     * Récupère les factures par type/statut
     */
    public function getByType($type) {
        $factures = $this->getAll();
        $filtered = [];
        
        foreach ($factures as $facture) {
            $statut = $this->useDatabase ? $facture['statut'] : $facture['type'];
            if ($statut == $type) {
                $filtered[] = $facture;
            }
        }
        
        return $filtered;
    }

    /**
     * Ajoute une nouvelle facture
     */
    public function create($data) {
        if ($this->useDatabase) {
            return $this->createInDatabase($data);
        } else {
            return $this->createInJson($data);
        }
    }

    /**
     * Crée une facture dans JSON
     */
    private function createInJson($data) {
        $bdd = json_decode(file_get_contents($this->fichierJson), true);
        
        $nouvelle = [
            "id" => $data['id'] ?? "F-" . rand(100, 999),
            "client" => $data['client'],
            "montant" => (int)$data['montant'],
            "type" => $data['type'] ?? 'attente',
            "date" => $data['date'] ?? date("d/m/Y")
        ];
        
        array_unshift($bdd['factures'], $nouvelle);
        file_put_contents($this->fichierJson, json_encode($bdd));
        
        return $nouvelle;
    }

    /**
     * Crée une facture dans la base de données
     */
    private function createInDatabase($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO factures (reference, client, montant, statut, date_creation) 
            VALUES (?, ?, ?, ?, NOW())
        ");
        
        $reference = $data['reference'] ?? $data['id'] ?? "F-" . rand(100, 999);
        $client = $data['client'];
        $montant = (int)$data['montant'];
        $statut = $data['statut'] ?? $data['type'] ?? 'attente';
        
        $stmt->execute([$reference, $client, $montant, $statut]);
        
        return $this->getById($this->pdo->lastInsertId());
    }

    /**
     * Met à jour le statut d'une facture
     */
    public function updateStatus($id, $status) {
        if ($this->useDatabase) {
            $stmt = $this->pdo->prepare("UPDATE factures SET statut = ? WHERE id = ?");
            $stmt->execute([$status, $id]);
        } else {
            $bdd = json_decode(file_get_contents($this->fichierJson), true);
            foreach ($bdd['factures'] as $key => $facture) {
                if ($facture['id'] == $id) {
                    $bdd['factures'][$key]['type'] = $status;
                    break;
                }
            }
            file_put_contents($this->fichierJson, json_encode($bdd));
        }
    }

    /**
     * Met à jour le statut d'une facture par index (pour JSON)
     */
    public function updateStatusByIndex($index, $status) {
        if ($this->useDatabase) {
            return false;
        }
        
        $bdd = json_decode(file_get_contents($this->fichierJson), true);
        if (isset($bdd['factures'][$index])) {
            $bdd['factures'][$index]['type'] = $status;
            file_put_contents($this->fichierJson, json_encode($bdd));
            return true;
        }
        return false;
    }

    /**
     * Calcule les statistiques des factures
     */
    public function getStats() {
        $factures = $this->getAll();
        
        $stats = [
            'revenus' => 0,
            'attente' => 0,
            'nb_attente' => 0,
            'nb_payes' => 0,
            'total' => 0
        ];
        
        foreach ($factures as $facture) {
            $statut = $this->useDatabase ? $facture['statut'] : $facture['type'];
            $montant = (int)$facture['montant'];
            
            if ($statut == 'paye') {
                $stats['revenus'] += $montant;
                $stats['nb_payes']++;
            } else {
                $stats['attente'] += $montant;
                $stats['nb_attente']++;
            }
            
            $stats['total'] += $montant;
        }
        
        return $stats;
    }

    /**
     * Recherche des factures
     */
    public function search($query) {
        $factures = $this->getAll();
        $results = [];
        
        $query = strtolower($query);
        
        foreach ($factures as $facture) {
            $id = strtolower($this->useDatabase ? $facture['reference'] : $facture['id']);
            $client = strtolower($facture['client']);
            
            if (strpos($id, $query) !== false || strpos($client, $query) !== false) {
                $results[] = $facture;
            }
        }
        
        return $results;
    }

    /**
     * Supprime une facture par ID
     */
    public function delete($id) {
        if ($this->useDatabase) {
            $stmt = $this->pdo->prepare("DELETE FROM factures WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->rowCount() > 0;
        } else {
            $bdd = json_decode(file_get_contents($this->fichierJson), true);
            foreach ($bdd['factures'] as $key => $facture) {
                if ($facture['id'] == $id) {
                    unset($bdd['factures'][$key]);
                    $bdd['factures'] = array_values($bdd['factures']); // Réindexer le tableau
                    file_put_contents($this->fichierJson, json_encode($bdd));
                    return true;
                }
            }
            return false;
        }
    }
}
?>

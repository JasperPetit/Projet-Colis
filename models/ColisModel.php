<?php
namespace App\Models;
use \PDO;

class ColisModel{

    private $pdo;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    // --- CORRECTION : On ne garde que cette version (la plus complète avec Taille et Poids) ---
    public function getListeColisComplete() {
        $sql = "SELECT co.idColis, co.NumeroBonDeCommande, co.DateAriveePrevu, co.Taille, co.Poids,
                F.nomEntreprise, C.statut, C.Date_ as DateCommande
                FROM Colis co
                JOIN Commande C ON co.NumeroBonDeCommande = C.NumeroBonDeCommande
                LEFT JOIN Commandé_a_ CA ON C.idDevis = CA.idDevis 
                LEFT JOIN Fournisseur F ON CA.idFournisseur = F.idFournisseur
                ORDER BY co.idColis DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFournisseursAyantColis() {
        $sql = "SELECT DISTINCT F.nomEntreprise 
                FROM Fournisseur F 
                JOIN Commandé_a_ CA ON F.idFournisseur = CA.idFournisseur
                JOIN Commande C ON CA.idDevis = C.idDevis
                JOIN Colis co ON C.NumeroBonDeCommande = co.NumeroBonDeCommande
                WHERE F.nomEntreprise IS NOT NULL
                ORDER BY F.nomEntreprise";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creerColis($numeroBonDeCommande, $dateArrivee) {
        // On cherche le plus grand ID actuel dans la table
        $stmtMax = $this->pdo->query("SELECT MAX(idColis) FROM Colis");
        $maxId = $stmtMax->fetchColumn();

        // On ajoute 1 pour avoir le nouvel ID (ou 1 si la table est vide)
        $newId = $maxId ? ((int)$maxId + 1) : 1;

        // On insère le colis avec cet ID explicite
        $sql = "INSERT INTO Colis (idColis, NumeroBonDeCommande, DateAriveePrevu) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([$newId, $numeroBonDeCommande, $dateArrivee]);
    }

    public function marquerCommeLivre($idColis, $idCommande) {
        // 1. Mettre à jour le colis spécifique pour dire qu'il est livré
        $sqlUpdateColis = "UPDATE Colis SET LivréOuiOuNon = 1 WHERE idColis = :idColis";
        $stmt = $this->pdo->prepare($sqlUpdateColis);
        $stmt->execute([':idColis' => $idColis]);

        // 2. Récupérer TOUS les colis de cette commande pour vérifier leur état
        // (Attention : dans ta base de données, la clé étrangère s'appelle NumeroBonDeCommande)
        $sqlCheck = "SELECT LivréOuiOuNon FROM Colis WHERE NumeroBonDeCommande = :idCommande";
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([':idCommande' => $idCommande]);
        $tousLesColis = $stmtCheck->fetchAll(\PDO::FETCH_ASSOC);

        // 3. Algorithme de vérification
        $tousLivres = true;
        
        foreach ($tousLesColis as $colis) {
            // Si on trouve UN SEUL colis non livré (0 ou false), alors la commande n'est pas finie
            if ($colis['LivréOuiOuNon'] == 0) {
                $tousLivres = false;
                break; // Pas besoin de continuer à chercher, on sait que c'est pas fini
            }
        }

        // 4. Déterminer le nouveau statut de la commande
        $nouveauStatut = $tousLivres ? 'livré' : 'en_cours';

        // 5. Mettre à jour le statut global de la Commande
        $sqlUpdateCommande = "UPDATE Commande SET statut = :statut WHERE NumeroBonDeCommande = :idCommande";
        $stmtUpdate = $this->pdo->prepare($sqlUpdateCommande);
        $stmtUpdate->execute([
            ':statut' => $nouveauStatut,
            ':idCommande' => $idCommande
        ]);
    }

    public function getColisById($idColis) {
        $sql = "SELECT * FROM Colis WHERE idColis = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idColis]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateColis($idColis, $taille, $poids) {
        $sql = "UPDATE Colis SET Taille = ?, Poids = ? WHERE idColis = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$taille, $poids, $idColis]);
    }
}
?>
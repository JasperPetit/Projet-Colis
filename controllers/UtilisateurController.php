<?php
namespace App\Controllers;

use App\Models\UtilisateurModel;
use Exception;

class UtilisateurController{

    private $pdo;
    private $UtilisateurModel;

    public function __construct($db)
    {
        $this->pdo = $db;
        $this->UtilisateurModel = new UtilisateurModel($db);
    }

    public function SupprimerUtilisateur(){
        // Vérification du POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
            $id_utilisateur = $_POST['id_utilisateur'] ?? '';

            if (!empty($id_utilisateur)) {
                try {
                    // Suppression via le modèle
                    $this->UtilisateurModel->deleteUtilisateur($id_utilisateur);
                    
                    // Redirection CORRECTE vers la liste
                    header("Location: index.php?action=pageVoirUtilisateurs&success=1");
                    exit();

                } catch (Exception $e) {
                    // Erreur : Redirection avec message
                    header("Location: index.php?action=pageVoirUtilisateurs&error=" . urlencode($e->getMessage()));
                    exit();
                }
            }
        }

        // Si pas de POST, on renvoie à la liste
        header("Location: index.php?action=pageVoirUtilisateurs");
        exit();
    }

    public function AjouterUtilisateur(){
        $erreur = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = $_POST['prenom'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $role = $_POST['Role'] ?? '';
            $mdp = $_POST['mdpCAS'] ?? '';

            if (!empty($prenom) && !empty($nom) && !empty($role) && !empty($mdp)) {
                try {
                    $this->UtilisateurModel->ajouterUtilisateur($prenom, $nom, $role, $mdp);
                    header("Location: index.php?action=pageVoirUtilisateurs");
                    exit();
                } catch (Exception $e) {
                    $erreur = "Erreur : " . $e->getMessage();
                }
            } else {
                $erreur = "Veuillez remplir tous les champs !";
            }
        }
        
        require_once __DIR__ . '/../views/pageAjouterUtilisateur.php';
    }

    public function AfficherAdmin(){
        require_once __DIR__ . '/../views/pageAdmin.php';
    }

    public function AfficherListe() {
        $resListeUtilisateurs = $this->UtilisateurModel->getAllUtilisateurs();
        require_once __DIR__ . '/../views/pageVoirUtilisateurs.php';
    }
}
?>
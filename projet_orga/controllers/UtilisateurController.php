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
    $message_succes = null;
    $message_erreur = null;

    // Gestion de la suppression
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
        $id_utilisateur = $_POST['id_utilisateur'] ?? '';

        if (!empty($id_utilisateur)) {
            try {
                $this->UtilisateurModel->deleteUtilisateur( $id_utilisateur);
                $message_succes = "L'utilisateur a été supprimé avec succès.";
                require_once __DIR__ . '/../views/pageVoirUtilisateurs.php';
            } catch (Exception $e) {
                $message_erreur = "Erreur : " . $e->getMessage();
                require_once __DIR__ . '/../views/pageVoirUtilisateurs.php';

            }
        }
    }

    // Récupération de la liste mise à jour
        header("Location: voirUtilisateurs?success=suppression");
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

                // Redirection après succès
                header("Location: pageVoirUtilisateurs");
                exit();
            } catch (Exception $e) {
                $erreur = "Erreur : " . $e->getMessage();
            }
        } else {
            $erreur = "Veuillez remplir tous les champs !";
            require_once '/views/PageAjoutUtilisateur';

        }
        }
    require_once __DIR__ . '/../views/PageAjouterUtilisateur.php';
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
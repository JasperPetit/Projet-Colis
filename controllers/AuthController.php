<?php
namespace App\Controllers;
use \PDO;
use Exception;

class AuthController {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function afficherLogin() {
        $erreur = '';

        require_once  'views/pageLogin.php';
    }

    public function connecter() {
        $erreur = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifiant = $_POST['identifiant'] ?? '';
            $mot_de_passe = $_POST['mot_de_passe'] ?? '';
            
            if ($identifiant !== '' && $mot_de_passe !== '') {
                try {
                    $sql = "SELECT * FROM Utilisateur WHERE identifiantCAS = :id";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->execute([':id' => $identifiant]);
                    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($utilisateur && $utilisateur['mdpCAS'] == $mot_de_passe) {
                        $_SESSION['utilisateur_id'] = $utilisateur['identifiantCAS'];
                        $_SESSION['nom_complet'] = $utilisateur['Prenom'] . ' ' . $utilisateur['nom'];
                        $_SESSION['role'] = $utilisateur['Role'];
                        
                        header('Location: index.php?action=accueil');
                        exit();
                    } else {
                        $erreur = 'Identifiant ou mot de passe incorrect';
                    }
                } catch (Exception $e) {
                    $erreur = 'Erreur technique';
                }
            } else {
                $erreur = 'Veuillez remplir tous les champs';
            }
        }
        require_once  'views/pageLogin.php';
    }
}
?>
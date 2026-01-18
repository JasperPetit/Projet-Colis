<?php
namespace App\Controllers;
use App\Models\CommandeModel;
use App\Models\DevisService as ModelsDevisService;

use App\Models\FournisseurModel;

use Exception;
use PDO;

class CommandeController{

    private $pdo;
    private $CommandeModel;
    private $DevisService;
    private $FournisseurModel;

    function __construct($db)
    {
        $this->pdo = $db;
        $this->CommandeModel = new CommandeModel($db);
        $this->DevisService = new ModelsDevisService($db);
        $this->FournisseurModel = new FournisseurModel($db);
    }
    function ajouterCommande(){
        
        $erreur = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';
            $idDevis = $_POST['idDevis'] ?? '';
            //$idFournisseur = $_POST['idFournisseur'] ?? '';
            $AdresseDepart = $_POST['AdresseDepart'] ?? '';
            $nbColis = $_POST['nbColis'] ?? '';
            $AdresseArivee = $_POST['AdresseArivee'] ?? '';
            $dateArrivee = $_POST['DateArrivee'] ?? ''; 
            $nomFichier = "";
        
            // Si un fichier a été envoyé
            if (!empty($_FILES['ImageCommande']['name'])) {
                $nomFichier = $_FILES['ImageCommande']['name'];
                
                // On le déplace directement dans le dossier "uploads"
                // ATTENTION : Le dossier "uploads" doit exister physiquement !
                move_uploaded_file($_FILES['ImageCommande']['tmp_name'], "uploads/" . $nomFichier);
            }

            if (!empty($NumeroBonDeCommande) && !empty($idDevis) && !empty($dateArrivee) ) {
                try {
                    // Récupération de la date du devis
                    $dateDepart = date('Y-m-d');

                    if ($dateDepart) {
                        // Création de la commande unique dans la table Commande
                        $this->CommandeModel->ajouterCommande( $NumeroBonDeCommande, $AdresseDepart, $AdresseArivee, $dateDepart, $nbColis, $idDevis, $dateArrivee);
                        /*
                        // On commence par supprimer toute liaison existante pour cet idDevis
                        $stmtDelete = $this->pdo->prepare("DELETE FROM Commandé_a_ WHERE idDevis = ?");
                        $stmtDelete->execute([$idDevis]);

                        // On insère ensuite la nouvelle liaison propre
                        $stmtLink = $this->pdo->prepare("INSERT INTO Commandé_a_ (idDevis, idFournisseur) VALUES (?, ?)");
                        $stmtLink->execute([$idDevis, $idFournisseur]);
                        */
                        header("Location: afficherCommande?sucess=1");
                        exit();
                    }
                } catch (Exception $e) {
                    // Gestion de l'erreur si le numéro de commande est déjà pris
                    if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
                        $erreur = "Le numéro de commande n°$NumeroBonDeCommande existe déjà.";
                    } else {
                        $erreur = "Erreur SQL : " . $e->getMessage();
                        require_once 'views/pageUtilisateur';
                    }
                }
            } else {
                $erreur = "Veuillez remplir tous les champs, y compris le fournisseur.";
                require_once 'views/pageUtilisateur';
            }


        }
        $listeDevis = $this->DevisService->getAllDevis();   
        $resNomEntreprise = $this->FournisseurModel->getAllFournisseurs();


        require_once 'views/pageAjouterCommande.php';
    }

    public function afficherCommande(){
        $resListeCommandes = $this->CommandeModel->getListeCommandesCompletes();
        $idDevis = $this->DevisService->RecupererIdDevis();
        $resNomEntreprise = $this->FournisseurModel->getAllFournisseurs($this->pdo);
        require_once 'views/pageMesCommandes.php';
    }

    public function SupprimerCommande(){
        $resListeCommandes = $this->CommandeModel->getListeCommandesCompletes();

        // On vérifie si une suppression est demandée
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_commande'])) {
            $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';

            if (!empty($NumeroBonDeCommande)) {
                try {
                    $this->CommandeModel->deleteCommande($NumeroBonDeCommande);
                    echo "<script>alert('La commande a été supprimé avec succès.'); window.location.href='pageMesCommandes.php';</script>";
                    header("Location: index.php?action=afficherCommande");
                    exit();
                } catch (Exception $e) {
                    echo "<script>alert('Erreur : Impossible de supprimer cette commande car il est lié à des jsp.');</script>";
                }
            }
        }
    }

    public function ModifierCommande(){
        $erreur = null;
        $commande = null;

        // On récupère les infos actuelles pour remplir les inputs
        if (isset($_GET['modifier'])) {
            $num = $_GET['modifier'];
            $query = $this->pdo->prepare("SELECT * FROM Commande WHERE NumeroBonDeCommande = ?");
            $query->execute([$num]);
            $commande = $query->fetch(PDO::FETCH_ASSOC);
        }

        // On enregistre quand le formulaire est soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';
            $idDevis = $_POST['idDevis'] ?? '';
            $AdresseDepart = $_POST['AdresseDepart'] ?? '';
            $nbColis = $_POST['nbColis'] ?? '';
            $AdresseArivee = $_POST['AdresseArivee'] ?? '';
            $dateArrivee = $_POST['DateArrivee'] ?? '';

            if (!empty($NumeroBonDeCommande) && !empty($idDevis) && !empty($AdresseArivee)) {
                try {
                    $success = $this->CommandeModel->modifierCommande( $NumeroBonDeCommande, $AdresseDepart, $AdresseArivee, $nbColis, $idDevis, $dateArrivee);

                    if ($success) {
                        header("Location: afficherCommande");
                        exit();
                    } else {
                        $erreur = "La mise à jour a échoué.";
                    }
                } catch (Exception $e) {
                    $erreur = "Erreur SQL : " . $e->getMessage();
                }
            } else {
                $erreur = "Veuillez remplir les champs obligatoires.";
            }
        }

        $listeDevis = $this->DevisService->getAllDevis();
        $resNomEntreprise = $this->FournisseurModel->getAllFournisseurs();
        require_once __DIR__ . '/../views/pageModifierCommande.php';   
    }
}
?>
<?php
    $erreur = null;

    // Si le formulaire a été envoyé (méthode POST) on traite les données 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';
        $Date = $_POST['Date_'] ?? '';
        $nbColis = $_POST['nbColis'] ?? '';
        $AdresseArivee = $_POST['AdresseArivee'] ?? '';

        if (!empty($NumeroBonDeCommande) && !empty($Date) && !empty($AdresseArivee)) {
            try {
                ajouterCommande($db, $NumeroBonDeCommande, $AdresseArivee, $Date, $nbColis);
                
                // Redirection vers la liste des commandes
                header("Location: pageMesCommandes.php");
                exit();
            } catch (Exception $e) {
                $erreur = "Erreur SQL : " . $e->getMessage();
            }
        } else {
            $erreur = "Veuillez remplir les champs obligatoires !";
        }
    }

    $resNomEntreprise = getListeNomsFournisseurs($db);
?>
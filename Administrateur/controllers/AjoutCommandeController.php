<?php
    $erreur = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';
        $idDevis = $_POST['idDevis'] ?? '';
        $AdresseDepart = $_POST['AdresseDepart'] ?? '';
        $nbColis = $_POST['nbColis'] ?? '';
        $AdresseArivee = $_POST['AdresseArivee'] ?? '';
        $dateArrivee = $_POST['DateArrivee'] ?? ''; // La date saisie dans la vue

        if (!empty($NumeroBonDeCommande) && !empty($idDevis) && !empty($dateArrivee)) {
            try {
                // Récupération de la date du devis (pour le modèle)
                $dateDepart = getDateDepart($db, $idDevis);

                if ($dateDepart) {
                    // Appel à la fonction avec les deux dates
                    ajouterCommande($db, $NumeroBonDeCommande, $AdresseDepart, $AdresseArivee, $dateDepart, $nbColis, $idDevis, $dateArrivee);

                    header("Location: pageMesCommandes.php");
                    exit();
                }
            } catch (Exception $e) {
                // Gestion de l'erreur UNIQUE constraint failed
                if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
                    $erreur = "Le numéro de commande n°$NumeroBonDeCommande existe déjà.";
                } else {
                    $erreur = "Erreur SQL : " . $e->getMessage();
                }
            }
        }
    }

    $listeDevis = getListeDevis($db);
    $resNomEntreprise = getListeNomsFournisseurs($db);
?>
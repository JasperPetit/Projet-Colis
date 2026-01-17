<?php
    $erreur = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';
        $idDevis = $_POST['idDevis'] ?? '';
        $idFournisseur = $_POST['idFournisseur'] ?? '';
        $AdresseDepart = $_POST['AdresseDepart'] ?? '';
        $nbColis = $_POST['nbColis'] ?? '';
        $AdresseArivee = $_POST['AdresseArivee'] ?? '';
        $dateArrivee = $_POST['DateArrivee'] ?? ''; 

        if (!empty($NumeroBonDeCommande) && !empty($idDevis) && !empty($dateArrivee) && !empty($idFournisseur)) {
            try {
                // Récupération de la date du devis
                $dateDepart = getDateDepart($db, $idDevis);

                if ($dateDepart) {
                    // Création de la commande unique dans la table Commande
                    ajouterCommande($db, $NumeroBonDeCommande, $AdresseDepart, $AdresseArivee, $dateDepart, $nbColis, $idDevis, $dateArrivee);

                    // On commence par supprimer toute liaison existante pour cet idDevis
                    $stmtDelete = $db->prepare("DELETE FROM Commandé_a_ WHERE idDevis = ?");
                    $stmtDelete->execute([$idDevis]);

                    // On insère ensuite la nouvelle liaison propre
                    $stmtLink = $db->prepare("INSERT INTO Commandé_a_ (idDevis, idFournisseur) VALUES (?, ?)");
                    $stmtLink->execute([$idDevis, $idFournisseur]);

                    header("Location: pageMesCommandes.php");
                    exit();
                }
            } catch (Exception $e) {
                // Gestion de l'erreur si le numéro de commande est déjà pris
                if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
                    $erreur = "Le numéro de commande n°$NumeroBonDeCommande existe déjà.";
                } else {
                    $erreur = "Erreur SQL : " . $e->getMessage();
                }
            }
        } else {
            $erreur = "Veuillez remplir tous les champs, y compris le fournisseur.";
        }
    }

    // Récupération des données pour remplir le formulaire
    $listeDevis = getListeDevis($db);
    $resNomEntreprise = getListeNomsFournisseurs($db);
?>
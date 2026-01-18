<?php
    $erreur = null;
    $commande = null;

    // On récupère les infos actuelles pour remplir les inputs
    if (isset($_GET['modifier'])) {
        $num = $_GET['modifier'];
        $query = $db->prepare("SELECT * FROM Commande WHERE NumeroBonDeCommande = ?");
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
                $success = modifierCommande($db, $NumeroBonDeCommande, $AdresseDepart, $AdresseArivee, $nbColis, $idDevis, $dateArrivee);

                if ($success) {
                    header("Location: pageMesCommandes.php");
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

    $listeDevis = getListeDevis($db);
    $resNomEntreprise = getListeNomsFournisseurs($db);
?>
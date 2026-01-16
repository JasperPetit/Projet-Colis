<?php
    $resListeCommandes = getListeCommandesCompletes($db);

    // On vérifie si une suppression est demandée
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_commande'])) {
        $NumeroBonDeCommande = $_POST['NumeroBonDeCommande'] ?? '';

        if (!empty($NumeroBonDeCommande)) {
            try {
                deleteCommande($db, $NumeroBonDeCommande);
                echo "<script>alert('La commande a été supprimé avec succès.'); window.location.href='pageMesCommandes.php';</script>";
                exit();
            } catch (Exception $e) {
                echo "<script>alert('Erreur : Impossible de supprimer cette commande car il est lié à des jsp.');</script>";
            }
        }
    }

?>
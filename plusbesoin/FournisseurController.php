<?php
    // On vérifie si une suppression est demandée
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_fournisseur'])) {
        $id_fournisseur = $_POST['id_fournisseur'] ?? '';

        if (!empty($id_fournisseur)) {
            try {
                deleteFournisseur($db, $id_fournisseur);
                echo "<script>alert('Le fournisseur a été supprimé avec succès.'); window.location.href='pageFournisseurs.php';</script>";
                exit();
            } catch (Exception $e) {
                echo "<script>alert('Erreur : Impossible de supprimer ce fournisseur car il est lié à des commandes.');</script>";
            }
        }
    }

    $resFournisseurs = getAllFournisseurs($db);
?>
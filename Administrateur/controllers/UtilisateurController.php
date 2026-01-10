<?php
    $message_succes = null;
    $message_erreur = null;

    // Gestion de la suppression
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
        $id_utilisateur = $_POST['id_utilisateur'] ?? '';

        if (!empty($id_utilisateur)) {
            try {
                deleteUtilisateur($db, $id_utilisateur);
                $message_succes = "L'utilisateur a été supprimé avec succès.";
            } catch (Exception $e) {
                $message_erreur = "Erreur : " . $e->getMessage();
            }
        }
    }

    // Récupération de la liste mise à jour
    $resListeUtilisateurs = getAllUtilisateurs($db);
?>
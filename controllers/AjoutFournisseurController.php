<?php
    // Si le formulaire a été envoyé (méthode POST) on traite les données 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomEntreprise = $_POST['nomEntreprise'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        $NumeroTelephone = $_POST['NumeroTelephone'] ?? '';
        $Mail = $_POST['Mail'] ?? '';

        if (!empty($nomEntreprise)) {
            try {
                ajouterFournisseur($db, $nomEntreprise, $adresse, $NumeroTelephone, $Mail);

                // Redirection vers la liste après succès
                header("Location: pageFournisseurs.php");
                exit();
            } catch (Exception $e) {
                echo "<script>alert('Erreur : " . addslashes($e->getMessage()) . "');</script>";
            }
        }
    }
?>
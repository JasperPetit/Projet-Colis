<?php
    $erreur = null;
    $fournisseur = null;

    // On récupère les infos du fournisseur si l'ID est dans l'URL
    if (isset($_GET['modifier'])) {
        $id = $_GET['modifier'];
        $fournisseur = getFournisseurById($db, $id);
    }

    // Traitement de la modification
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['idFournisseur'] ?? '';
        $nom = $_POST['nomEntreprise'] ?? '';
        $adresse = $_POST['adresse'] ?? '';
        $tel = $_POST['NumeroTelephone'] ?? '';
        $mail = $_POST['Mail'] ?? '';

        if (!empty($id) && !empty($nom)) {
            try {
                modifierFournisseur($db, $id, $nom, $adresse, $tel, $mail);
                header("Location: pageFournisseurs.php");
                exit();
            } catch (Exception $e) {
                $erreur = "Erreur lors de la modification : " . $e->getMessage();
            }
        } else {
            $erreur = "Le nom de l'entreprise est obligatoire.";
        }
}

?>
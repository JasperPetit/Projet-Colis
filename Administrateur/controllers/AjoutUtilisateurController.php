<?php
    $erreur = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $role = $_POST['Role'] ?? '';
        $mdp = $_POST['mdpCAS'] ?? '';

        if (!empty($prenom) && !empty($nom) && !empty($role) && !empty($mdp)) {
            try {
                ajouterUtilisateur($db, $prenom, $nom, $role, $mdp);

                // Redirection après succès
                header("Location: pageVoirUtilisateurs.php");
                exit();
            } catch (Exception $e) {
                $erreur = "Erreur : " . $e->getMessage();
            }
        } else {
            $erreur = "Veuillez remplir tous les champs !";
        }
    }
?>
<?php 
    require_once "../config/DBconnect.php";            
    require_once "../models/UtilisateurModel.php"; 
    require_once "../controllers/UtilisateurController.php"; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <main>
        <div class="titre">
            <h1>Liste des utilisateurs</h1>
        </div>

        <div id="gestion-utilisateurs">
            <h3>Utilisateurs enregistrés</h3>
            <p>Voici la liste complète des utilisateurs du système</p>

            <?php if ($message_succes): ?>
                <div style="color: green; padding: 10px; margin: 10px 0; border: 1px solid green; border-radius: 5px; background-color: #d4edda;">
                    <?= htmlspecialchars($message_succes) ?>
                </div>
            <?php endif; ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($resListeUtilisateurs as $utilisateur): ?>
                        <tr>
                            <td><?= htmlspecialchars($utilisateur['Prenom']) ?></td>
                            <td><?= strtoupper(htmlspecialchars($utilisateur['nom'])) ?></td>
                            <td><?= htmlspecialchars($utilisateur['Role']) ?></td>
                            <td>
                                <form method="POST" style="display: inline; margin: 0; padding: 0; border: none; background: none;" onsubmit="return confirmerSuppression('<?= htmlspecialchars($utilisateur['nom']) ?>')">
                                    <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['identifiantCAS'] ?>">
                                    <button type="submit" name="supprimer" class="bouton-supprimer">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>

            <br>
            <div style="display: flex; gap: 10px;">
                <a href="pageAdmin.php"><button>Retour à l'administration</button></a>
                <a href="pageAjouterUtilisateur.php"><button>Ajouter un utilisateur</button></a>
            </div>
        </div>
    </main>

    <script>
        function confirmerSuppression(nomAttendu) {
            var saisie = prompt("Veuillez saisir le nom de l'utilisateur (" + nomAttendu.toUpperCase() + ") pour confirmer la suppression :");
            if (saisie === null) return false; 
            if (saisie.trim().toLowerCase() === nomAttendu.toLowerCase()) return true; 
            alert("Le nom ne correspond pas. Suppression annulée.");
            return false; 
        }
    </script>
</body>
</html>
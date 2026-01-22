<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="public/style.css">
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

            <?php if (isset($_GET['success'])): ?>
                <div style="color: green; padding: 10px; margin: 10px 0; border: 1px solid green; border-radius: 5px; background-color: #d4edda;">
                    L'utilisateur a été supprimé avec succès.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div style="color: red; padding: 10px; margin: 10px 0; border: 1px solid red; border-radius: 5px; background-color: #f8d7da;">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>
            
            <table>
                <thead>
                    <tr>
                        <th>identifiant</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($resListeUtilisateurs as $utilisateur): ?>
                        <tr>
                            <td><?= !empty($utilisateur['identifiantCAS']) ? htmlspecialchars($utilisateur['identifiantCAS']) : 'IdentifiantCAS inconnu' ?></td>
                            <td><?= !empty($utilisateur['Prenom']) ? htmlspecialchars($utilisateur['Prenom']) : 'Prenom inconnu' ?></td>
                            <td><?= !empty($utilisateur['nom']) ? strtoupper(htmlspecialchars($utilisateur['nom'])) : 'Nom inconnu' ?></td>
                            <td><?= !empty($utilisateur['Role']) ? htmlspecialchars($utilisateur['Role']): 'Role inconnu' ?></td>
                            <td>
                                <form action="index.php?action=SupprimerUtilisateur" method="POST" style="display: inline; margin: 0; padding: 0; border: none; background: none;" onsubmit="return confirmerSuppression('<?= htmlspecialchars($utilisateur['nom']) ?>')">
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
                <a href="pageAdmin"><button>Retour à l'administration</button></a>
                <a href="pageAjouterUtilisateur"><button>Ajouter un utilisateur</button></a>
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
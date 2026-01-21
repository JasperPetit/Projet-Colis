<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include "navbar.php"; ?>

    <main>
        <div class="titre">
            <h1>Ajouter un utilisateur</h1>
        </div>

        <div id="gestion-utilisateurs">
            <h3>Nouvel utilisateur</h3>
            <p>Complétez le formulaire pour créer un nouveau compte utilisateur</p>

            <?php if (isset($erreur) && $erreur): ?>
                <div style="color: #721c24; padding: 10px; margin: 10px 0; border: 1px solid #f5c6cb; border-radius: 5px; background-color: #f8d7da;">
                    <?= htmlspecialchars($erreur) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required placeholder="Ex: Jean"><br>

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required placeholder="Ex: Dupont"><br>

                <label for="role">Rôle :</label>
                <select id="role" name="Role" required onchange="afficherDepartement()">
                    <option value="">-- Sélectionner un rôle --</option>
                    <option value="Administrateur">Administrateur</option>
                    <option value="Service Financier">Service Financier</option>
                    <option value="Service Postal">Service Postal</option>
                    <option value="Demandeur">Demandeur</option>
                </select><br>

                <div id="div-departement" style="display: none;">
                    <label for="departement">Département :</label>
                    <select id="departement" name="departement">
                        <option value="">-- Sélectionner un département --</option>
                        <option value="Informatique">Informatique</option>
                        <option value="Génie Electrique">Génie Electrique</option>
                        <option value="Réseaux & Télécommunications">Réseaux & Télécommunications</option>
                        <option value="Ressources Humaines">Ressources Humaines</option>
                    </select><br>
                </div>

                <label for="mdpCAS">Mot de passe :</label>
                <input type="password" id="mdpCAS" name="mdpCAS" required placeholder="Mot de passe"><br>

                <div style="display: flex; gap: 10px;">
                    <button type="submit">Ajouter l'utilisateur</button>
                    <a href="pageVoirUtilisateurs"><button type="button" style="background-color: #6c757d;">Annuler</button></a>
                </div>
            </form>
        </div>
    </main>

    <script>
        function afficherDepartement() {
            var roleSelect = document.getElementById("role");
            var divDepartement = document.getElementById("div-departement");
            var selectDepartement = document.getElementById("departement");

            if (roleSelect.value === "Demandeur") {
                divDepartement.style.display = "block";
                selectDepartement.required = true; // Devient obligatoire
            } else {
                divDepartement.style.display = "none";
                selectDepartement.required = false; // N'est plus obligatoire
                selectDepartement.value = ""; // On réinitialise la valeur
            }
        }
    </script>
</body>
</html>
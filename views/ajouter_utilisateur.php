<div class="titre">
    <h1>Ajouter un utilisateur</h1>
</div>

<div id="gestion-utilisateurs">
    <h3>Nouvel utilisateur</h3>
    <p>Complétez le formulaire pour créer un nouveau compte utilisateur</p>

    <?php if (isset($erreur) && $erreur): ?>
        <div style="color: red; padding: 10px; margin: 10px 0; border: 1px solid red; border-radius: 5px; background-color: #f8d7da;">
            <?= htmlspecialchars($erreur) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=ajouter_utilisateur" method="POST">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="role">Rôle :</label>
        <input type="text" id="role" name="Role" required><br>

        <label for="mdpCAS">Mot de passe :</label>
        <input type="password" id="mdpCAS" name="mdpCAS" required><br>

        <div style="display: flex; gap: 10px;">
            <button type="submit">Ajouter l'utilisateur</button>
            <a href="index.php?page=admin"><button type="button" style="background-color: var(--text-muted);">Annuler</button></a>
        </div>
    </form>
</div>
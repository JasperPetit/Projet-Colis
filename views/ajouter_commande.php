<h1>Ajout de Commande</h1>

<?php if (isset($erreur) && $erreur): ?>
    <div style="color: red; background: #fee2e2; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
        <?= htmlspecialchars($erreur) ?>
    </div>
<?php endif; ?>

<form action="index.php?page=ajouter_commande" method="POST">

    <label for="num_commande">Numéro de commande :</label>
    <input type="text" id="num_commande" name="NumeroBonDeCommande" placeholder="ex: CMD-2025-001" required>
    <br>

    <label for="date">Date de commande :</label>
    <input type="date" id="date" name="Date_" required>
    <br>

    <label for="nb_colis">Nombre de colis :</label>
    <input type="number" id="nb_colis" name="nbColis" min="1" value="1">
    <br>

    <label for="fournisseur">Fournisseur :</label>
    <select id="fournisseur" name="idFournisseur">
        <?php foreach ($resNomEntreprise as $entreprise): ?>
            <option value="<?= $entreprise['nomEntreprise'] ?>">
                <?= htmlspecialchars($entreprise['nomEntreprise']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="adresse">Adresse d'arrivée :</label><br>
    <textarea id="adresse" name="AdresseArivee" rows="3" required></textarea>
    <br>

    <button type="submit">Ajouter la commande</button>
</form>
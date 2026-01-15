<h1 id="titre-accueil">Suivi Colis - IUT de Villetaneuse</h1> <br>

<div class="conteneur-cartes-accueil">
    <div class="colis-en-attente">
        <h3>Colis en attente</h3>
        <p><?= $nbAttente ?></p>                
    </div>

    <div class="commande-en-cours">
        <h3>Commande en cours</h3>
        <p><?= $nbEnCours ?></p>
    </div>

    <div class="commande-en-retard">
        <h3>Commande en retard</h3>
        <p><?= $nbRetard ?></p>
    </div>

    <div class="dernier-colis-livré">
        <h3>Dernier colis livré</h3>

        <?php if ($dernierColis): ?>
            <p>Bon de commande :</p>
            <p><strong>nº <?= htmlspecialchars($dernierColis["NumeroBonDeCommande"]) ?></strong></p>
            <p><em>Livré le <?= htmlspecialchars($dernierColis["Date_"]) ?>.</em></p>
        <?php else: ?>
            <p>Aucun colis livré récemment.</p>
        <?php endif; ?>
    </div>
</div>
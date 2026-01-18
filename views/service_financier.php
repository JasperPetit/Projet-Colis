<div class="titre">
    <h1>Service Financier</h1>
</div>

<?php if (isset($_GET['success'])): ?>
    <div class='alert success'>Action effectuée avec succès !</div>
<?php endif; ?>

<div class="dashboard-finance">
    <h2>État des Budgets</h2>
    <div class="budgets-container">
        <?php foreach ($resBudgets as $bud): 
            $restant = $bud['BudgetDepartement'] - $bud['BudgetDepense'];
            $pourcentage = ($bud['BudgetDepartement'] > 0) ? ($bud['BudgetDepense'] / $bud['BudgetDepartement']) * 100 : 0;
            $couleur = ($pourcentage > 90) ? 'danger' : (($pourcentage > 70) ? 'warning' : 'success');
        ?>
        <div class="budget-card">
            <h3><?= htmlspecialchars($bud['nomDepartement']) ?></h3>
            <p>Budget : <strong><?= number_format($bud['BudgetDepartement'], 0) ?> €</strong></p>
            <p>Dépensé : <?= number_format($bud['BudgetDepense'], 0) ?> €</p>
            <p>Reste : <span class="<?= $restant < 0 ? 'text-red' : 'text-green' ?>"><?= number_format($restant, 0) ?> €</span></p>
            <div class="barre-progression"><div class="progression-remplissage <?= $couleur ?>" style="width: <?= $pourcentage ?>%;"></div></div>
        </div>
        <?php endforeach; ?>
    </div>

    <h2>Devis à valider</h2>
    <div id="listeCommandes">
        <?php foreach ($commandes_a_valider as $cmd): ?>
            <div class="commande-card">
                <div class="commande-info">
                    <h3>Devis n°<?= $cmd['idDevis'] ?> - <?= htmlspecialchars($cmd['nomEntreprise'] ?? 'Fournisseur Inconnu') ?></h3>
                    <p>👤 Demandeur : <?= htmlspecialchars($cmd['nom']) ?> (<?= htmlspecialchars($cmd['nomDepartement'] ?? 'Sans département') ?>)</p>
                    <p>💰 Montant : <strong><?= number_format($cmd['prix'], 2, ',', ' ') ?> €</strong></p>
                </div>
                <form method="POST" class="actions-validation" action="index.php?action=validerDevis">
                    <input type="hidden" name="id_devis" value="<?= $cmd['idDevis'] ?>">
                    <button type="submit" name="action" value="refuser" class="btn-refuser" style="background-color: #dc3545; color: white;">Refuser</button>
                    <button type="submit" name="action" value="valider" class="btn-valider" style="background-color: #28a745; color: white;">Valider</button>
                </form>
            </div>
        <?php endforeach; ?>
        <?php if (empty($commandes_a_valider)) echo "<p>Aucun devis en attente. Tout est à jour !</p>"; ?>
    </div>
</div>
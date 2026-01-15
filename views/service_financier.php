<?php
// views/service_financier.php

// On gère les actions (Valider/Refuser) directement ici
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id_devis'])) {
    $idDevis = $_POST['id_devis'];
    // 1 = Validé, 2 = Refusé
    $statut = ($_POST['action'] === 'valider') ? 1 : 2;
    try {
        // CORRECTION : On utilise le vrai nom de la colonne 'SignatureOuiOuNon'
        $stmt = $db->prepare("UPDATE devis SET SignatureOuiOuNon = ? WHERE idDevis = ?");
        $stmt->execute([$statut, $idDevis]);
        echo "<div class='alert success'>Action effectuée avec succès !</div>";
    } catch (Exception $e) {
        echo "<div class='alert error'>Erreur : " . $e->getMessage() . "</div>";
    }
}

// Calcul des Budgets
$sqlBudgets = "
    SELECT d.idDepartement, d.nomDepartement, d.BudgetDepartement,
        (SELECT IFNULL(SUM(dv.prix), 0) FROM devis dv
         JOIN Utilisateur u ON dv.identifiantCAS = u.identifiantCAS
         JOIN Appartient_a aa ON u.identifiantCAS = aa.identifiantCAS
         WHERE aa.idDepartement = d.idDepartement AND dv.SignatureOuiOuNon = 1) as BudgetDepense
    FROM Departement d";
$resBudgets = $db->query($sqlBudgets)->fetchAll(PDO::FETCH_ASSOC);

// Récupération des commandes à valider (SignatureOuiOuNon = 0 ou NULL selon ta logique, ici on suppose 0)
$sqlValid = "
    SELECT dv.*, f.nomEntreprise, u.nom, d.nomDepartement 
    FROM devis dv
    LEFT JOIN Commandé_a_ ca ON dv.idDevis = ca.idDevis
    LEFT JOIN Fournisseur f ON ca.idFournisseur = f.idFournisseur
    LEFT JOIN Utilisateur u ON dv.identifiantCAS = u.identifiantCAS
    LEFT JOIN Appartient_a aa ON u.identifiantCAS = aa.identifiantCAS
    LEFT JOIN Departement d ON aa.idDepartement = d.idDepartement
    WHERE dv.SignatureOuiOuNon = 0 OR dv.SignatureOuiOuNon IS NULL";
$commandes_a_valider = $db->query($sqlValid)->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="titre">
    <h1>Service Financier</h1>
</div>

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
                <form method="POST" class="actions-validation" action="index.php?page=finance">
                    <input type="hidden" name="id_devis" value="<?= $cmd['idDevis'] ?>">
                    <button type="submit" name="action" value="refuser" class="btn-refuser" style="background-color: #dc3545; color: white;">Refuser</button>
                    <button type="submit" name="action" value="valider" class="btn-valider" style="background-color: #28a745; color: white;">Valider</button>
                </form>
            </div>
        <?php endforeach; ?>
        <?php if (empty($commandes_a_valider)) echo "<p>Aucun devis en attente. Tout est à jour !</p>"; ?>
    </div>
</div>
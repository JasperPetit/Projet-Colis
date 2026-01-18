<?php
$page_active = 'transactions';
$titre_page = 'Historique des Transactions';
include 'header.php';

require_once 'autoload.php';

$factureModel = new FactureModel();
$controller = new FactureController($factureModel);
$recherche = isset($_GET['q']) ? trim($_GET['q']) : '';

// Traitement de la suppression d'une transaction
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $factureModel->delete($_GET['id']);
    echo "<script>window.location.href='transactions.php';</script>";
    exit;
}

// Traitement de la réinitialisation
if (isset($_GET['action']) && $_GET['action'] == 'reset') {
    $data = json_decode(file_get_contents('bdd.json'), true);
    $data['factures'] = [];
    file_put_contents('bdd.json', json_encode($data));
    echo "<script>window.location.href='transactions.php';</script>";
    exit;
}

// Récupération des factures (avec recherche si applicable)
if (!empty($recherche)) {
    $data = $controller->search($recherche);
} else {
    $data = $controller->index();
}

$factures = $data['factures'];
?>

<div class="box">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0;">Historique des opérations</h3>
        <?php if (!empty($factures)): ?>
            <a href="transactions.php?action=reset" 
               onclick="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer TOUTES les transactions ? Cette action est irréversible !');" 
               class="btn-outline" 
               style="padding: 8px 15px; background: #ffebee; color: #c62828; border-color: #c62828;">
                Réinitialiser toutes les transactions
            </a>
        <?php endif; ?>
    </div>
    
    <?php if (!empty($recherche)): ?>
        <p style="color: #666; margin-bottom: 15px;">
            Résultats de recherche pour : <strong>"<?php echo htmlspecialchars($recherche); ?>"</strong>
            (<?php echo count($factures); ?> résultat(s))
        </p>
    <?php endif; ?>
    
    <?php if (empty($factures)): ?>
        <div class="empty-state">
            <p><?php echo !empty($recherche) ? 'Aucun résultat trouvé.' : 'Aucune transaction enregistrée.'; ?></p>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID / Référence</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($factures as $facture): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($facture['id'] ?? $facture['reference'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($facture['date'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($facture['client']); ?></td>
                        <td class="table-amount">
                            <?php echo number_format($facture['montant'], 2, ',', ' '); ?> €
                        </td>
                        <td>
                            <?php 
                            $statut = $facture['type'] ?? $facture['statut'] ?? 'attente';
                            $isPaye = ($statut == 'paye');
                            $isImpaye = ($statut == 'impaye' || $statut == 'impayé');
                            ?>
                            <span class="badge <?php 
                                echo $isPaye ? 'badge-success' : ($isImpaye ? 'badge-danger' : 'badge-warning'); 
                            ?>">
                                <span class="badge-icon"><?php 
                                    echo $isPaye ? '✓' : ($isImpaye ? '✗' : '⏱'); 
                                ?></span>
                                <?php echo $isPaye ? 'Payé' : ($isImpaye ? 'Impayé' : 'En attente'); ?>
                            </span>
                        </td>
                        <td>
                            <button type="button" 
        class="badge badge-danger" 
        style="border: none; cursor: pointer;"
        onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette transaction ?')) { window.location.href='transactions.php?action=delete&id=<?php echo urlencode($facture['id'] ?? ''); ?>'; }">
    
   
    
    Supprimer
</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
<?php
$page_active = 'factures';
$titre_page = 'Gestion des Factures';


if (file_exists('include/db.php')) {
    include 'include/db.php';
    require_once 'autoload.php';
    $factureModel = new FactureModel($pdo);
    $controller = new FactureController($factureModel);
    $data = $controller->index();
    $liste = $data['factures'];
} else {
    
    require_once 'autoload.php';
    $controller = new FactureController();
    $data = $controller->index();
    $liste = $data['factures'];
}

include 'header.php';
?>

<div class="box">
    <h3>Mes Factures</h3>
    
    <?php if (count($liste) == 0): ?>
        <div class="empty-state">
            <p>Aucune facture disponible.</p>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($liste as $facture): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($facture['reference'] ?? $facture['id'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($facture['client']); ?></td>
                        <td class="table-amount">
                            <strong><?php echo number_format($facture['montant'], 2, ',', ' '); ?> €</strong>
                        </td>
                        <td>
                            <?php 
                            $statut = $facture['statut'] ?? $facture['type'] ?? 'attente';
                            $isPaye = ($statut == 'paye');
                            ?>
                            <span class="badge <?php echo $isPaye ? 'badge-success' : 'badge-warning'; ?>">
                                <span class="badge-icon"><?php echo $isPaye ? '✓' : '⏱'; ?></span>
                                <?php echo $isPaye ? 'Payée' : 'En attente'; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn-outline table-action-btn" title="Télécharger en PDF">
                                ⬇ PDF
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
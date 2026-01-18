<?php
$page_active = 'payer';
$titre_page = 'Validation des Paiements';
include 'header.php';

require_once 'autoload.php';

$controller = new PaiementController();

// Traitement de la validation d'un paiement
if (isset($_GET['index'])) {
    $controller->validerParIndex((int)$_GET['index']);
}

// Récupération des factures en attente
$data = $controller->index();
extract($data);
?>

<div class="box">
    <h2>Factures à valider</h2>
    
    <?php if (!$en_attente_exist): ?>
        <div class="empty-state">
            <p>Tout est à jour ! Aucune facture en attente de validation.</p>
        </div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($factures_attente as $k => $facture): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($facture['id']); ?></td>
                        <td><?php echo htmlspecialchars($facture['client']); ?></td>
                        <td class="table-amount table-amount-pending">
                            <?php echo number_format($facture['montant'], 2, ',', ' '); ?> €
                        </td>
                        <td><?php echo isset($facture['date']) ? htmlspecialchars($facture['date']) : '-'; ?></td>
                        <td>
                            <a 
                                href="payer.php?index=<?php echo $k; ?>" 
                                class="btn-yellow table-action-btn"
                                style="background: #4caf50; color: white;"
                                onclick="return confirm('Êtes-vous sûr de vouloir valider ce paiement ?');"
                            >
                                Valider
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
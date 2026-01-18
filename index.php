<?php
// Traitement de la mise à jour du budget AVANT d'inclure le header
if (isset($_GET['action']) && $_GET['action'] == 'update_budget' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'autoload.php';
    $budgetModel = new BudgetModel();
    $budgetModel->updateBudgetTotal($_POST['budget']);
    header('Location: index.php');
    exit;
}

$page_active = 'dashboard';
$titre_page = 'Tableau de bord';
$subtitle = 'Consultez et gérez toutes vos transactions financières';
include 'header.php';

require_once 'autoload.php';
$controller = new DashboardController();
$data = $controller->index();

extract($data);

$budgetBarClass = ($pourcentage_budget > 80) ? 'budget-bar-danger' : 'budget-bar-success';
if ($pourcentage_budget > 60 && $pourcentage_budget <= 80) {
    $budgetBarClass = 'budget-bar-warning';
}
?>

<div class="kpi-container">
    <div class="kpi-card">
        <div class="kpi-icon" style="color: #4caf50;">ℯ</div>
        <div class="kpi-label">Total des paiements reçus</div>
        <div class="kpi-value-green"><?php echo number_format($revenus, 0, ',', ' '); ?> €</div>
        <div class="kpi-subinfo"><?php echo $nb_payes; ?> transaction<?php echo $nb_payes > 1 ? 's' : ''; ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="color: #ff9800;">⏱</div>
        <div class="kpi-label">En attente de paiement</div>
        <div class="kpi-value-orange"><?php echo number_format($attente, 0, ',', ' '); ?> €</div>
        <div class="kpi-subinfo"><?php echo $nb_attente; ?> transaction<?php echo $nb_attente > 1 ? 's' : ''; ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="color: #f44336;">✗</div>
        <div class="kpi-label">Factures impayées</div>
        <div class="kpi-value-red"><?php echo number_format($attente, 0, ',', ' '); ?> €</div>
        <div class="kpi-subinfo"><?php echo $nb_attente; ?> facture<?php echo $nb_attente > 1 ? 's' : ''; ?></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon" style="color: #2196f3;">✓</div>
        <div class="kpi-label">Transactions réussies</div>
        <div class="kpi-value-blue"><?php echo $nb_payes; ?></div>
        <div class="kpi-subinfo">Total des paiements validés</div>
    </div>
</div>

<div class="box budget-container">
    <div class="budget-header">
        <div>
            <strong>Contrôle du Budget</strong>
            <span style="margin-left: 10px; font-size: 12px; color: #666;">
                <a href="#" onclick="document.getElementById('edit-budget-form').style.display='block'; return false;" style="color: #fbc02d; text-decoration: none;"></a>
            </span>
        </div>
        <span><?php echo number_format($revenus, 0, ',', ' '); ?> / <?php echo number_format($budget_total, 0, ',', ' '); ?> €</span>
    </div>
    <div class="budget-bar-wrapper">
        <div class="budget-bar <?php echo $budgetBarClass; ?>" style="width: <?php echo min($pourcentage_budget, 100); ?>%;"></div>
    </div>
    <div id="edit-budget-form" style="display: none; margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
    </div>
</div>


<div class="bottom-row">
    <div class="box col-left">
        <h2>Statistiques</h2>
        <?php if (empty($factures)): ?>
            <div class="empty-state-welcome">
                <strong>Bienvenue !</strong><br>
                Le système est vide. Créez une facture pour commencer.
            </div>
        <?php else: ?>
            <div class="stat-item stat-item-pending">
                <div class="stat-icon" style="background: #1a237e;">
                    <img src="assets/img/FI.png" alt="Colis">
                </div>
                <div class="stat-info">
                    <span class="stat-label">Facture  en attente</span>
                    <div class="stat-sub"><?php echo $nb_attente; ?> colis</div>
                </div>
                <div class="stat-price"><?php echo number_format($attente, 0, ',', ' '); ?> €</div>
            </div>
            <div class="stat-item stat-item-success">
                <div class="stat-icon" style="background: #4caf50;">
                    <img src="assets/img/Dépenses totales.png" alt="Argent">
                </div>
                <div class="stat-info">
                    <span class="stat-label">Dépenses totales</span>
                    <div class="stat-sub"><?php echo count($factures); ?> factures</div>
                </div>
                <div class="stat-price"><?php echo number_format($revenus + $attente, 0, ',', ' '); ?> €</div>
            </div>
        <?php endif; ?>
    </div>

    <div class="box col-right">
        <h2>Actions rapides</h2>
        <div class="quick-actions">
            <a href="ajouter.php" class="btn-yellow btn-full-width">Nouvelle Facture</a>
            <a href="payer.php" class="btn-outline btn-full-width">Valider Paiements</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
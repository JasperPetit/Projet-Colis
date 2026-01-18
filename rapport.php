<?php
$page_active = 'rapports';
$titre = 'Rapports Financiers';
include 'includes/db.php';
include 'includes/header.php';

$budget = 100000;
$revenus = $pdo->query("SELECT SUM(montant) FROM factures WHERE statut='paye'")->fetchColumn() ?: 0;
?>

<div class="row">
    <div class="col-1 box">
        <h3>Répartition</h3>
        <p>Budget consommé : <strong style="color:var(--vert)"><?= $revenus ?> €</strong></p>
        <p>Budget restant : <strong style="color:var(--bleu)"><?= $budget - $revenus ?> €</strong></p>
    </div>
    <div class="col-2 box">
        <h3>Performance Mensuelle</h3>
        <div style="display:flex; align-items:flex-end; height:150px; gap:10px; padding-top:20px;">
            <div style="width:15%; height:20%; background:#ddd;"></div>
            <div style="width:15%; height:45%; background:#ddd;"></div>
            <div style="width:15%; height:30%; background:#ddd;"></div>
            <div style="width:15%; height:<?= ($revenus > 0) ? '80' : '5' ?>%; background:var(--bleu);"></div>
            <div style="width:15%; height:10%; background:#ddd;"></div>
        </div>
        <div style="display:flex; justify-content:space-between; margin-top:5px; color:#666; font-size:12px;">
            <span>Sept</span><span>Oct</span><span>Nov</span><span>Déc</span><span>Jan</span>
        </div>
    </div>
</div>
</div></body></html>
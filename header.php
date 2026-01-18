<?php 
// Si la page active n'est pas définie, on met "dashboard" par défaut
if (!isset($page_active)) { $page_active = 'dashboard'; } 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi Colis - Service Financier</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="top-header-bar">
    <div class="top-header-content">
        <div class="top-header-left">
            <span class="top-header-logo-text">Service Financier</span>
        </div>
        <div class="top-header-right">
            <form action="transactions.php" method="GET" class="top-header-search">
                <input type="text" name="q" class="top-header-search-input" placeholder="Rechercher facture (N°, Client)...">
            </form>
            <button class="btn-yellow top-header-btn" onclick="alert('Connecté en tant que Admin')">Se connecter</button>
        </div>
    </div>
</div>

<div class="layout-container">
    <div class="sidebar">
        <div class="logo-area">
            <img src="assets/img/logo.jpg" alt="Sorbonne Paris Nord" class="logo-img">
        </div>

        <div class="menu">
            <a href="index.php" class="menu-item <?php echo ($page_active == 'dashboard') ? 'active' : ''; ?>">Tableau de bord</a>
            <a href="transactions.php" class="menu-item <?php echo ($page_active == 'transactions') ? 'active' : ''; ?>">Transactions</a>
            <a href="ajouter.php" class="menu-item <?php echo ($page_active == 'ajouter') ? 'active' : ''; ?>">Nouvelle Facture</a>
            <a href="payer.php" class="menu-item <?php echo ($page_active == 'payer') ? 'active' : ''; ?>">Valider Paiements</a>
        </div>
    </div>

    <div class="main-content">
        <header class="content-header">
            <div>
                <h1><?php echo isset($titre_page) ? $titre_page : 'Tableau de bord'; ?></h1>
                <p class="subtitle"><?php echo isset($subtitle) ? $subtitle : 'Service Financier'; ?></p>
            </div>
        </header>
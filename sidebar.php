<?php

$page_actuelle = basename($_SERVER['PHP_SELF']);
?>

<aside class="barre-laterale">
    <div class="logo-conteneur">
        <img src="data/logo.png" alt="Logo Sorbonne Paris Nord" class="logo-universite">
        <p class="sous-titre">Service Postal</p>
    </div>

    <nav class="navigation">
        <a href="index.php" class="lien-nav <?php echo ($page_actuelle == 'index.php') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-home mr-2 icone"></i> Tableau de bord
        </a>

        <a href="scanner.php" class="lien-nav <?php echo ($page_actuelle == 'scanner.php') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-expand mr-2 icone"></i> Scanner un colis
        </a>

        <a href="nouvelEnvoie.php" class="lien-nav <?php echo ($page_actuelle == 'nouvelEnvoie.php') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-paper-plane mr-2 icone"></i> Nouvel envoi
        </a>

        <a href="suiviColis.php" class="lien-nav <?php echo ($page_actuelle == 'suiviColis.php') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-box mr-2 icone"></i> Suivi des colis
        </a>
    </nav>
</aside>
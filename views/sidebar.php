<?php
$action_actuelle = $_GET['action'] ?? 'accueil';
?>

<aside class="barre-laterale">
    <div class="logo-conteneur">
        <img src="data/logo.png" alt="Logo Sorbonne Paris Nord" class="logo-universite">
        <p class="sous-titre">Service Postal</p>
    </div>
    
    <nav class="navigation">
        
        <a href="index.php?action=accueil" 
           class="lien-nav <?php echo ($action_actuelle == 'accueil') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-home mr-2 icone"></i> Tableau de bord
        </a>
        
        <a href="index.php?action=nouveau" 
           class="lien-nav <?php echo ($action_actuelle == 'nouveau') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-paper-plane mr-2 icone"></i> Nouvel envoi
        </a>
        
        <a href="index.php?action=suivi" 
           class="lien-nav <?php echo ($action_actuelle == 'suivi') ? 'lien-actif' : ''; ?>">
            <i class="fa fa-box mr-2 icone"></i> Suivi des colis
        </a>

    </nav>
</aside>
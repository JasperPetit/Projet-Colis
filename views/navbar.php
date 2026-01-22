<aside class="barre-navigation" style="display: flex; flex-direction: column; height: 100vh;">
    <a href="index.php?action=accueil">
        <img src="public/logo.png" id="sorbonne-paris-nord" alt="Logo">
    </a>
    
    <ul style="flex-grow: 1;">
        <?php
            // 1. Récupération du rôle
            $role = $_SESSION['role'] ?? 'Visiteur'; 

            // --- DÉFINITION DES MENUS (Identique à avant) ---
            $pagesAdmin = [
                "Accueil"        => "accueil", 
                "Mes commandes"  => "pageMesCommandesAdmin", 
                "Colis"          => "afficherColis", 
                "Fournisseurs"   => "pageFournisseurAdmin", 
                "Mes Devis"      => "pageInfosDevis",
                "Administration" => "pageAdmin"
            ];

            $pagesPostal = [
                "Tableau de bord" => "pageTableauDeBord",
                "Nouvel envoi"    => "nouveau",
                "Suivi des colis" => "suivi",
            ];

            $pagesFinancier = [
                "Accueil" => "accueil",
                "Service" => "pageServiceFinancierDevis"
            ];

            $pagesDepartement = [
                "Accueil"         => "accueil",
                "Mes commandes"   => "afficherCommande",
                "Mes Devis"       => "PageInfosDevisDemandeur",
                "Fournisseurs"    => "afficherFournisseur",
                "Tableau de bord" => "pageTableauDeBord"
            ];

            // --- SÉLECTION DU MENU ---
            $pagesA_Afficher = [];
            switch ($role) {
                case 'ADMIN': $pagesA_Afficher = $pagesAdmin; break;
                case 'Service_Postal': $pagesA_Afficher = $pagesPostal; break;
                case 'Service_Financier': $pagesA_Afficher = $pagesFinancier; break;
                case 'Demandeur': $pagesA_Afficher = $pagesDepartement; break;
                default: $pagesA_Afficher = ["Connexion" => "login"]; break;
            }

            // --- AFFICHAGE DES LIENS ---
            foreach ($pagesA_Afficher as $nomPage => $action) {
                $isActive = (isset($_GET['action']) && $_GET['action'] === $action) ? 'style="background-color: rgba(255, 255, 255, 0.1); font-weight:bold;"' : '';
                
                echo "<li>";
                echo "<a href='index.php?action=$action' $isActive>$nomPage</a>";
                echo "</li>";
            }
        ?>
    </ul>

    <div style="padding: 20px; border-top: 1px solid rgba(255,255,255,0.1); background-color: rgba(0,0,0,0.1);">
        
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; color: rgba(255,255,255,0.6); font-size: 0.9rem;">
            <i class="fas fa-user-circle" style="font-size: 1.2rem;"></i>
            <div>
                <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Connecté en tant que</span>
                <strong style="color: white;"><?= htmlspecialchars($role) ?></strong>
            </div>
        </div>

        <a href="index.php?action=deconnexion" 
           style="display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none; color: #ffcccc; padding: 10px; border-radius: 8px; transition: all 0.3s; background-color: rgba(255, 0, 0, 0.05);"
           onmouseover="this.style.backgroundColor='rgba(220, 38, 38, 0.2)'; this.style.color='white';"
           onmouseout="this.style.backgroundColor='rgba(255, 0, 0, 0.05)'; this.style.color='#ffcccc';">
            
            <i class="fas fa-sign-out-alt"></i>
            <span>Se déconnecter</span>
        </a>
    </div>
</aside>
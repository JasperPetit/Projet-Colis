<aside class="barre-navigation">
    <img src="../public/logo.jpeg" id="sorbonne-paris-nord">
    <ul>
        <?php
            $pages = ["Accueil" => "pageAccueil.php", 
                "Mes commandes" => "pageMesCommandes.php", 
                "Colis" => "pageColis.php", 
                "Fournisseurs" => "pageFournisseurs.php", 
                "Administration" => "pageAdmin.php"];

            foreach ($pages as $page => $lien) {
                echo "<li>";
                echo "<a href='$lien'>$page</a>";
                echo "</li>";
            }
        ?>
    </ul>
</aside>
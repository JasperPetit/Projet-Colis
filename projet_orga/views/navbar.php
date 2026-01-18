<aside class="barre-navigation">
    <img src="public/logo.jpeg" id="sorbonne-paris-nord">
    <ul>
        <?php
            $pages = ["Accueil" => "accueil", 
                "Mes commandes" => "afficherCommande", 
                "Colis" => "afficherColis", 
                "Fournisseurs" => "afficherFournisseur", 
                "Mes Devis" => "pageInfosDevis",
                "Administration" => "pageAdmin"];

            foreach ($pages as $page => $lien) {
                echo "<li>";
                echo "<a href='$lien'>$page</a>";
                echo "</li>";
            }
        ?>
    </ul>
</aside>
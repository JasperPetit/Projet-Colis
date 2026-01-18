<?php
    $commande = new CommandeModel($db);
    $colisEnAttente = $commande->getCommandesByStatut($db, 'en_cours');
    $commandesEnCours = $commande->getCommandesNonConfirmees($db);
    $commandesEnRetard = $commande->getCommandesByStatut($db, 'retard');
    $dernierColis = $commande->getDernierColisLivre($db);

    $nbAttente = count($colisEnAttente);
    $nbEnCours = count($commandesEnCours);
    $nbRetard = count($commandesEnRetard);
?>
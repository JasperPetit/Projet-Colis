<?php
    $colisEnAttente = getCommandesByStatut($db, 'en_cours');
    $commandesEnCours = getCommandesNonConfirmees($db);
    $commandesEnRetard = getCommandesByStatut($db, 'retard');
    $dernierColis = getDernierColisLivre($db);

    $nbAttente = count($colisEnAttente);
    $nbEnCours = count($commandesEnCours);
    $nbRetard = count($commandesEnRetard);
?>
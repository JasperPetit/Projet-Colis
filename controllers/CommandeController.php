<?php
    $resListeCommandes = getListeCommandesCompletes($db);

    function getClasseCSSStatut($statut) {
        $s = strtolower($statut);
        if ($s == 'livré') return 'statut-livre';
        if ($s == 'en_cours') return 'statut-en-cours';
        if ($s == 'retard') return 'statut-retard';
        return '';
    }
?>
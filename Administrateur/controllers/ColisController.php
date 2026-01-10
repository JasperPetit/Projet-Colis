<?php
    $resListeColis = getListeColisComplete($db);
    $fournisseursFiltre = getFournisseursAyantColis($db);

    function getClasseStatutColis($statut) {
        switch (strtolower($statut)) {
            case 'livré': return 'statut-livre';
            case 'en_cours': return 'statut-en-cours';
            case 'retard': return 'statut-retard';
            default: return '';
        }
    }
?>
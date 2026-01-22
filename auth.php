<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action_actuelle = $_GET['action'] ;

if (!isset($_SESSION['utilisateur_id'])) {
    if ($action_actuelle !== 'login' && $action_actuelle !== 'connexion') {
        header('Location: index.php?action=login');
        exit();
    }
}

if(isset($_SESSION['utilisateur_id'])){
    $mon_role=$_SESSION['role'];

    $permissions=[
    'accueil' => ['ADMIN','Service_Postal','Service_Financier','Demandeur'],

    'login'            => ['ADMIN','Service_Postal','Service_Financier','Demandeur'], 
    'connexion'        => ['ADMIN','Service_Postal','Service_Financier','Demandeur'],
    'pageTableauDeBord' => ['Service_Postal', 'ADMIN'],
    
    'suivi'            => ['Service_Postal', 'ADMIN'],
    'nouveau'          => ['Service_Postal', 'ADMIN'],
    'imprimer'         => ['Service_Postal', 'ADMIN'],
    'valider_livraison' => ['Service_Postal', 'ADMIN'],
    'deconnexion'      => ['Service_Postal', 'ADMIN'],


 
    'pageServiceFinancierDevis' => ['Service_Financier','ADMIN'],
    'validerDevis'              => ['Service_Financier','ADMIN'],
    'refuserDevis'              => ['Service_Financier','ADMIN'],


    'afficherCommande'        => ['Demandeur','ADMIN'],
    'pageMesCommandesAdmin'   => ['ADMIN'],
    'afficherCommandeAdmin'   => ['ADMIN'],
    'pageMesCommandesPostale' => ['Service_Postal','ADMIN'],
    'SupprimerCommande'       => ['ADMIN'],
    'AjouterCommande'         => ['Service_Financer','ADMIN'],
    'ModifierCommande'        => ['ADMIN'],


    'ajouter_devis'           => ['Demandeur','ADMIN'],
    'formulaireDevis'         => ['Demandeur','ADMIN'],
    'pageInfosDevis'          => ['ADMIN'],
    'SupprimerDevis'          => ['ADMIN'],
    'ModifierDevis'           => ['ADMIN'],
    'PageInfosDevisDemandeur' => ['Demandeur','ADMIN'],


    'afficherColis' => ['ADMIN'],

    'afficherFournisseur'  => ['ADMIN','Service_Postal','Service_Financier','Demandeur'],
    'pageFournisseurAdmin' => ['ADMIN'],
    'ajouterFournisseur'   => ['ADMIN'],
    'ModifierFournisseur'  => ['ADMIN'],
    'SupprimerFournisseur' => ['ADMIN'],

    
    'pageAdmin'              => ['ADMIN'],
    'pageVoirUtilisateurs'   => ['ADMIN'],
    'pageAjouterUtilisateur' => ['ADMIN'],
    'SupprimerUtilisateur'   => ['ADMIN'],

    ];

    if (array_key_exists($action_actuelle, $permissions)) {
        
    if (!in_array($mon_role, $permissions[$action_actuelle])) {
            
        if ($mon_role === 'Service_Postal'){
            header('Location: index.php?action=pageTableauDeBord&error=acces_interdit');
        exit();
        } else {
        header('Location: index.php?action=accueil&error=acces_interdit');
        exit();
        }
        }
    }

    }



    


?>
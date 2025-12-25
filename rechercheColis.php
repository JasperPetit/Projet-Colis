<?php
require_once 'config.php'; 

// 1. Récupération
$texte_saisi = isset($_GET['champ_recherche']) ? $_GET['champ_recherche'] : null;
$commande_trouvee = null;

// 2. Traitement SQL
if ($texte_saisi !== null && !empty($texte_saisi) && $db instanceof SQLite3) {
    $requete = $db->prepare("SELECT * FROM Commande WHERE NumeroBonDeCommande = :id");
    $requete->bindValue(':id', $texte_saisi, SQLITE3_INTEGER);
    $resultat_brut = $requete->execute();
    $commande_trouvee = $resultat_brut->fetchArray(SQLITE3_ASSOC);
}
?>

<div class="zone-recherche">
    <form action="" method="GET">
        <input type="text" 
               name="champ_recherche" 
               placeholder="Rechercher un colis par numéro..." 
               value="<?php echo htmlspecialchars($texte_saisi ?? ''); ?>">
        
        <button type="submit" class="bouton-cache"></button>
    </form>
</div>

<?php if ($texte_saisi !== null): ?>
    
    <div class="resultat-flottant">

        <?php if ($commande_trouvee): ?>
            
            <div class="entete-resultat">
                <h4>Commande #<?php echo htmlspecialchars($commande_trouvee['NumeroBonDeCommande']); ?></h4>
                <a href="?" class="lien-fermer"><i class="fa-solid fa-xmark"></i></a>
            </div>

            <table class="tableau-details">
                <tr>
                    <td class="label-detail">Destination</td>
                    <td class="valeur-detail">
                        <?php echo htmlspecialchars($commande_trouvee['AdresseArivee']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="label-detail">Statut</td>
                    <td class="valeur-detail">
                        <?php 
                            $est_confirme = ($commande_trouvee['ConfirmerOuiOuNon'] == 1); 
                            $classe = $est_confirme ? 'badge-livre' : 'badge-attente';
                            $texte = $est_confirme ? 'Confirmé' : 'En attente';
                        ?>
                        <span class="badge <?php echo $classe; ?>"><?php echo $texte; ?></span>
                    </td>
                </tr>
            </table>

        <?php else: ?>
            
            <div style="position: relative;">
                <a href="?" class="lien-fermer" style="position: absolute; right: 0; top: -10px;"><i class="fa-solid fa-xmark"></i></a>
                <div class="message-erreur">
                    <i class="fa-solid fa-circle-exclamation"></i> Commande introuvable
                </div>
            </div>

        <?php endif; ?>

    </div>

<?php endif; ?>
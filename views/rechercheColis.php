<?php

$texte_saisi = $_GET['champ_recherche'] ?? null;
$commande_trouvee = null; 


if ($texte_saisi) {

    if (isset($this) && method_exists($this, 'rechercherRapide')) {
        $commande_trouvee = $this->rechercherRapide();
    }
}
?>

<div class="zone-recherche">
    <form action="index.php" method="GET">
        
        <input type="hidden" name="action" value="<?php echo htmlspecialchars($_GET['action'] ?? 'accueil'); ?>">

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
                <h4>Commande #<?php echo $commande_trouvee['NumeroBonDeCommande']; ?></h4>
                <a href="index.php?action=<?php echo $_GET['action'] ?? 'accueil'; ?>" class="lien-fermer">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>

            <table class="tableau-details">
                <tr>
                    <td class="label-detail">Destination</td>
                    <td class="valeur-detail">
                        <?php echo $commande_trouvee['AdresseArivee']; ?>
                    </td>
                </tr>

                <tr>
                    <td class="label-detail">Département</td>
                    <td class="valeur-detail">
                        <?php echo $commande_trouvee['nomDepartement']; ?>
                    </td>
                </tr>

                <tr>
                    <td class="label-detail">Statut</td>
                    <td class="valeur-detail">
                    <?php 
                        $statut = $commande_trouvee['statut'] ?? '';

                        if ($statut == 'livré') {
                            $classe_badge = 'badge-livre';
                            $texte_badge = 'Livré';
                        } elseif ($statut == 'retard') {
                            $classe_badge = 'badge-retard';
                            $texte_badge = 'En retard';
                        } else {
                            $classe_badge = 'badge-encours';
                            $texte_badge = 'En cours';
                        }
                    ?>

                    <span class="<?php echo $classe_badge; ?>">
                        <?php echo $texte_badge; ?>
                    </span>

                    </td>
                </tr>
            </table>

        <?php else: ?>
            
            <div style="position: relative;">
                <a href="index.php?action=<?php echo $_GET['action'] ?? 'accueil'; ?>" class="lien-fermer" style="position: absolute; right: 0; top: -10px;">
                    <i class="fa-solid fa-xmark"></i>
                </a>
                <div class="message-erreur ">
                    <i class="fa-solid fa-circle-exclamation"></i> 
                        Commande introuvable
                </div>
            </div>

        <?php endif; ?>

    </div>

<?php endif; ?>
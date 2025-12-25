<?php 
    require_once 'config.php'; 
    require_once 'services/ExpeditionService.php';




    $mois = [
        1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril', 
        5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août', 
        9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre'
    ];
    $date = date('d') . ' ' . $mois[date('n')] . ' ' . date('Y') . "\n";



    $service = new ExpeditionService($db);
    $dernieres_commandes = $service->recupererResumeDernieresCommandes();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Service Postal</title>
    <link rel="stylesheet" href="fichierCSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    
    <main class="contenu-principal">
        <header class="barre-haute">
            <?php include 'rechercheColis.php'; ?>




            <div class="profil-utilisateur" style="display: flex; align-items: center; gap: 15px;">
                <span style="font-weight: 600; color: #1e3a5f;"><?php echo htmlspecialchars($nom_complet); ?></span> 
                
                <a href="logout.php" class="bouton-profil" title="Se déconnecter">
                    <i class="fa-solid fa-power-off"></i>
                </a>
            </div>




        </header>

        <section style="padding: 30px 30px 0 30px;">
            <h1 style="margin:0;">Tableau de bord postal</h1>
            <p style="color: #64748b;">Vue d'ensemble des opérations du jour <?php echo $date; ?></p>
        </section>

        <section class="section-stats">
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Colis en attente</div>
                    <div class="chiffre" style="color: #f59e0b;">24</div>
                </div>
                <i class="fa-regular fa-clock" style="color: #f59e0b;"></i>
            </div>
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">En cours de livraison</div>
                    <div class="chiffre" style="color: #3b82f6;">17</div>
                </div>
                <i class="fa-solid fa-truck" style="color: #3b82f6;"></i>
            </div>
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Livrés aujourd'hui</div>
                    <div class="chiffre" style="color: #10b981;">43</div>
                </div>
                <i class="fa-regular fa-circle-check" style="color: #10b981;"></i>
            </div>
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Total cette semaine</div>
                    <div class="chiffre">156</div>
                </div>
                <i class="fa-solid fa-boxes-stacked" style="color: #94a3b8;"></i>
            </div>
        </section>

        <section class="zone-actions">
            <button class="bouton-action-bleu">
                <i class="fa fa-expand fa-2x" style="margin-right: 20px;"></i>
                <div>
                    <strong>Scanner un colis</strong><br>
                    <small>Scannez le code-barres d'un colis</small>
                </div>
            </button>
            <a href="nouvelEnvoie.php" class="bouton-action-orange" style="text-decoration: none;">
                <i class="fa fa-paper-plane fa-2x" style="margin-right: 20px;"> </i>
                <div>
                    <strong>Nouvel envoi</strong><br>
                    <small>Créer un nouveau bon d'expédition</small>
                </div>
            </a>
        </section>

        <section class="section-tableau">
            <div style="padding: 20px; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Activité récente</div>



        <table class="tableau-activite">
            <?php foreach ($dernieres_commandes as $commande) : ?>
            <?php 
                $est_confirme = ($commande['ConfirmerOuiOuNon'] == 1);
                $classe_badge = $est_confirme ? 'badge-livre' : 'badge-encours';
                $texte_badge = $est_confirme ? 'Confirmé' : 'En attente';
            ?>
            <tr>
                <td width="50"><i class="fa fa-box" style="color: #cbd5e1;"></i></td>
                <td>
                    <strong><?php echo htmlspecialchars($commande['NumeroBonDeCommande']); ?></strong><br>
                    <small><?php echo htmlspecialchars($commande['AdresseArivee']); ?></small>
                </td>
                <td style="text-align: right; color: #94a3b8;">
                    <?php echo htmlspecialchars($commande['nbColis']); ?> colis
                </td>
                <td style="text-align: right;">
                    <span class="badge <?php echo $classe_badge; ?>">
                        <?php echo $texte_badge; ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>


        </table>








        </section>



    </main>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Service Postal</title>
    <link rel="stylesheet" href="public/riyad.css">
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include __DIR__ . '/navbar.php'; ?>
    
    <main class="contenu-principal">
        <section style="padding: 30px 30px 0 30px;">
            <h1 style="margin:0;">Tableau de bord</h1>
            <p style="color: #64748b;">Vue d'ensemble des opérations du jour <?php echo $date; ?></p>
        </section>

        <section class="section-stats">
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Colis en retard</div>
                    <div class="chiffre" style="color: #f59e0b;"><?php echo $nbColisEnretard; ?></div>
                </div>
                <i class="fa-regular fa-clock" style="color: #f59e0b;"></i>
            </div>
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Colis en transit</div>
                    <div class="chiffre" style="color: #3b82f6;"><?php echo $nbColisEnTransit ?></div>
                </div>
                <i class="fa-solid fa-truck" style="color: #3b82f6;"></i>
            </div>
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Colis livrés</div>
                    <div class="chiffre" style="color: #10b981;"><?php echo $nbColisLivré; ?></div>
                </div>
                <i class="fa-regular fa-circle-check" style="color: #10b981;"></i>
            </div>
            <div class="carte-stat">
                <div>
                    <div style="color: #64748b;">Total</div>
                    <div class="chiffre"><?php echo $total ?></div>
                </div>
                <i class="fa-solid fa-boxes-stacked" style="color: #94a3b8;"></i>
            </div>
        </section>

        <section class="zone-actions">

            <a href="index.php?action=suivi" class="bouton-action-bleu" style="text-decoration: none;">
                <i class="fa fa-box mr-2 icone" style="margin-right: 20px;"></i>
                <div>
                    <strong>Suivi des colis</strong><br>
                    <small>Suivez tous les colis</small>
                </div>
            </a>

            <a href="index.php?action=nouveau" class="bouton-action-orange" style="text-decoration: none;">
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
                            $statut = trim($commande['statut'] ?? '');

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
                    <tr>
                        <td width="50"><i class="fa fa-box" style="color: #cbd5e1;"></i></td>
                        <td>
                            <strong><?php echo $commande['NumeroBonDeCommande']; ?></strong><br>
                            <small><?php echo $commande['AdresseDepartment']; ?></small>
                        </td>

                        <td>
                         <strong>Département à livrer</strong><br>
                         <small><?php echo $commande['nomDepartement'] ; ?></small>
                        </td>

                        <td style="text-align: right; color: #94a3b8;">
                            <?php echo $commande['nbColis']; ?> colis
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
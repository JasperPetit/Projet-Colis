<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réimpression Étiquette - Service Postal</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include __DIR__ . '/navbar.php'; ?>

    <main class="contenu-principal">
        <header class="barre-haute">
            <?php include 'rechercheColis.php'; ?>
            
            <div class="profil-utilisateur">
                <button class="bouton-profil">
                    <i class="fa-solid fa-user-tie icone"></i> <?php echo $nom_complet; ?>
                </button>
                <a href="index.php?action=deconnexion" class="bouton-logout">
                    <i class="fa fa-sign-out-alt"></i> Déconnexion
                </a>     
            </div>
        </header>

        <section style="padding: 30px 30px 0 30px;">
            <h1 style="margin:0; color: var(--bleu-fonce);">Réimpression d'étiquette</h1>
            <p style="color: #64748b; margin-top: 5px;">
                Retrouvez un colis existant pour réimprimer un bordereau endommagé.
            </p>
        </section>

        <div style="padding: 30px;">
            
            <div class="bloc-blanc">
                <h3 class="titre-bloc"><i class="fa-solid fa-search"></i> Rechercher le colis</h3>
                
                <form action="index.php" method="GET" class="form-recherche-wrapper">
                    
                    <input type="hidden" name="action" value="nouveau">
                    
                    <div class="groupe-input input-container">
                        <input type="text" name="recherche" value="<?php echo $recherche; ?>" placeholder="Ex: 169304, Lyon..." required>
                    </div>
                    
                    <button type="submit" class="btn-recherche-orange">
                        <i class="fa fa-search"></i> Rechercher
                    </button>
                    
                </form>
            </div>

            <?php if (!empty($resultats)): ?>
            <div class="bloc-blanc">
                <h3 class="titre-bloc">Résultats trouvés</h3>
                
                <table class="table-resultats">
                    <thead>
                        <tr>
                            <th>N° Bon</th>
                            <th>Destination</th>
                            <th>Date Création</th>
                            <th>Détails Colis</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultats as $res): ?>
                        <tr>
                            <td>
                                <strong>#<?php echo $res['NumeroBonDeCommande']; ?></strong>
                            </td>
                            <td>
                                <i class="fa fa-map-marker-alt" style="color: #ef4444; margin-right: 5px;"></i> 
                                <?php echo htmlspecialchars($res['AdresseArivee']); ?>
                            </td>
                            <td>
                                <i class="fa-regular fa-calendar" style="color: #94a3b8; margin-right: 5px;"></i>
                                <?php echo $res['Date_']; ?>
                            </td>
                            <td>
                                <span class="badge-poids"><?php echo $res['Poids']; ?> kg</span>
                                <span class="info-taille">(<?php echo $res['Taille']; ?> cm)</span>
                            </td>
                            <td style="text-align: right;">
                                <a href="index.php?action=imprimer&id=<?php echo $res['NumeroBonDeCommande']; ?>" 
                                   target="_blank" 
                                   class="btn-imprimer">
                                    <i class="fa fa-print"></i> Imprimer
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <?php elseif ($message != ""): ?>
                <div class="message-erreur">
                    <i class="fa fa-circle-exclamation"></i> 
                    <span><?php echo $message; ?></span>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>
</html>
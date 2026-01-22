<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi des colis - Service Postal</title>
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
            <h1 style="margin:0;">Suivi des colis</h1>
            <p style="color: #64748b;">Liste complète des colis en cours de traitement</p>
        </section>

        <section class="section-filtres">
            <div class="barre-filtres">
                <span class="filtre-item actif">Tous    
                    <span class="badge-count"><?php echo $nombre_total_colis; ?></span>
                </span> 
            </div>
        </section>

        <section class="section-tableau">
            <table class="tableau-suivi">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Client</th>
                        <th>Destination</th>
                        <th>Département</th>
                        <th>Date</th>
                        <th>Poids</th>
                        <th>Colis</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                  
                <tbody>
                    <?php foreach ($liste_commandes as $colis): ?>
                        <?php 
                            $prenom = $colis['Prenom'];
                            $nom = $colis['nom'];
                            $statut = $colis['statut'];
                            $poids = $colis['Poids'];

                            if ($statut == 'livré' ) {
                                $classe_badge = 'badge-livre';
                                $statut_texte="Livré";
                            } elseif ($statut == 'retard') {
                                $classe_badge = 'badge-retard';
                                $statut_texte="En retard";
                            } else {
                                $classe_badge = 'badge-encours';
                                $statut_texte="En cours";
                            }
                        ?>
                        <tr>
                            <td>
                                <i class="fa fa-box icone-table" style="color: #cbd5e1;"></i> 
                                <strong><?php echo $colis['NumeroBonDeCommande']; ?></strong>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #1e293b;"><?php echo $prenom . ' ' . $nom; ?></span>
                            </td>
                            <td>
                                <i class="fa fa-location-dot"></i> 
                                <?php echo $colis['AdresseArivee']; ?>
                            </td>

                            <td>
                                <?php echo $colis['nomDepartement']; ?>
                            </td>
                            <td><?php echo $colis['Date_']; ?></td>
                            <td><?php echo $poids; ?> kg</td>
                            <td style="text-align: center;"><?php echo $colis['nbColis']; ?></td>
                            <td>
                                <span class="badge <?php echo $classe_badge; ?>">
                                    <?php echo $statut_texte; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                
            </table>
        </section>
    </main>

</body>
</html>
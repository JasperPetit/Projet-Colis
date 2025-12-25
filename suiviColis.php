<?php 
    require_once 'config.php'; 
    require_once 'services/ExpeditionService.php';


    $service_postal = new ExpeditionService($db);

    $nombre_total_colis = $service_postal->recupNbDeColis();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suivi des colis - Service Postal</title>
    <link rel="stylesheet" href="fichierCSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <main class="contenu-principal">
        <header class="barre-haute">
            <?php include 'rechercheColis.php'; ?>

            <div class="profil-utilisateur">
                <button class="bouton-profil">
                    <i class="fa-solid fa-user-tie icone"></i> <?php echo $nom_complet; ?>
                </button>     
            </div>
        </header>

        <section style="padding: 30px 30px 0 30px;">
            <h1 style="margin:0;">Suivi des colis</h1>
            <p style="color: #64748b;">Liste complète des colis en cours de traitement</p>
        </section>

        <section class="section-filtres">
            <div class="barre-filtres">
                <button class="filtre-item actif">Tous <span class="badge-count"><?php echo $nombre_total_colis; ?></span></button> 

            </div>
        </section>

        <section class="section-tableau">
            <table class="tableau-suivi">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Destinataire</th>
                        <th>Destination</th>
                        <th>Type</th>
                        <th>Poids</th>
                        <th>nombre de colis</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa fa-box icone-table"></i> CP2024-11-001</td>
                        <td>Jean Martin</td>
                        <td><i class="fa fa-location-dot"></i> Paris 13e</td>
                        <td>Standard</td>
                        <td>1.2 kg</td>
                        <td>1</td>
                        <td><span class="badge badge-livre">Livré</span></td>
                        <td><a href="#" class="lien-details">Détails</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-box icone-table"></i> CP2024-11-002</td>
                        <td>Sophie Laurent</td>
                        <td><i class="fa fa-location-dot"></i> Villetaneuse</td>
                        <td>Express</td>
                        <td>3.5 kg</td>
                        <td>2</td>
                        <td><span class="badge badge-encours">En cours</span></td>
                        <td><a href="#" class="lien-details">Détails</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-box icone-table"></i> CP2024-11-003</td>
                        <td>Pierre Dubois</td>
                        <td><i class="fa fa-location-dot"></i> Saint-Denis</td>
                        <td>Standard</td>
                        <td>0.8 kg</td>
                        <td>1</td>
                        <td><span class="badge badge-livre">Livré</span></td>
                        <td><a href="#" class="lien-details">Détails</a></td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-box icone-table"></i> CP2024-11-004</td>
                        <td>Marie Chen</td>
                        <td><i class="fa fa-location-dot"></i> Bobigny</td>
                        <td>Standard</td>
                        <td>2.1 kg</td>
                        <td>3</td>
                        <td><span class="badge badge-encours">En cours</span></td>
                        <td><a href="#" class="lien-details">Détails</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>
<?php
$nom_utilisateur = $_SESSION['nom_complet'] ?? 'Utilisateur';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis - Accueil</title>

    <link rel="stylesheet" href="public/AccueilFinance.css">
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

<?php include 'navbar.php'; ?>

<div class="main-container">

    <div class="content-area">
        <h1 class="page-title">Suivi Colis</h1>
        <p class="page-subtitle">IUT de Villetaneuse</p>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-label">Colis en attente</div>
                        <div class="stat-value"><?= htmlspecialchars($nbColisEnAttente ?? 0) ?></div>
                    </div>
                    <div class="stat-icon-wrapper blue">
                        <i class="fas fa-box"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-label">Commandes en cours</div>
                        <div class="stat-value"><?= htmlspecialchars($nbCommandesEnCours ?? 0) ?></div>
                    </div>
                    <div class="stat-icon-wrapper purple">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-content">
                        <div class="stat-label">Total reçus / payés</div>
                        <div class="stat-value"><?= htmlspecialchars($totalRecusPayes ?? 0) ?></div>
                    </div>
                    <div class="stat-icon-wrapper gold">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                </div>
            </div>

            <div class="bottom-section">
                <div class="card-box">
                    <h2 class="card-title">Activité récente</h2>
                    <ul class="activity-list">
                        <?php if (!empty($activiteRecente)): ?>
                            <?php 
                            function calculerTempsEcoule($date) {
                                if (empty($date)) return 'Récemment';
                                
                                $dateObj = new DateTime($date);
                                $maintenant = new DateTime();
                                $diff = $maintenant->diff($dateObj);
                                
                                if ($diff->days > 7) {
                                    return 'Il y a ' . $diff->days . ' jours';
                                } elseif ($diff->days > 0) {
                                    return $diff->days == 1 ? 'Hier' : 'Il y a ' . $diff->days . ' jours';
                                } elseif ($diff->h > 0) {
                                    return 'Il y a ' . $diff->h . ' heure' . ($diff->h > 1 ? 's' : '');
                                } elseif ($diff->i > 0) {
                                    return 'Il y a ' . $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
                                } else {
                                    return 'À l\'instant';
                                }
                            }
                            
                            foreach ($activiteRecente as $activite): 
                                $statut = strtolower(trim($activite['statut'] ?? ''));
                                $dotClass = 'attente';
                                $statusText = 'En attente';
                                
                                if ($statut == 'livré' || $statut == 'livre') { 
                                    $dotClass = 'livre'; 
                                    $statusText = 'Livré'; 
                                } elseif ($statut == 'en_cours') { 
                                    $dotClass = 'transit'; 
                                    $statusText = 'En transit'; 
                                }
                                
                                $dateActivite = $activite['Date_'] ?? null;
                                $timeAgo = calculerTempsEcoule($dateActivite);
                                
                                // Déterminer l'adresse d'arrivée ou un texte par défaut
                                $adresseArrivee = !empty($activite['AdresseArivee']) 
                                    ? htmlspecialchars($activite['AdresseArivee']) 
                                    : 'Réception';
                            ?>
                                <li class="activity-item">
                                    <div class="dot <?= $dotClass ?>"></div>
                                    <div class="activity-details">
                                        <span class="status-text"><?= htmlspecialchars($statusText) ?></span>
                                        <span class="info-text">
                                            Colis #<?= htmlspecialchars($activite['NumeroBonDeCommande'] ?? 'N/A') ?> - 
                                            <?= $adresseArrivee ?>
                                        </span>
                                        <span class="time-text"><?= $timeAgo ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="activity-item">
                                <span class="info-text">Aucune activité récente</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="card-box actions-card">
                    <h2 class="card-title">Actions rapides</h2>
                    <p style="color:#64748b; margin-bottom: 20px;">Créer une nouvelle demande de matériel ou de service.</p>
                    
                    <a href="index.php?action=formulaireDevis" class="btn-creer-commande">
                        Créer une commande
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvel Envoi - Service Postal</title>
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
            <h1 style="margin:0;">Nouvel envoi</h1>
            <p style="color: #64748b;">Créer un nouveau bon d'expédition postal si l'ancien est endommagé</p>
        </section>

        <div class="grille-nouvel-envoi">
            
            <div class="colonne-formulaire">
                <div class="bloc-blanc">
                    <h3 class="titre-bloc"><i class="fa-solid fa-user"></i> Informations destinataire</h3>
                    <div class="ligne-form">
                        <div class="groupe-input">
                            <label>Nom complet *</label>
                            <input type="text" placeholder="Jean Dupont">
                        </div>
                        <div class="groupe-input">
                            <label>Téléphone *</label>
                            <input type="text" placeholder="06 12 34 56 78">
                        </div>
                    </div>
                    <div class="groupe-input" style="margin-top:15px;">


                    <div class="groupe-input" style="margin-top:15px; position: relative;">
                        <label>Adresse *</label>
                        <input type="text" id="input-adresse" placeholder="99 Avenue Jean-Baptiste Clément" autocomplete="off">
                        <ul id="liste-adresses"></ul>
                    </div>

                    <div class="ligne-form" style="margin-top:15px;">
                        <div class="groupe-input">
                            <label>Ville *</label>
                            <input type="text" id="ville-destinataire" placeholder="93430">
                        </div>
                        <div class="groupe-input">
                            <label>Code postal *</label>
                            <input type="text" id="cp-destinataire" placeholder="93430">
                        </div>
                    </div>
                </div>

                <div class="bloc-blanc">
                    <h3 class="titre-bloc"><i class="fa-solid fa-box"></i> Détails du colis</h3>
                    <div class="ligne-form">
                        <div class="groupe-input">
                            <label>Type d'envoi *</label>
                            <select id="select-type" class="input-style">
                                <option>Standard (3-5 jours)</option>
                                <option>Express (24h)</option>
                            </select>
                        </div>
                        <div class="groupe-input">
                            <label>Poids (kg) *</label>
                            <input id="input-poids" type="number" step="0.1" value="2.5">
                        </div>
                    </div>
                    <div class="ligne-form" style="margin-top:15px;">
                        <div class="groupe-input">
                            <label>Longueur (cm)</label>
                            <input type="number" value="30">
                        </div>
                        <div class="groupe-input">
                            <label>Largeur (cm)</label>
                            <input type="number" value="20">
                        </div>
                    </div>
                </div>
            </div>

            <aside class="colonne-recapitulatif">
                <div class="bloc-blanc">
                    <h3 class="titre-bloc">Récapitulatif</h3>
                    <div class="ligne-recap"><span>Type d'envoi</span><strong id="recap-type">Standard</strong></div>
                    <div class="ligne-recap"><span>Poids</span><strong id="recap-poids">2.5 kg</strong></div>
                    <div class="ligne-recap"><span>Assurance</span><strong>Non</strong></div>
                    
                    <div class="affichage-prix-total bouton-calcul">
                        Prix estimé : <span id="prix-affiche">10.00</span> €
                    </div>
                    <input type="hidden" id="valeur-prix-cache" name="prix_final" value="10.00">
                    <button class="bouton-valider">Créer l'expédition</button>
                    <button class="bouton-imprimer"><i class="fa fa-print"></i> Imprimer l'étiquette</button>
                </div>
            </aside>

        </div>
    </main>
    <script src="/fichierJS/nouvelEnvoi.js"></script>
</body>
</html>


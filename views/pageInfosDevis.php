<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Devis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>

        <div class="titre">
            <h1>Liste des Devis </h1>
            <a href="formulaireDevis" class="btn-nouvelle-commande">
                <i class="fas fa-plus"></i> Ajouter un devis
            </a>
        </div>

        <div class="filtres-container">
            <input type="text" id="searchBar" onkeyup="filtrerDevis()" placeholder="Rechercher (Nom, N°, Fournisseur)...">

            <div class="filtre-group">
                <label for="filtreDate">Trier par date</label>
                <select id="filtreDate" onchange="filtrerDevis()">
                    <option value="recente" selected>Plus récente</option>
                    <option value="ancienne">Plus ancienne</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="filtreStatut">Statut</label>
                <select id="filtreStatut" onchange="filtrerDevis()">
                    <option value="">Tous les statuts</option>
                    <option value="attente">En attente</option>
                    <option value="accepte">Accepté</option>
                    <option value="refuse">Rejeté</option>
                </select>
            </div>

            <button class="btn-reinitialiser" onclick="reinitialiserFiltres()">
                <i class="fas fa-redo"></i> Réinitialiser
            </button>
        </div>

        <span class="compteur-resultats" id="compteurResultats"></span>

        <div id="listeDevis"> 
            <?php foreach ($listeDevis as $devi) { 
                // --- PRÉPARATION DES DONNÉES POUR LE JS (Invisible) ---
                
                // Calcul du statut pour le tri
                $statutJS = 'attente';
                if ($devi['SignatureOuiOuNon'] === 1 || $devi['SignatureOuiOuNon'] === '1') {
                    $statutJS = 'accepte';
                } elseif ($devi['SignatureOuiOuNon'] === 0 || $devi['SignatureOuiOuNon'] === '0') {
                    $statutJS = 'refuse';
                }

                // Date pour le tri
                $dateJS = $devi['Date_'] ?? '';

                // Texte complet pour la recherche (concaténation de tout ce qu'on voit)
                $texteRecherche = strtolower(
                    ($devi['name'] ?? '') . ' ' . 
                    ($devi['idDevis'] ?? '') . ' ' . 
                    ($devi['nomEntreprise'] ?? '') . ' ' . 
                    ($devi['nom'] ?? '') . ' ' . 
                    ($devi['Prenom'] ?? '')
                );
            ?>
                <div class="commande-card" 
                     style="flex-wrap: wrap;"
                     data-search="<?= htmlspecialchars($texteRecherche) ?>"
                     data-date="<?= htmlspecialchars($dateJS) ?>"
                     data-statut="<?= htmlspecialchars($statutJS) ?>">
                    
                    <div class="commande-info">
                        <h3><?= htmlspecialchars($devi['name'] ?? 'Devi n°'.$devi['idDevis'])?></h3>
                        <p>📄n°<?= !empty($devi['idDevis']) ? htmlspecialchars($devi['idDevis']) : 'numero de devis non trouvé' ?></p>

                        <p>
                            🏢 Fournisseur : <?= !empty($devi['nomEntreprise']) ? htmlspecialchars($devi['nomEntreprise']) : 'Fournisseur inconnu' ?>
                        </p>
                        <p>
                            👤 Commandeur :  <?= !empty($devi['nom']) ? htmlspecialchars($devi['nom'] .' '. $devi['Prenom']) : 'Demandeur inconnu' ?>
                        </p>
                        <p>
                            📍Departement : <?= !empty($devi['nomDepartement']) ? htmlspecialchars($devi['nomDepartement']) : 'Departement inconnu' ?>
                        </p>
                        <p>📅 Ajout : <?= !empty($devi['Date_']) ? htmlspecialchars($devi['Date_']) : 'inconnu' ?></p>
                    </div>
                    
                    <div class="commande-actions">
                        <?php
                            // Gestion visuelle du statut (inchangé par rapport à ton code)
                            $statut = $devi["SignatureOuiOuNon"];
                            $affichage = '';
                            $classeStatut = '';
                            
                            if(is_null($statut)){
                                $affichage = "En attente";
                                $classeStatut = "statut-non-signe"; 
                            }
                            elseif($statut == 1){
                                $affichage = "Accepté";
                                $classeStatut = "statut-accepte";
                            }
                            elseif($statut == 0){
                                $affichage = "Rejeté";
                                $classeStatut = "statut-refuse";
                            }
                        ?>

                        <span class="statue-devis <?= $classeStatut ?>">
                            <?= htmlspecialchars($affichage) ?>
                        </span>
                        
                        <a href="ModifierDevis?modifier=<?= $devi['idDevis']?>" class="commande-détails">Modifier le devis</a>
                        
                        <?php if (!empty($devi['imageDevis'])): ?>
                            <a href="uploads/<?= htmlspecialchars($devi['imageDevis']) ?>" target="_blank" class="commande-détails">Voir le fichier</a>
                        <?php endif; ?>
                        
                        <a href="javascript:void(0);" onclick="toggleDetails(<?= $devi['idDevis'] ?>)" class="commande-détails">Voir détails</a>
                        
                        <form method="POST" action="SupprimerDevis" style="display: inline; margin: 0; padding: 0; border: none; background: none;" onsubmit="return confirmerSuppressionCommande('<?= htmlspecialchars($devi['idDevis']) ?>')">
                            <input type="hidden" name="idDevis" value="<?= $devi['idDevis'] ?>">    
                            <button type="submit" name="supprimer_devis" class="bouton-supprimer">
                                Supprimer
                            </button>
                        </form>
                    </div>

                    <div id="details-<?= $devi['idDevis'] ?>" style="display: none; width: 100%; margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; color: #555;">
                        <strong>Détails :</strong><br>
                        <?= nl2br(htmlspecialchars($devi['details'] ?? 'Aucun détail.')) ?>
                    </div>
                </div>
            <?php } ?>
        </div> 
    </main>

    <script src="script.js"></script>
    <script>
        function confirmerSuppressionCommande(idDevis) {
            return confirm("Êtes-vous sûr de vouloir supprimer le devis '" + idDevis + "' ?\n\nCette action est irréversible.");
        }

        function toggleDetails(id) {
            var div = document.getElementById('details-' + id);
            div.style.display = (div.style.display === "none") ? "block" : "none";
        }

        // --- NOUVELLE FONCTION DE FILTRAGE ---
        function filtrerDevis() {
            // 1. Récupération des inputs
            const inputRecherche = document.getElementById("searchBar");
            const filtreRecherche = inputRecherche.value.toLowerCase();
            
            const filtreDate = document.getElementById("filtreDate").value;
            const filtreStatut = document.getElementById("filtreStatut").value;
            
            // 2. Sélection des cartes
            const container = document.getElementById("listeDevis");
            const cards = Array.from(container.getElementsByClassName("commande-card"));
            
            // 3. Filtrage
            const cardsVisibles = cards.filter(function(card) {
                // Recherche
                const searchData = card.getAttribute("data-search");
                const matchRecherche = searchData.includes(filtreRecherche);
                
                // Statut
                const statutData = card.getAttribute("data-statut");
                const matchStatut = !filtreStatut || statutData === filtreStatut;
                
                return matchRecherche && matchStatut;
            });
            
            // 4. Tri par date
            cardsVisibles.sort(function(a, b) {
                const dateA = new Date(a.getAttribute("data-date"));
                const dateB = new Date(b.getAttribute("data-date"));
                
                if (filtreDate === "recente") {
                    return dateB - dateA;
                } else {
                    return dateA - dateB;
                }
            });
            
            // 5. Affichage
            cards.forEach(card => card.style.display = "none");
            cardsVisibles.forEach(card => {
                card.style.display = "";
                container.appendChild(card);
            });
            
            // 6. Compteur
            const compteur = document.getElementById("compteurResultats");
            if(compteur) {
                compteur.textContent = cardsVisibles.length + " devis trouvé(s)";
            }
        }
        
        function reinitialiserFiltres() {
            document.getElementById("searchBar").value = "";
            document.getElementById("filtreDate").value = "recente";
            document.getElementById("filtreStatut").value = "";
            filtrerDevis();
        }
        
        // Lancer au chargement
        window.onload = filtrerDevis;
    </script>
</body>
</html>
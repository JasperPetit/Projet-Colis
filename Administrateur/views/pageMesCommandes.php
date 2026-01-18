<?php 
    require_once "../Administrateur/config/DBconnect.php"; 
    require_once "../Administrateur/models/CommandeModel.php"; 
    require_once "../Administrateur/controllers/CommandeController.php"; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - Suivi Colis</title>
    <link rel="stylesheet" href="../Administrateur/public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <div class="titre">
            <h1>Mes Commandes</h1>
            <a href="index.php?action=formulaireCommande" class="btn-nouvelle-commande">
                <i class="fas fa-plus"></i> Nouvelle commande
            </a>
        </div>

        <div class="filtres-container">
            <input type="text" id="searchBar" onkeyup="filtrerCommandes()" placeholder="Rechercher une commande...">

            <div class="filtre-group">
                <label for="filtreDate">Trier par date</label>
                <select id="filtreDate" onchange="filtrerCommandes()">
                    <option value="recente" selected>Plus récente</option>
                    <option value="ancienne">Plus ancienne</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="filtreStatut">Statut</label>
                <select id="filtreStatut" onchange="filtrerCommandes()">
                    <option value="">Tous les statuts</option>
                    <option value="en_cours">En cours</option>
                    <option value="livré">Livré</option>
                    <option value="retard">Retard</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="filtreConfirmation">Confirmation</label>
                <select id="filtreConfirmation" onchange="filtrerCommandes()">
                    <option value="">Toutes</option>
                    <option value="1">Confirmées</option>
                    <option value="0">Non confirmées</option>
                </select>
            </div>

            <button class="btn-reinitialiser" onclick="reinitialiserFiltres()">
                <i class="fas fa-redo"></i> Réinitialiser
            </button>
        </div>

        <span class="compteur-resultats" id="compteurResultats"></span>

        <div id="listeCommandes">
            <?php foreach ($resListeCommandes as $commande): ?>
                <div class="commande-card" 
                     data-date="<?= htmlspecialchars($commande['Date_']) ?>" 
                     data-statut="<?= htmlspecialchars($commande['statut']) ?>"
                     data-confirmation="<?= $commande['ConfirmerOuiOuNon'] ? '1' : '0' ?>">
                    
                    <div class="commande-info">
                        <h3>Commande n°<?= htmlspecialchars($commande['NumeroBonDeCommande']) ?></h3>
                        <p>📅 Date : <?= date("d/m/Y", strtotime($commande['Date_'])) ?></p>
                        <p>
                            <i class="fas fa-box"></i> <?= $commande['nbColis'] ?> colis | 
                            <i class="fas fa-truck"></i> <?= !empty($commande['nomEntreprise']) ? htmlspecialchars($commande['nomEntreprise']) : 'Fournisseur inconnu' ?>
                        </p>
                        <p><?= $commande['ConfirmerOuiOuNon'] ? '✅ Confirmée' : '⏳ En attente de confirmation' ?></p>
                    </div>
                    
                    <div class="commande-actions">
                        <span class="statue-colis <?= getClasseCSSStatut($commande['statut']) ?>">
                            <?= htmlspecialchars($commande['statut']) ?>
                        </span>
                        <p>Prévu : <?= !empty($commande['DateAriveePrevu']) ? htmlspecialchars($commande['DateAriveePrevu']) : '--/--/----' ?></p>
                        <a href="#" class="commande-détails">Voir détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    </main>

    <script>
        function filtrerCommandes() {
            const inputRecherche = document.getElementById("searchBar");
            const filtreRecherche = inputRecherche.value.toUpperCase();
            
            const filtreDate = document.getElementById("filtreDate").value;
            const filtreStatut = document.getElementById("filtreStatut").value;
            const filtreConfirmation = document.getElementById("filtreConfirmation").value;
            
            const container = document.getElementById("listeCommandes");
            const cards = Array.from(container.getElementsByClassName("commande-card"));
            
            // Étape 1 : Filtrage
            const cardsVisibles = cards.filter(function(card) {
                const h3 = card.getElementsByTagName("h3")[0];
                const txtValue = h3.textContent || h3.innerText;
                const matchRecherche = txtValue.toUpperCase().indexOf(filtreRecherche) > -1;
                
                const statut = card.getAttribute("data-statut");
                const matchStatut = !filtreStatut || statut === filtreStatut;
                
                const confirmation = card.getAttribute("data-confirmation");
                const matchConfirmation = !filtreConfirmation || confirmation === filtreConfirmation;
                
                return matchRecherche && matchStatut && matchConfirmation;
            });
            
            // Étape 2 : Tri par date
            cardsVisibles.sort(function(a, b) {
                const dateA = new Date(a.getAttribute("data-date"));
                const dateB = new Date(b.getAttribute("data-date"));
                return (filtreDate === "recente") ? (dateB - dateA) : (dateA - dateB);
            });
            
            // Étape 3 : Mise à jour de l'affichage
            cards.forEach(card => card.style.display = "none");
            cardsVisibles.forEach(card => {
                card.style.display = "";
                container.appendChild(card); // Réinsère dans le bon ordre de tri
            });
            
            // Étape 4 : Compteur
            document.getElementById("compteurResultats").textContent = cardsVisibles.length + " commande(s) trouvée(s)";
        }
        
        function reinitialiserFiltres() {
            document.getElementById("searchBar").value = "";
            document.getElementById("filtreDate").value = "recente";
            document.getElementById("filtreStatut").value = "";
            document.getElementById("filtreConfirmation").value = "";
            filtrerCommandes();
        }
        
        // Initialisation automatique au chargement
        window.onload = filtrerCommandes;
    </script>
</body>
</html>
<?php 
    require_once "../config/DBconnect.php"; 
    require_once "../models/ColisModel.php"; 
    require_once "../controllers/ColisController.php"; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de colis - Suivi Colis</title>
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <div class="titre">
            <h1>Gestion de colis</h1>
        </div>

        <div class="filtres-container">
            <input type="text" id="searchBar" onkeyup="filtrerColis()" placeholder="Rechercher un colis">

            <div class="filtre-group">
                <label for="filtreDate">Trier par date</label>
                <select id="filtreDate" onchange="filtrerColis()">
                    <option value="recente" selected>Plus récente</option>
                    <option value="ancienne">Plus ancienne</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="filtreStatut">Statut</label>
                <select id="filtreStatut" onchange="filtrerColis()">
                    <option value="">Tous les statuts</option>
                    <option value="en_cours">En cours</option>
                    <option value="livré">Livré</option>
                    <option value="retard">Retard</option>
                </select>
            </div>

            <div class="filtre-group">
                <label for="filtreFournisseur">Fournisseur</label>
                <select id="filtreFournisseur" onchange="filtrerColis()">
                    <option value="">Tous les fournisseurs</option>
                    <?php foreach ($fournisseursFiltre as $f): ?>
                        <option value="<?= htmlspecialchars($f['nomEntreprise']) ?>">
                            <?= htmlspecialchars($f['nomEntreprise']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="btn-reinitialiser" onclick="reinitialiserFiltres()">
                <i class="fas fa-redo"></i> Réinitialiser
            </button>
        </div>

        <div class="compteur-resultats" id="compteurResultats"></div>

        <div id="listeCommandes">
            <?php foreach ($resListeColis as $colis): ?>
                <div class="colis-section" 
                     data-date="<?= htmlspecialchars($colis['DateCommande']) ?>" 
                     data-statut="<?= htmlspecialchars($colis['statut']) ?>"
                     data-fournisseur="<?= htmlspecialchars($colis['nomEntreprise'] ?? '') ?>">
                    
                    <div class="colis-info">
                        <h3>Colis n°<?= htmlspecialchars($colis['idColis']) ?></h3>
                        <p>📅 de livraison : <?= htmlspecialchars($colis['DateCommande']) ?></p>
                        <p>👤 Fournisseur : <?= htmlspecialchars($colis['nomEntreprise'] ?? 'Fournisseur inconnu') ?></p>
                    </div>
                    
                    <div class="commande-actions">
                        <span class="statue-colis <?= getClasseStatutColis($colis['statut']) ?>">
                            <?= htmlspecialchars($colis['statut']) ?>
                        </span>
                        <p>📅 Arrivée prévue : <?= htmlspecialchars($colis['DateAriveePrevu']) ?></p>

                        <a href="pageModifierCommande.php?modifier=<?= $commande['NumeroBonDeCommande'] ?>" class="commande-détails">
                            Modifier
                        </a>      
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

    <script>
        function filtrerColis() {
            const filtreRecherche = document.getElementById("searchBar").value.toUpperCase();
            const filtreDate = document.getElementById("filtreDate").value;
            const filtreStatut = document.getElementById("filtreStatut").value;
            const filtreFournisseur = document.getElementById("filtreFournisseur").value;
            
            const container = document.getElementById("listeCommandes");
            const cards = Array.from(container.getElementsByClassName("colis-section"));
            
            const cardsVisibles = cards.filter(card => {
                const txtValue = card.getElementsByTagName("h3")[0].textContent || card.getElementsByTagName("h3")[0].innerText;
                const matchRecherche = txtValue.toUpperCase().indexOf(filtreRecherche) > -1;
                const matchStatut = !filtreStatut || card.getAttribute("data-statut") === filtreStatut;
                const matchFournisseur = !filtreFournisseur || card.getAttribute("data-fournisseur") === filtreFournisseur;
                
                return matchRecherche && matchStatut && matchFournisseur;
            });
            
            if (filtreDate === "recente" || filtreDate === "ancienne") {
                cardsVisibles.sort((a, b) => {
                    const dateA = new Date(a.getAttribute("data-date"));
                    const dateB = new Date(b.getAttribute("data-date"));
                    return filtreDate === "recente" ? dateB - dateA : dateA - dateB;
                });
            }
            
            cards.forEach(card => card.style.display = "none");
            cardsVisibles.forEach(card => {
                card.style.display = "";
                container.appendChild(card);
            });
            
            document.getElementById("compteurResultats").textContent = cardsVisibles.length + " colis trouvé(s)";
        }
        
        function reinitialiserFiltres() {
            document.getElementById("searchBar").value = "";
            document.getElementById("filtreDate").value = "recente";
            document.getElementById("filtreStatut").value = "";
            document.getElementById("filtreFournisseur").value = "";
            filtrerColis();
        }
        
        window.onload = filtrerColis;
    </script>
</body>
</html>
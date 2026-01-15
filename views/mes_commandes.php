<div class="titre">
    <h1>Mes Commandes</h1>
    <a href="index.php?page=ajouter_commande" class="btn-nouvelle-commande">
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
            <option value="">Tous</option>
            <option value="en_cours">En cours</option>
            <option value="livré">Livré</option>
            <option value="retard">Retard</option>
        </select>
    </div>

    <button onclick="reinitialiserFiltres()" class="btn-reinitialiser">
        <i class="fas fa-undo"></i> Réinitialiser
    </button>
</div>

<p id="compteurResultats" style="margin-left: 20px; color: #666; font-size: 0.9em;"></p>

<div id="listeCommandes">
    <?php foreach ($resListeCommandes as $commande) { ?>
        <div class="commande-card" 
             data-statut="<?= htmlspecialchars($commande['statut']) ?>" 
             data-date="<?= $commande['Date_'] ?>" 
             data-confirmation="<?= $commande['ConfirmerOuiOuNon'] ?>">
            
            <div class="commande-info">
                <h3>Commande n°<?= htmlspecialchars($commande['NumeroBonDeCommande']) ?></h3>
                <p>📅 de livraison : <?= htmlspecialchars($commande['Date_']) ?></p>
                <p>
                    📦 <?= htmlspecialchars($commande['nbColis']) ?> colis - 
                    👤 <?= !empty($commande['nomEntreprise']) ? htmlspecialchars($commande['nomEntreprise']) : 'Fournisseur inconnu' ?>
                </p>
            </div>
            
            <div class="commande-actions">
                <span class="statue-colis <?= getClasseCSSStatut($commande['statut']) ?>">
                    <?= htmlspecialchars($commande['statut']) ?>
                </span>

                <p>📅 d'arrivée prévue : <?= htmlspecialchars($commande['DateAriveePrevu'] ?? 'Non définie') ?></p>

                <a href="#" class="commande-détails">Voir détails</a>
            </div>
        </div>
    <?php } ?>
</div>
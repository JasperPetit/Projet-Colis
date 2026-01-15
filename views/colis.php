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
            <option value="">Tous</option>
            <option value="en_cours">En cours</option>
            <option value="livré">Livré</option>
            <option value="retard">Retard</option>
        </select>
    </div>

    <button onclick="reinitialiserFiltres()" class="btn-reinitialiser">Réinitialiser</button>
</div>

<p id="compteurResultats" style="margin-left: 20px; color: #666; font-size: 0.9em;"></p>

<div id="listeCommandes">
    <?php foreach ($resListeColis as $colis) { ?>
        <div class="colis-section" 
             data-statut="<?= htmlspecialchars($colis['statut'] ?? '') ?>" 
             data-date="<?= $colis['DateCommande'] ?? '' ?>" 
             data-fournisseur="<?= htmlspecialchars($colis['nomEntreprise'] ?? '') ?>">

            <div class="colis-info">
                <h3>Colis n°<?= htmlspecialchars($colis['idColis']) ?></h3>
                <p>📄 Commande n°<?= htmlspecialchars($colis['NumeroBonDeCommande']) ?></p>
                <p>👤 Fournisseur : <?= htmlspecialchars($colis['nomEntreprise'] ?? 'Inconnu') ?></p>
            </div>

            <div class="commande-actions">
                <span class="statue-colis <?= getClasseStatutColis($colis['statut'] ?? '') ?>">
                    <?= htmlspecialchars($colis['statut'] ?? 'Inconnu') ?>
                </span>

                <p>📅 Arrivée prévue : <?= htmlspecialchars($colis['DateAriveePrevu']) ?></p>
                <a href="#" class="commande-détails">Voir détails</a>
            </div>
        </div>
    <?php } ?>
</div>
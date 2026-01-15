<div class="titre">
    <h1>Liste des Devis</h1>
    <a href="index.php?page=ajouter_devis" class="btn-nouvelle-commande">
        <i class="fas fa-plus"></i> Ajouter un devis
    </a>
</div>

<input type="text" id="searchBar" onkeyup="filtrerCommandes()" placeholder="Rechercher un devis..."> 

<div id="listeDevis"> 
    <?php if(empty($listeDevis)): ?>
        <p>Aucun devis trouvé.</p>
    <?php else: ?>
        <?php foreach ($listeDevis as $devi) { ?>
            <div class="commande-card" style="flex-wrap: wrap;">
                
                <div class="commande-info">
                    <h3><?= htmlspecialchars($devi['name'] ?? 'Devis n°'.$devi['idDevis'])?></h3>
                    <p>📄 n°<?= !empty($devi['idDevis']) ? htmlspecialchars($devi['idDevis']) : '?' ?></p>

                    <p>
                        👤 <?= !empty($devi['nomEntreprise']) ? htmlspecialchars($devi['nomEntreprise']) : 'Fournisseur inconnu' ?>
                    </p>
                    <p>
                        💰 <?= htmlspecialchars($devi['prix']) ?> €
                    </p>
                </div>

                <div class="commande-actions">
                     <?php 
                        $statut = "En attente";
                        $class = "statut-en-cours";
                        if(isset($devi['ValidationFinancier'])){
                            if($devi['ValidationFinancier'] == 1) { $statut = "Validé"; $class = "statut-livre"; }
                            elseif($devi['ValidationFinancier'] == 2) { $statut = "Refusé"; $class = "statut-retard"; }
                        }
                    ?>
                    <span class="statue-colis <?= $class ?>"><?= $statut ?></span>
                    
                    <?php if (!empty($devi['imageDevis'])): ?>
                         <a href="uploads/<?= htmlspecialchars($devi['imageDevis']) ?>" target="_blank" class="commande-détails">Voir PDF</a>
                    <?php endif; ?>
                    
                    <a href="javascript:void(0);" onclick="toggleDetails(<?= $devi['idDevis'] ?>)" class="commande-détails">Voir détails</a>
                </div>

                <div id="details-<?= $devi['idDevis'] ?>" style="display: none; width: 100%; margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; color: #555;">
                    <strong>Détails :</strong><br>
                    <?= nl2br(htmlspecialchars($devi['details'] ?? 'Aucun détail.')) ?>
                </div>
            </div>
        <?php } ?>
    <?php endif; ?>
</div>

<script>
    function toggleDetails(id) {
        var div = document.getElementById('details-' + id);
        div.style.display = (div.style.display === "none") ? "block" : "none";
    }
</script>
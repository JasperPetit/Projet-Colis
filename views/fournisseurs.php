<h1>Fournisseurs</h1>
<p>Gérez vos fournisseurs et partenaires</p>

<input type="text" id="searchBar" onkeyup="filtrerFournisseurs()" placeholder="Rechercher un fournisseur...">

<a href="index.php?page=ajouter_fournisseur" class="btn-nouvelle-commande">
    <i class="fas fa-plus"></i> Nouveau Fournisseur
</a>

<div id="listeFournisseurs" class="fournisseurs-grid">
    
    <?php foreach ($resFournisseurs as $fournisseur) { ?>
        <div class="section-fournisseur">
            <div class="nom-fournisseur">
                <h3><?= htmlspecialchars($fournisseur['nomEntreprise']) ?></h3>
            </div>

            <div class="details-fournisseur">
                <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($fournisseur['Mail']) ?></p>
                <p><i class="fas fa-phone"></i> <?= htmlspecialchars($fournisseur['NumeroTelephone']) ?></p>
                <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($fournisseur['adresse'] ?? 'Adresse non renseignée') ?></p>
                <p><i class="fa-solid fa-box"></i> <?= $fournisseur['nb_commandes'] ?> commandes passées</p>
                
                <form method="POST" style="display: inline; margin: 0; padding: 0; border: none; background: none;" onsubmit="return confirm('Supprimer ce fournisseur ?')">
                    <input type="hidden" name="id_fournisseur" value="<?= $fournisseur['idFournisseur'] ?>">    
                    <button type="submit" name="supprimer_fournisseur" class="bouton-supprimer">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    <?php } ?>

</div>
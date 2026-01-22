

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fournisseurs</title>
    <link rel="stylesheet" href="public/fournisseurStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1>Fournisseurs</h1>
        <p>Gérez vos fournisseurs et partenaires</p>
        
        <input type="text" id="searchBar" onkeyup="filtrerFournisseurs()" placeholder="Rechercher un fournisseur...">

        <a href="ajouterFournisseur" class="btn-nouvelle-commande">
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
                        
                        <form method="POST" action="SupprimerFournisseur" style="display: inline; margin: 0; padding: 0; border: none; background: none;" onsubmit="return confirmerSuppressionFournisseur('<?= htmlspecialchars($fournisseur['nomEntreprise']) ?>')">
                            <input type="hidden" name="id_fournisseur" value="<?= $fournisseur['idFournisseur'] ?>">    
                            <button type="submit" name="supprimer_fournisseur" class="bouton-supprimer">
                                Supprimer
                            </button>
                        </form>

                        <a href="ModifierFournisseur?modifier=<?= $fournisseur['idFournisseur'] ?>" class="commande-détails">
                                Modifier
                        </a>      
    
                    </div>
                    <br>
                </div>
            <?php } ?>

        </div>
    </main>

    <script>
        function filtrerFournisseurs() {
            var input = document.getElementById("searchBar");
            var filter = input.value.toUpperCase();
            var container = document.getElementById("listeFournisseurs");
            var cards = container.getElementsByClassName("section-fournisseur");

            for (var i = 0; i < cards.length; i++) {
                var h3 = cards[i].getElementsByTagName("h3")[0];
                var txtValue = h3.textContent || h3.innerText;
                cards[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
            }
        }

        function confirmerSuppressionFournisseur(nomEntreprise) {
            return confirm("Êtes-vous sûr de vouloir supprimer le fournisseur '" + nomEntreprise + "' ?\n\nCette action est irréversible.");
        }
    </script>
</body>
</html>
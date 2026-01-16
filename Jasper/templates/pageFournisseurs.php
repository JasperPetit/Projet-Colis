<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fournisseurs</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <?php include "DBconnect.php" ;?>

        <h1>Fournisseurs</h1>
        <p>Gérez vos fournisseurs et partenaires</p>
        
        <input type="text" id="searchBar" onkeyup="filtrerFournisseurs()" placeholder="Rechercher un fournisseur...">

        <div id="listeFournisseurs" class="fournisseurs-grid">
            
            <?php
                $queryFournisseurs= $db->query("SELECT F.idFournisseur, F.nomEntreprise, F.adresse, F.NumeroTelephone, F.Mail, 
                                                    COUNT(CA.idDevis) as nb_commandes
                                                    FROM Fournisseur F
                                                    LEFT JOIN Commandé_a_ CA ON F.idFournisseur = CA.idFournisseur
                                                    GROUP BY F.idFournisseur");
                $resFournisseurs = $queryFournisseurs->fetchAll(PDO::FETCH_ASSOC);
            ?>

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
                        <button class="bouton-contacter">Contacter</button>
                    </div>
                    <br>
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
    </script>
    
</body>
</html>
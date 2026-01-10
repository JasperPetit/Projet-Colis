<?php

    include "DBconnect.php"; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $role = $_POST['role'] ?? '';
        $mdp = $_POST['mdpCAS'] ?? '';

        if (!empty($prenom) && !empty($nom) && !empty($role) && !empty($mdp)) {
            try {
                $queryAjoutUtilisateur = $db->prepare("INSERT INTO Utilisateur (Prenom, nom, role, mdpCAS) VALUES (?, ?, ?, ?)");
                $queryAjoutUtilisateur->execute([$prenom, $nom, $role, $mdp]);

                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } catch (Exception $e) {
                echo "<script>alert('Erreur : " . addslashes($e->getMessage()) . "');</script>";
            }
        } else {
            echo "<script>alert('Veuillez remplir tous les champs !');</script>";
        }
    }

    $queryListeUtilisateurs = $db->query("SELECT * FROM Utilisateur");
    $resListeUtilisateurs = $queryListeUtilisateurs->fetchAll(PDO::FETCH_ASSOC);
?>
            
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de colis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .fenetre-modale {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .bouton-fermeture-croix {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }

        .contenu-modale {
            background-color: #fff;
            margin: 5% auto;
            padding: 25px;
            border-radius: 10px;
            width: 50%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
            position: relative;
            max-height: 80vh;
            overflow-y: auto;
            display: block;  
        }
    </style>
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>

        <?php
            $queryListeUtilisateurs = $db->query("SELECT * FROM Utilisateur");
            $resListeUtilisateurs = $queryListeUtilisateurs->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="titre">
            <h1>Administration</h1>
        </div>

        <div id="gestion-utilisateurs">
            <h3>Gestion des utilisateurs</h3>
            <p>Gérez les comptes utilisateurs et leurs permissions</p>
            <button onclick="ouvrirPopUp()">Voir les utilisateurs</button>
            <button onclick="ajoutUtilisateur()">Ajouter utilisateur</button>
        </div>

        <div id="maPopUp" class="fenetre-modale">
            <div class="contenu-modale">
                <span class="bouton-fermeture-croix" onclick="fermerPopUp()"></span>
                <h2>Liste des utilisateurs</h2><hr>
                
                <p>Voici la liste des utilisateurs enregistrés :</p>

                <ul>
                <?php foreach ($resListeUtilisateurs as $utilisateur) {?>
                    <p>
                        <?= htmlspecialchars($utilisateur['Prenom'])?>
                        <?=strtoupper(htmlspecialchars($utilisateur['nom']))?> 
                    </p>
                <?php } ?>
                </ul>

                <br>
                <button onclick="fermerPopUp()">Fermer la fenêtre</button>
            </div>
        </div>
        
        <div id="popUpAjoutUtilisateur" class="fenetre-modale">
            <div class="contenu-modale">
                <form method="POST">
                    <label for="prenom">Prenom :</label>
                    <input type="text" id="prenom" name="prenom"><br>

                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom"><br>

                    <label for="role">Role :</label>
                    <input type="text" id="role" name="role"><br>

                    <label for="mdpCAS">Mot de passe :</label>
                    <input type="text" id="mdpCAS" name="mdpCAS"><br>

                    <button>Ajouter l'utilisateur</button>
                </form>

                <button onclick="fermerPopUp()">Fermer la fenêtre</button>
            </div>
        </div>

    </main>

    <script>
        function ouvrirPopUp() {
            document.getElementById('maPopUp').style.display = 'block';
        }
        
        function fermerPopUp() {
            document.getElementById('maPopUp').style.display = 'none';
            document.getElementById('popUpAjoutUtilisateur').style.display = 'none';
        }

        function ajoutUtilisateur() {
            document.getElementById('popUpAjoutUtilisateur').style.display = 'block';
        }

        window.onclick = function(evenement) {
            var modaleListe = document.getElementById('maPopUp');
            var modaleAjout = document.getElementById('popUpAjoutUtilisateur');

            if (evenement.target == modaleListe) {
                modaleListe.style.display = "none";
            }
            
            else if (evenement.target == modaleAjout) {
                modaleAjout.style.display = "none";
            }
        }
    </script>
</body>
</html>
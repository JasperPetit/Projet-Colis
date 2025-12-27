<?php
    try{
        $pdo = new PDO('sqlite:database.db');

        echo "Connexion reussie !";

    } catch(PDOException $e){
        echo "Erreur de connection : " . $e->getMessage();
    }



?>
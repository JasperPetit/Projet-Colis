<?php

class ColisDAO {
    private $connexion_bdd;

    public function __construct($base_de_donnees) {
        $this->connexion_bdd = $base_de_donnees;
    }
    public function creerNouveauColis($idColis, $taille, $poids, $datePrevue, $dateReelle, $numeroCommande) {
        $requete_sql = "INSERT INTO Colis (idColis, Taille, Poids, DateAriveeReel, DateAriveePrevu, NumeroBonDeCommande) 
                        VALUES (:id, :taille, :poids, :dateR, :dateP, :numBon)";

        $preparation = $this->connexion_bdd->prepare($requete_sql);

        $preparation->bindValue(':id', $idColis, SQLITE3_INTEGER);
        $preparation->bindValue(':taille', $taille, SQLITE3_FLOAT);
        $preparation->bindValue(':poids', $poids, SQLITE3_FLOAT);
        $preparation->bindValue(':dateR', $dateReelle, SQLITE3_TEXT); 
        $preparation->bindValue(':dateP', $datePrevue, SQLITE3_TEXT);
        $preparation->bindValue(':numBon', $numeroCommande, SQLITE3_INTEGER);

        return $preparation->execute();
    }
}
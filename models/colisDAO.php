<?php

class ColisDAO {
    private $connexion_bdd;

    public function __construct($base_de_donnees) {
        $this->connexion_bdd = $base_de_donnees;
    }

}
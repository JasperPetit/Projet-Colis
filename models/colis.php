<?php

class Colis {
    private $idColis;
    private $taille;
    private $poids;
    private $dateArriveeReelle;
    private $dateArriveePrevue;
    private $numeroBonDeCommande;

    public function __construct($id = null, $taille = null, $poids = null) {
        $this->idColis = $id;
        $this->taille = $taille;
        $this->poids = $poids;
    }



    public function getIdColis() { 
        return $this->idColis; 
    }
    public function getTaille() {
        return $this->taille; 
    }
    public function getPoids() {
        return $this->poids; 
    }
    public function getDateArriveeReelle() {
        return $this->dateArriveeReelle; 
    }
    public function getDateArriveePrevue() { 
        return $this->dateArriveePrevue; 
    }
    public function getNumeroBonDeCommande() { 
        return $this->numeroBonDeCommande; 
    }

    

    public function setIdColis($id) {
        $this->idColis = $id; 
    }
    
    public function setTaille($taille) { 
        $this->taille = $taille; 
    }

    public function setPoids($poids) { 
        $this->poids = $poids; 
    }
    public function setDateArriveeReelle($date) { 
        $this->dateArriveeReelle = $date; 
    }
    public function setDateArriveePrevue($date) { 
        $this->dateArriveePrevue = $date; 
    }
    public function setNumeroBonDeCommande($num) { 
        $this->numeroBonDeCommande = $num; 
    }
}
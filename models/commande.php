<?php
namespace App\Models;

class Commande {
    private $numeroBonDeCommande;
    private $adresseDepart;
    private $adresseArivee;
    private $dateCreation;
    private $nbColis;
    private $estConfirme;  
    private $idDevis;

    public function __construct($num = null, $adresseDepart = null, $adresseArrivé = null) {
        $this->numeroBonDeCommande = $num;
        $this->adresseDepart = $adresseDepart;
        $this->adresseArivee = $adresseArrivé;
    }

    public function getNumeroBonDeCommande() { 
        return $this->numeroBonDeCommande; 
    }
    public function getAdresseDepart() { 
        return $this->adresseDepart; 
    }
    public function getAdresseArivee() { 
        return $this->adresseArivee; 
    }
    public function getDateCreation() { 
        return $this->dateCreation; 
    }
    public function getNbColis() { 
        return $this->nbColis; 
    }
    public function getEstConfirme() { 
        return $this->estConfirme; 
    }
    public function getIdDevis() { 
        return $this->idDevis; 
    }



    
    public function setNumeroBonDeCommande($num) { 
        $this->numeroBonDeCommande = $num; 
    }
    public function setAdresseDepart($adrA) { 
        $this->adresseDepart = $adrA; 
    }
    public function setAdresseArivee($adrD) { 
        $this->adresseArivee = $adrD; 
    }
    public function setDateCreation($date) { 
        $this->dateCreation = $date; 
    }
    public function setNbColis($nb) { 
        $this->nbColis = $nb; 
    }
    public function setEstConfirme($ouiOuNon) { 
        $this->estConfirme = $ouiOuNon;
    }
    public function setIdDevis($id) { 
        $this->idDevis = $id; 
    }
}
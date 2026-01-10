<?php

namespace App\Models;

class Commande {
    public int $NumeroBonDeCommande; // Clé primaire 
    public string $AdresseDepart;
    public string $AdresseArivee;
    public string $Date_;
    public int $nbColis;
    public string $statut; // 'en_cours', 'livré', 'retard' 
    public int $idDevis; // Clé étrangère 
    public bool $ConfirmerOuiOuNon;
}
?>
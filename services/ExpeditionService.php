<?php
require_once __DIR__ . '/../models/CommandeDAO.php';
require_once __DIR__ . '/../models/colis.php';

class ExpeditionService {
    private $commandeDAO;

    public function __construct($base_de_donnees) {
        $this->commandeDAO = new CommandeDAO($base_de_donnees);
    }

    public function recupererResumeDernieresCommandes() {
        return $this->commandeDAO->recupererLesTroisDernieresCommandes();
    }

    public function recupNbDeColis() {
    
        return $this->commandeDAO->recupNbDeColis();
    }


    public function rechercherEtiquettes($terme) {

    return $this->commandeDAO->trouverCommandesParCritere($terme);
    }

    public function recupererHistoriqueComplet() {
        return $this->commandeDAO->recupererToutesLesCommandes();
    }

    public function nbColisRetard(){
        return $this->commandeDAO->recupererColisEnRetard();
    }

    public function nbColisLivré(){
        return $this->commandeDAO->recupererColisLivré();
    }

    public function nbColisEnTransit(){
        return $this->commandeDAO->recupererColisEnTransit();
    }

    
}
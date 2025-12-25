<?php
require_once __DIR__ . '/../models/CommandeDAO.php';

class ExpeditionService {
    private $commandeDAO;

    public function __construct($base_de_donnees) {
        // Le service instancie lui-même le DAO dont il a besoin
        $this->commandeDAO = new CommandeDAO($base_de_donnees);
    }

    public function recupererResumeDernieresCommandes() {
        return $this->commandeDAO->recupererLesDeuxDernieresCommandes();
    }

    public function recupNbDeColis() {
    
        return $this->commandeDAO->recupNbDeColis();
    }
}
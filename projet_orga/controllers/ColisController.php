<?php
namespace App\Controllers;
use App\Models\ColisModel;
class ColisController{


    private $pdo;
    private $ColisModel;

    public function __construct($db)
    {
        $this->pdo = $db;
        $this->ColisModel = new ColisModel($db);
    }
    function resListeColis(){
        return $this->ColisModel->getListeColisComplete();
    }

    public function fournisseursFiltre(){
        return $this->ColisModel->getFournisseursAyantColis();
    }

    public function afficherColis(){
        $resListeColis = $this->ColisModel->getListeColisComplete();
        $fournisseursFiltre = $this->ColisModel->getFournisseursAyantColis();
        require_once 'views/pageColis.php';
    }

}
?>
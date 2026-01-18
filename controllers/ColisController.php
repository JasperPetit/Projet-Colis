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


    public function afficherColis(){
        $resListeColis = $this->ColisModel->getListeColisComplete();
        $fournisseursFiltre = $this->ColisModel->getFournisseursAyantColis();
        require_once 'views/pageColis.php';
    }

}
?>
<?php 
namespace App\Models;
use \PDO;
class Devis {
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function AjouterDevis($data){
        $query = $this->pdo->prepare("INSERT INTO devis (idDevis , Date_ ,imageDevis ,prix ,SignatureOuiOuNon ,identifiantCAS, name, details) VALUES (:idDevis,:Date_,:imageDevis,:prix,:non,:identifiantCAS,:nom,:details)");

        return  $query->execute([
            ':idDevis'        => $data['NumeroDevis'],
            ':Date_'          => $data['dateAujourdhui'],
            ':imageDevis'     => $data['nomFichier'],
            ':prix'           => $data['prix'],
            ':non'            => $data['signatureParDefaut'],
            ':identifiantCAS' => $data['identifiant'],
            ':nom'            => $data['name'],
            ':details'        => $data['details']
        ]);
        
    }

    public function AjouterFournisseurDevis($data){
        $query = $this->pdo->prepare("INSERT INTO Commandé_a_ (idFournisseur,idDevis) VALUES (:idFournisseur,:idDevis)");

        return $query->execute([
            ':idFournisseur' => $data['idFournisseur'],
            ':idDevis'        => $data['NumeroDevis']

        ]);
    }


    public function getAllDevis(){
        $sql = "SELECT D.*, F.nomEntreprise FROM devis D LEFT JOIN Commandé_a_ USING (idDevis) LEFT JOIN Fournisseur F USING (idFournisseur) ORDER BY D.Date_ DESC";
        $query = $this->pdo->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDevisId(){
        $sql = "SELECT idDevis FROM devis";
        $query = $this->pdo->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>
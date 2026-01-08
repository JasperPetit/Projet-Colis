<?php 


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

}

?>
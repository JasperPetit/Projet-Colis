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
        $sql = "SELECT D.*, F.nomEntreprise , U.*, Dep.nomDepartement FROM devis D 
            LEFT JOIN Commandé_a_ USING (idDevis) 
            LEFT JOIN Fournisseur F USING (idFournisseur) 
            LEFT JOIN utilisateur U ON D.identifiantCAS = U.identifiantCAS 
            LEFT JOIN Appartient_a USING (identifiantCAS) 
            LEFT JOIN Departement Dep ON Dep.idDepartement = Appartient_a.idDepartement
            ORDER BY D.Date_ DESC";
        $query = $this->pdo->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDevisId(){
        $sql = "SELECT idDevis FROM devis";
        $query = $this->pdo->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SupprimerDevis($idDevis){
        $query = $this->pdo->prepare("DELETE FROM devis WHERE idDevis = ?");
        return $query->execute([$idDevis]);
    }

    public function SupprimerCommandé($idDevis){
        $query = $this->pdo->prepare("DELETE FROM Commandé_a_ WHERE idDevis = ?");
        return $query->execute([$idDevis]);
    }

    public function ModifierDevis($tab){
        $sql = "UPDATE devis SET
        name = ?,
        prix = ?,
        details = ?,
        imageDevis = ?
        WHERE idDevis = ?";

       $query = $this->pdo->prepare($sql);
       return $query->execute([
        $tab['name'],
        $tab['prix'],
        $tab['details'],
        $tab['nomFichier'],
        $tab['idDevi']
       ]);

    }

    public function ModifierCommander($tab){
        $sql = "UPDATE commandé_a_ SET
        idFournisseur = ?
        WHERE idDevis = ?";

        $query = $this->pdo->prepare($sql);
        return $query->execute([
            $tab['idFournisseur'],
            $tab['idDevi']
        ]);

    }

    public function getDevisDepartement($dep){
        $sql = "SELECT D.*, F.nomEntreprise , U.*, Dep.nomDepartement FROM devis D 
            LEFT JOIN Commandé_a_ USING (idDevis) 
            LEFT JOIN Fournisseur F USING (idFournisseur) 
            LEFT JOIN utilisateur U ON D.identifiantCAS = U.identifiantCAS 
            LEFT JOIN Appartient_a USING (identifiantCAS) 
            LEFT JOIN Departement Dep ON Dep.idDepartement = Appartient_a.idDepartement
            WHERE Dep.idDepartement = ?
            ORDER BY D.Date_ DESC";


        $query = $this->pdo->prepare($sql);
        $query->execute([$dep]);

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>
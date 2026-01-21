<?php
namespace App\Models;
use \PDO;
class UtilisateurModel {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    // Pour la page VoirUtilisateurs
    function getAllUtilisateurs() {
        $sql = "SELECT U.*, R.nomRole as Role 
                FROM Utilisateur U
                LEFT JOIN Role R ON U.idRole = R.idRole";
                
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteUtilisateur($id) {
        $query = $this->pdo->prepare("DELETE FROM Utilisateur WHERE identifiantCAS = ?");
        return $query->execute([$id]);
    }



    // Pour la page AjouterUilisateur
    function ajouterUtilisateur($prenom, $nom, $role, $mdp, $departement = null) {
        $nomsRoles = [
            'Administrateur' => 'ADMIN', 
            'Service Financier' => 'Service_Financier', 
            'Service Postal' => 'Service_Postal'
        ];
        $roleDB = $nomsRoles[$role] ?? $role;

        // On insère l'utilisateur en cherchant l'ID du rôle DIRECTEMENT en SQL
        $sql = "INSERT INTO Utilisateur (Prenom, nom, mdpCAS, idRole) 
                VALUES (?, ?, ?, (SELECT idRole FROM Role WHERE nomRole = ?))";
        $this->pdo->prepare($sql)->execute([$prenom, $nom, $mdp, $roleDB]);

        // Si c'est un demandeur avec un département, on l'ajoute dans la table de liaison
        if ($departement) {
            $idUser = $this->pdo->lastInsertId(); // On récupère l'ID du mec qu'on vient de créer
            
            $sqlDep = "INSERT INTO Appartient_a (identifiantCAS, idDepartement) 
                    VALUES (?, (SELECT idDepartement FROM Departement WHERE nomDepartement = ?))";
            $this->pdo->prepare($sqlDep)->execute([$idUser, $departement]);
        }
    }

}
?>
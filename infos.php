    <?php 
require_once 'db.php';

$query =  $pdo-> query("SELECT * FROM commande");

$commandes = $query->fetchAll(PDO::FETCH_OBJ);

$query = $pdo-> query("SELECT co.NumeroBonDeCommande ,c.* FROM  Colis c JOIN Commande co USING (NumeroBonDeCommande) ;");

$colis = $query->fetchAll(PDO::FETCH_OBJ);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $NumSuivant = $pdo-> query("SELECT MAX(idColis) FROM colis;");
    $NumSuivant = $NumSuivant->fetch(PDO::FETCH_COLUMN) + 1;
    $NCommande = $_POST["NCommande"];
    $Taille = $_POST["Taille"];
    $Poids = $_POST["Poids"];
    $Date = $_POST["dateArr"];

    $Query = $pdo->prepare("INSERT INTO `Colis` ('idColis',`Taille`, `Poids`, `DateAriveePrevu`, `NumeroBonDeCommande`) VALUES(:idColis,:Taille,:Poids,:DateAriveePrevu,:NumeroBonDeCommande)");
    $Query->execute([
        ':idColis'=> $NumSuivant,
        ':Taille' => $Taille,
        ':Poids' => $Poids,
        ':DateAriveePrevu' => $Date,
        ':NumeroBonDeCommande' => $NCommande
    ]);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations colis A</title>
</head>
<body>

  

<h1>Voici la liste des commandes et leur colis</h1>

<ul>
    <?php foreach($commandes as $commande): ?>
    <li>La commande numéro <?php echo $commande->NumeroBonDeCommande ?> est composé de : </li>
        <ul>
            <?php foreach($colis as $coli): ?>
                <?php  if($coli->NumeroBonDeCommande == $commande->NumeroBonDeCommande):?>
                <li> <?php echo "colis " . $coli->idColis . " censé arriver le ". $coli->DateAriveePrevu ?> </li>
                
            <?php endif; endforeach; ?>
        </ul>
    <?php endforeach ?>
</ul>

</body>
</html>
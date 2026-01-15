<?php
// reset_test.php (Version Corrigée & Blindée)
include 'DBconnect.php';

try {
    echo "<h1>🛠️ Réparation et Nettoyage en cours...</h1>";

    // 1. SUPPRESSION DES ORPHELINS (Le correctif est ici !)
    // On supprime d'abord toute ligne dans Commandé_a_ qui pointe vers un devis qui n'existe pas
    $db->exec("DELETE FROM \"Commandé_a_\" WHERE idDevis NOT IN (SELECT idDevis FROM devis)");
    echo "✅ Nettoyage des données fantômes (Orphelins) terminé.<br>";

    // 2. SUPPRESSION DES DEVIS EN ATTENTE
    $db->exec("DELETE FROM \"Commandé_a_\" WHERE idDevis IN (SELECT idDevis FROM devis WHERE ValidationFinancier = 0)");
    $db->exec("DELETE FROM devis WHERE ValidationFinancier = 0");
    echo "✅ Nettoyage des devis en attente terminé.<br>";

    // 3. RÉCUPÉRATION DES DÉPARTEMENTS
    $deptInfo = $db->query("SELECT idDepartement FROM Departement WHERE nomDepartement LIKE '%Info%' LIMIT 1")->fetch();
    $deptSD = $db->query("SELECT idDepartement FROM Departement WHERE nomDepartement LIKE '%SD%' OR nomDepartement LIKE '%Science%' LIMIT 1")->fetch();

    if (!$deptInfo || !$deptSD) die("❌ Erreur : Départements introuvables.");

    // 4. RÉCUPÉRATION UTILISATEURS
    $users = $db->query("SELECT identifiantCAS, nom FROM Utilisateur LIMIT 2")->fetchAll();
    
    // 5. FORCER L'APPARTENANCE (Lien Utilisateur <-> Département)
    // On nettoie d'abord pour éviter les doublons
    $db->exec("DELETE FROM Appartient_a WHERE identifiantCAS IN (" . $users[0]['identifiantCAS'] . ", " . $users[1]['identifiantCAS'] . ")");
    
    $stmtLink = $db->prepare("INSERT INTO Appartient_a (identifiantCAS, idDepartement) VALUES (?, ?)");
    
    // User 1 -> INFO
    $stmtLink->execute([$users[0]['identifiantCAS'], $deptInfo['idDepartement']]);
    echo "✅ " . htmlspecialchars($users[0]['nom']) . " affecté à Informatique.<br>";
    
    // User 2 -> SD
    $stmtLink->execute([$users[1]['identifiantCAS'], $deptSD['idDepartement']]);
    echo "✅ " . htmlspecialchars($users[1]['nom']) . " affecté à SD.<br>";

    // 6. CRÉATION DES DEVIS
    $date = date('Y-m-d');
    $fourn = $db->query("SELECT idFournisseur FROM Fournisseur LIMIT 1")->fetch();
    
    $stmtDevis = $db->prepare("INSERT INTO devis (Date_, prix, identifiantCAS, ValidationFinancier) VALUES (?, ?, ?, 0)");
    $stmtCom = $db->prepare("INSERT INTO \"Commandé_a_\" (idFournisseur, idDevis) VALUES (?, ?)");

    // Devis INFO (2000€)
    $stmtDevis->execute([$date, 2000.00, $users[0]['identifiantCAS']]);
    $id1 = $db->lastInsertId();
    $stmtCom->execute([$fourn['idFournisseur'], $id1]);

    // Devis SD (5500€)
    $stmtDevis->execute([$date, 5500.00, $users[1]['identifiantCAS']]);
    $id2 = $db->lastInsertId();
    $stmtCom->execute([$fourn['idFournisseur'], $id2]);

    echo "<br>🎉 <strong>Succès ! Tout est réparé.</strong><br>";
    echo "<a href='pageServiceFinancier.php'><button>Retour au Dashboard pour filmer 🎥</button></a>";

} catch (Exception $e) {
    echo "<h1>❌ Erreur</h1>" . $e->getMessage();
}
?>
<?php
// install_demo_final.php
// SCRIPT DE NETTOYAGE TOTAL ET INSTALLATION PROPRE
include 'DBconnect.php';

try {
    echo "<h1>🚀 Réinitialisation Complète pour la Vidéo</h1>";

    // 1. ON VIDE TOUT (Ordre précis pour éviter les erreurs)
    $db->exec("DELETE FROM \"Commandé_a_\""); 
    $db->exec("DELETE FROM devis");
    $db->exec("DELETE FROM Appartient_a");
    // On supprime les départements pour enlever les doublons "Info" vs "Informatique"
    $db->exec("DELETE FROM Departement");
    
    // On garde les utilisateurs mais on va s'assurer d'en avoir 4 précis
    echo "✅ Base de données nettoyée (Doublons supprimés).<br>";

    // 2. CRÉATION DES 4 DÉPARTEMENTS PROPRES
    $depts = [
        ['Informatique', 15000],
        ['Science des Données', 12000],
        ['Carrières Juridiques', 8000],
        ['Gestion (GEA)', 20000]
    ];

    $stmtDept = $db->prepare("INSERT INTO Departement (nomDepartement, BudgetDepartement) VALUES (?, ?)");
    $deptIds = [];

    foreach ($depts as $d) {
        $stmtDept->execute([$d[0], $d[1]]);
        $deptIds[] = $db->lastInsertId(); // On garde l'ID pour plus tard
    }
    echo "✅ Départements créés : Info, SD, CJ, GEA.<br>";

    // 3. VÉRIFICATION / CRÉATION DES UTILISATEURS
    // On s'assure d'avoir 4 utilisateurs de test. Si ils n'existent pas, on les crée.
    $users = $db->query("SELECT identifiantCAS FROM Utilisateur LIMIT 4")->fetchAll(PDO::FETCH_COLUMN);
    
    // Si on a moins de 4 utilisateurs, on en crée des faux
    while (count($users) < 4) {
        $newId = count($users) + 1;
        $stmtUser = $db->prepare("INSERT INTO Utilisateur (Prenom, nom, role, mdpCAS) VALUES (?, ?, ?, ?)");
        $stmtUser->execute(["User$newId", "Test$newId", "Prof", "mdp"]);
        $users[] = $db->lastInsertId();
    }
    
    // 4. AFFECTATION (Lier chaque utilisateur à un département)
    $stmtLink = $db->prepare("INSERT INTO Appartient_a (identifiantCAS, idDepartement) VALUES (?, ?)");
    
    // User 1 -> Informatique
    $stmtLink->execute([$users[0], $deptIds[0]]);
    // User 2 -> Science des Données
    $stmtLink->execute([$users[1], $deptIds[1]]);
    // User 3 -> CJ
    $stmtLink->execute([$users[2], $deptIds[2]]);
    // User 4 -> GEA
    $stmtLink->execute([$users[3], $deptIds[3]]);

    echo "✅ Utilisateurs liés aux départements.<br>";

    // 5. CRÉATION DES DEVIS (COMMANDES)
    $date = date('Y-m-d');
    // On prend un fournisseur (ou on en crée un si y'en a pas)
    $fourn = $db->query("SELECT idFournisseur FROM Fournisseur LIMIT 1")->fetchColumn();
    if (!$fourn) {
        $db->exec("INSERT INTO Fournisseur (nomEntreprise, Mail, NumeroTelephone) VALUES ('Fournisseur Test', 'contact@test.com', '0102030405')");
        $fourn = $db->lastInsertId();
    }

    $stmtDevis = $db->prepare("INSERT INTO devis (Date_, prix, identifiantCAS, ValidationFinancier) VALUES (?, ?, ?, 0)");
    $stmtCom = $db->prepare("INSERT INTO \"Commandé_a_\" (idFournisseur, idDevis) VALUES (?, ?)");

    // Devis Info : 2000€
    $stmtDevis->execute([$date, 2000.00, $users[0]]);
    $id1 = $db->lastInsertId();
    $stmtCom->execute([$fourn, $id1]);

    // Devis SD : 5500€
    $stmtDevis->execute([$date, 5500.00, $users[1]]);
    $id2 = $db->lastInsertId();
    $stmtCom->execute([$fourn, $id2]);

    // Devis CJ : 1000€
    $stmtDevis->execute([$date, 1000.00, $users[2]]);
    $id3 = $db->lastInsertId();
    $stmtCom->execute([$fourn, $id3]);

    // Devis GEA : 3000€
    $stmtDevis->execute([$date, 3000.00, $users[3]]);
    $id4 = $db->lastInsertId();
    $stmtCom->execute([$fourn, $id4]);

    echo "<br><h1>🎉 Terminé ! Tout est propre.</h1>";
    echo "<a href='pageServiceFinancier.php'><button style='padding:15px; font-size:20px; background:green; color:white; cursor:pointer;'>Voir le résultat 🎥</button></a>";

} catch (Exception $e) {
    echo "<h1>❌ Erreur</h1>" . $e->getMessage();
}
?>
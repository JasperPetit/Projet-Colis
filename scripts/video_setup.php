<?php
// video_magic.php
include 'DBconnect.php';

try {
    echo "<h1>✨ Réparation Magique en cours...</h1>";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. ON VIDE TOUT (Ménage total)
    $tables = ["Commandé_a_", "devis", "Appartient_a", "Departement", "Utilisateur"];
    foreach ($tables as $t) {
        $db->exec("DELETE FROM \"$t\"");
    }

    // 2. CRÉATION DES 4 DÉPARTEMENTS (Avec des ID précis)
    $db->exec("INSERT INTO Departement (idDepartement, nomDepartement, BudgetDepartement) VALUES (1, 'Informatique', 15000)");
    $db->exec("INSERT INTO Departement (idDepartement, nomDepartement, BudgetDepartement) VALUES (2, 'Science des Données', 12000)");
    $db->exec("INSERT INTO Departement (idDepartement, nomDepartement, BudgetDepartement) VALUES (3, 'Carrières Juridiques', 8000)");
    $db->exec("INSERT INTO Departement (idDepartement, nomDepartement, BudgetDepartement) VALUES (4, 'Gestion (GEA)', 20000)");

    // 3. CRÉATION DES 4 UTILISATEURS
    // User 1 sera Info, User 2 SD, etc.
    $db->exec("INSERT INTO Utilisateur (identifiantCAS, Prenom, nom, role, mdpCAS) VALUES (1, 'Thomas', 'ProfInfo', 'Prof', 'mdp')");
    $db->exec("INSERT INTO Utilisateur (identifiantCAS, Prenom, nom, role, mdpCAS) VALUES (2, 'Sarah', 'ProfSD', 'Prof', 'mdp')");
    $db->exec("INSERT INTO Utilisateur (identifiantCAS, Prenom, nom, role, mdpCAS) VALUES (3, 'Julien', 'ProfCJ', 'Prof', 'mdp')");
    $db->exec("INSERT INTO Utilisateur (identifiantCAS, Prenom, nom, role, mdpCAS) VALUES (4, 'Emma', 'ProfGEA', 'Prof', 'mdp')");

    // 4. LES LIENS (C'est ça qui manquait !)
    // On lie de force chaque utilisateur à son département
    $db->exec("INSERT INTO Appartient_a (identifiantCAS, idDepartement) VALUES (1, 1)"); // Thomas -> Info
    $db->exec("INSERT INTO Appartient_a (identifiantCAS, idDepartement) VALUES (2, 2)"); // Sarah -> SD
    $db->exec("INSERT INTO Appartient_a (identifiantCAS, idDepartement) VALUES (3, 3)"); // Julien -> CJ
    $db->exec("INSERT INTO Appartient_a (identifiantCAS, idDepartement) VALUES (4, 4)"); // Emma -> GEA

    // 5. CRÉATION DES COMMANDES
    $date = date('Y-m-d');
    $db->exec("DELETE FROM Fournisseur"); 
    $db->exec("INSERT INTO Fournisseur (idFournisseur, nomEntreprise, Mail, NumeroTelephone) VALUES (1, 'Amazon Pro', 'contact@amazon.com', '0101010101')");

    // Commande Info (2000€)
    $db->exec("INSERT INTO devis (idDevis, Date_, prix, identifiantCAS, ValidationFinancier) VALUES (1, '$date', 2000.00, 1, 0)");
    $db->exec("INSERT INTO \"Commandé_a_\" (idFournisseur, idDevis) VALUES (1, 1)");

    // Commande SD (5500€)
    $db->exec("INSERT INTO devis (idDevis, Date_, prix, identifiantCAS, ValidationFinancier) VALUES (2, '$date', 5500.00, 2, 0)");
    $db->exec("INSERT INTO \"Commandé_a_\" (idFournisseur, idDevis) VALUES (1, 2)");

    // Commande CJ (1000€)
    $db->exec("INSERT INTO devis (idDevis, Date_, prix, identifiantCAS, ValidationFinancier) VALUES (3, '$date', 1000.00, 3, 0)");
    $db->exec("INSERT INTO \"Commandé_a_\" (idFournisseur, idDevis) VALUES (1, 3)");

    echo "<h1>✅ C'est réparé !</h1>";
    echo "Les utilisateurs sont bien liés aux départements.<br>";
    echo "<a href='pageServiceFinancier.php'><button>Aller voir le résultat</button></a>";

} catch (Exception $e) {
    echo "<h1>❌ ERREUR</h1>" . $e->getMessage();
}
?>
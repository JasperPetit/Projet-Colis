<?php
// views/dashboard/finances.php

// --- SIMULATION DES DONNÉES (En attendant la réponse de tes potes sur la DB) ---
// On imagine qu'on récupère ça de la table "Departement" 
$departements = [
    ['nom' => 'Informatique', 'budget_total' => 15000, 'budget_restant' => 4500],
    ['nom' => 'GEA', 'budget_total' => 12000, 'budget_restant' => 8200],
    ['nom' => 'Technique de Co', 'budget_total' => 10000, 'budget_restant' => 1200],
];

// On imagine qu'on récupère ça de la table "Commande" et "Devis" [cite: 36, 40]
$commandes_a_valider = [
    ['id' => 'CMD-2024-045', 'service' => 'Informatique', 'fournisseur' => 'HP', 'montant' => 1250.00, 'date' => '2024-01-04'],
    ['id' => 'CMD-2024-046', 'service' => 'GEA', 'fournisseur' => 'Bureau Vallée', 'montant' => 430.50, 'date' => '2024-01-05'],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Financier - Suivi Colis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-800">

    <nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex justify-between items-center">
        <div class="font-bold text-xl text-blue-900">IUT Villetaneuse - Finances</div>
        <div class="text-sm text-gray-500">Connecté en tant que : Service Financier</div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">
        
        <h1 class="text-3xl font-bold mb-8 text-blue-900">Tableau de Bord Financier</h1>

        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            📊 État des Budgets par Département
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <?php foreach($departements as $dept): ?>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-700 mb-2"><?php echo $dept['nom']; ?></h3>
                <div class="flex justify-between items-end mb-2">
                    <span class="text-3xl font-bold <?php echo $dept['budget_restant'] < 2000 ? 'text-red-500' : 'text-green-600'; ?>">
                        <?php echo number_format($dept['budget_restant'], 2, ',', ' '); ?> €
                    </span>
                    <span class="text-xs text-gray-400 mb-1">restants</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <?php 
                        $pourcentage = ($dept['budget_restant'] / $dept['budget_total']) * 100;
                        $couleur = $pourcentage < 20 ? 'bg-red-500' : 'bg-blue-600';
                    ?>
                    <div class="<?php echo $couleur; ?> h-2.5 rounded-full" style="width: <?php echo $pourcentage; ?>%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2">Sur un total de <?php echo number_format($dept['budget_total'], 0, ',', ' '); ?> €</p>
            </div>
            <?php endforeach; ?>
        </div>


        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            📝 Commandes à valider pour paiement
        </h2>
        <p class="text-sm text-gray-500 mb-4">Ces commandes ont été reçues et nécessitent une validation budgétaire.</p>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="p-4 font-semibold">Référence</th>
                        <th class="p-4 font-semibold">Département</th>
                        <th class="p-4 font-semibold">Fournisseur</th>
                        <th class="p-4 font-semibold">Montant</th>
                        <th class="p-4 font-semibold">Date demande</th>
                        <th class="p-4 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <?php foreach($commandes_a_valider as $cmd): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 font-medium text-blue-600"><?php echo $cmd['id']; ?></td>
                        <td class="p-4"><?php echo $cmd['service']; ?></td>
                        <td class="p-4"><?php echo $cmd['fournisseur']; ?></td>
                        <td class="p-4 font-bold"><?php echo number_format($cmd['montant'], 2, ',', ' '); ?> €</td>
                        <td class="p-4 text-gray-500"><?php echo $cmd['date']; ?></td>
                        <td class="p-4 text-right space-x-2">
                            <button class="px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 font-medium transition">
                                Valider
                            </button>
                            <button class="px-3 py-1 bg-red-50 text-red-600 rounded-md hover:bg-red-100 font-medium transition">
                                Refuser
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
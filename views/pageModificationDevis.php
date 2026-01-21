<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi Colis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>

        <?php //include "DBconnect.php" ;?>

        <h1>Modification de Devis</h1>
        <p>Modification des informations pour le devis n°<?= htmlspecialchars($devi['idDevi'] ?? '') ?></p>
        <?php if ($erreur): ?>
            <div style="color: #991B1B; background: #FEE2E2; padding: 15px; border-radius: 10px; border: 1px solid #F87171; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <form action="ajouter_devis" method="POST" enctype="multipart/form-data">
    
            <label for="num_devis">Numéro de devis :</label>
            <input type="text" id="num_devis" name="NumeroDevis" placeholder="ex: CMD-2025-001" required>
            <br>

            <label for="nom">Nom du projet :</label>
            <input type="text" id="nom" name="name" required>
            <br>


            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" step="any" required>
            <br>

            <label for="fournisseur">Fournisseur :</label>
            <select id="fournisseur" name="idFournisseur">

                <?php foreach ($resFournisseurs as $entreprise) { ?>

                    <option value="<?=$entreprise['idFournisseur']?>"><?= $entreprise['nomEntreprise'] ?></option>

                <?php } ?>

            </select>
            <br>

            <label>Lien du devis (pdf,jpg,jpeg):</label>
            <input type="file" name="ImageDevis" accept=".pdf, .jpg, .jpeg" required>
            <br>


            <label for="details">Details sur le projet :</label>
            <textarea id="details" name="details" rows="4"></textarea>
            <br>

            <button type="submit">Enregistrer le devis</button>

            <? echo $_SERVER["REQUEST_URI"]; ?>
        </form>
    </main>
</body>
</html>
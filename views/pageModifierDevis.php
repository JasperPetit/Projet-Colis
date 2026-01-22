

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commande - Suivi Colis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'navbar.php' ; ?>

    <main>
        <h1><i class="fas fa-edit"></i> Modifier le devi</h1>
        <p>Modification des informations pour le devi n°<?= htmlspecialchars($devi['idDevis'] ?? '') ?></p>

        <?php if ($erreur): ?>
            <div style="color: #991B1B; background: #FEE2E2; padding: 15px; border-radius: 10px; border: 1px solid #F87171; margin-bottom: 20px;">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <form action="ModifierDevis?modifier=<?= $devi['idDevis'] ?>" method="POST" enctype="multipart/form-data">    
            <label for="num_commande">Numéro de devi (non modifiable) :</label>
            <input type="text" id="num_commande" name="idDevis" 
                   value="<?= htmlspecialchars($devi['idDevis'] ?? '') ?>" readonly style="background-color: #f1f5f9;">
            <br>
            
            <label for="nom">Nom du projet :</label>
            <input type="text" id="nom" name="name" 
                    value="<?= htmlspecialchars($devi['name'] ?? '') ?>"   required>
            <br>

            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" step="any" 
                    value="<?= htmlspecialchars($devi['prix'] ?? '') ?>"  required>
            <br>


            <label for="fournisseur">Fournisseur :</label>

            <select id="fournisseur" name="idFournisseur">

                <?php foreach ($resFournisseurs as $entreprise) { 
                    
                    // 1. On vérifie si l'ID de la boucle correspond à l'ID voulu
                    $isSelected = ($entreprise['idFournisseur'] == $devi['idFournisseur']) ? 'selected' : ''; 
                ?>

                    <option value="<?= $entreprise['idFournisseur'] ?>" <?= $isSelected ?>>
                        <?= $entreprise['nomEntreprise'] ?>
                    </option>

                <?php } ?>
                
            </select>


            <label>Lien du devis (pdf,jpg,jpeg):</label>
            <div class="commande-actions">
                <?php 
                    // 1. On définit le chemin physique du fichier (relatif à index.php)
                    $cheminFichier = 'uploads/' . $devi['imageDevis'];

                    // 2. On vérifie deux choses :
                    //    - Qu'il y a bien un nom dans la BDD (!empty)
                    //    - QUE le fichier existe physiquement (file_exists)
                    if (!empty($devi['imageDevis']) && file_exists($cheminFichier)): 
                    ?>
                        
                        <a href="<?= $cheminFichier ?>" target="_blank" class="commande-détails">
                            <i class="fas fa-file-pdf"></i> Voir le fichier
                        </a>

                    <?php elseif (!empty($devi['imageDevis'])): ?>

                        <span style="color: red; font-size: 0.9em;">
                            <i class="fas fa-exclamation-triangle"></i> Fichier introuvable
                        </span>

                    <?php endif; ?>

                    <a href="javascript:void(0);" onclick="toggleDetails(<?= $devi['idDevis'] ?>)" class="commande-détails">Voir détails</a>
                </div>


            <input type="file" 
                name="ImageDevis" 
                accept=".pdf, .jpg, .jpeg"
                <?= empty($devi['imageDevis']) ? 'required' : '' ?> 
            >

            <input type="hidden" name="ancienDevis" value="<?= $devi['imageDevis'] ?>">

            <br>


            <label for="details">Details sur le projet :</label>
            <textarea id="details" name="details" rows="4" >
                <?= htmlspecialchars($devi['details']) ?>
            </textarea>
                
            <br>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-nouvelle-commande">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="pageInfosDevis" class="btn-reinitialiser" style="text-decoration: none;">
                    Annuler
                </a>
            </div>
        </form>
    </main>
</body>
</html>
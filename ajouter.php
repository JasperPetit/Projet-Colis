<?php
$page_active = 'ajouter';
$titre_page = 'Nouvelle Facture';
include 'header.php';

require_once 'autoload.php';

$error = null;
$success = false;

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new FactureController();
    $result = $controller->create();
    
    if (isset($result['error'])) {
        $error = $result['error'];
    } else {
        exit;
    }
}
?>

<div class="box form-container">
    <h2>Ajout d'une facture fournisseur</h2>
    
    <?php if ($error): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label class="form-label" for="client">Service / Client :</label>
            <input 
                type="text" 
                id="client" 
                name="client" 
                class="form-input" 
                required 
                placeholder="Nom du client ou service"
                value="<?php echo isset($_POST['client']) ? htmlspecialchars($_POST['client']) : ''; ?>"
            >
        </div>
        
        <div class="form-group">
            <label class="form-label" for="montant">Montant (€) :</label>
            <input 
                type="number" 
                id="montant" 
                name="montant" 
                class="form-input" 
                required 
                min="0" 
                step="0.01"
                placeholder="0.00"
                value="<?php echo isset($_POST['montant']) ? htmlspecialchars($_POST['montant']) : ''; ?>"
            >
        </div>
        
        <div class="form-group">
            <label class="form-label" for="type">Statut :</label>
            <select id="type" name="type" class="form-select">
                <option value="attente" <?php echo (isset($_POST['type']) && $_POST['type'] == 'attente') ? 'selected' : ''; ?>>
                    En attente de validation
                </option>
                <option value="paye" <?php echo (isset($_POST['type']) && $_POST['type'] == 'paye') ? 'selected' : ''; ?>>
                    Déjà Payé
                </option>
            </select>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-yellow btn-full-width">Enregistrer</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
<h1>Ajout de nouveau Fournisseur</h1>

<form action="index.php?page=ajouter_fournisseur" method="POST">

    <label for="nom_entreprise">Nom du fournisseur :</label>
    <input type="text" id="nom_entreprise" name="nomEntreprise" placeholder="Entrer le nom de l'entreprise..." required>
    <br>

    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" placeholder="Entrer l'adresse de l'entreprise..." required>
    <br>

    <label for="num_telephone">Numéro de téléphone :</label>
    <input type="text" id="num_telephone" name="NumeroTelephone" placeholder="Entrer le numéro de téléphone..." required>
    <br>

    <label for="mail_entrprise">Mail du fournisseur :</label>
    <input type="text" id="mail_entrprise" name="Mail" placeholder="Entrer le mail du fournisseur..." required>
    <br>

    <button type="submit">Ajouter le Fournisseur</button>
</form>
/**
 * Script de synchronisation pour le formulaire de nouvel envoi
 */

// On attend que le HTML soit totalement chargé avant de chercher les éléments
document.addEventListener('DOMContentLoaded', function() {

    // 1. Sélection des éléments du formulaire
    const inputPoids = document.getElementById('input-poids');
    const selectType = document.getElementById('select-type');

    // 2. Sélection des éléments du récapitulatif
    const recapPoids = document.getElementById('recap-poids');
    const recapType = document.getElementById('recap-type');

    // --- SYNCHRONISATION DU POIDS ---
    if (inputPoids && recapPoids) {
        inputPoids.addEventListener('input', function() {
            // On récupère la valeur et on l'affiche avec l'unité
            const valeur = inputPoids.value;
            recapPoids.innerText = valeur + " kg";
        });
    }

    // --- SYNCHRONISATION DU TYPE D'ENVOI ---
    if (selectType && recapType) {
        selectType.addEventListener('change', function() {
            // Récupère l'option choisie
            const optionChoisie = selectType.options[selectType.selectedIndex].text;
            
            // Nettoyage : on ne garde que le premier mot (ex: "Express" au lieu de "Express (24h)")
            const typePropre = optionChoisie.split(' ')[0];
            
            recapType.innerText = typePropre;
        });
    }


});




const inputPoids = document.getElementById('input-poids');
const selectType = document.getElementById('select-type');
const prixAffiche = document.getElementById('prix-affiche');
const prixCache = document.getElementById('valeur-prix-cache');

function calculerAutomatiquement() {

    let p = parseFloat(inputPoids.value.replace(',', '.'));



    if (p < 5) {
        tarifBase = 10.00; 
    } else {
        tarifBase = 20.00; 
    }


    let typeChoisi = selectType.options[selectType.selectedIndex].text;
    
    if (typeChoisi.includes("Express")) {
        tarifBase = tarifBase + 5.00; // Supplément rapidité
    }

    prixAffiche.textContent = tarifBase.toFixed(2);
    prixCache.value = tarifBase.toFixed(2);
}



inputPoids.addEventListener('input', calculerAutomatiquement);
selectType.addEventListener('change', calculerAutomatiquement);







//REMET LES INPUTS A 0

window.addEventListener('load', function() {
    // 1. On récupère le formulaire
    const formulaire = document.getElementById('mon-formulaire');
    
    if (formulaire) {
        // 2. On remet tous les inputs à leurs valeurs d'origine
        formulaire.reset();
    }


    if (typeof calculerAutomatiquement === "function") {
        calculerAutomatiquement();
    }
});











const inputAdresse = document.getElementById('input-adresse');
const listeAdresses = document.getElementById('liste-adresses');
const inputVille = document.getElementById('ville-destinataire');
const inputCP = document.getElementById('cp-destinataire');

/**
 * Fonction pour appeler l'API Adresse et afficher les suggestions
 */
function rechercherAdresse() {
    const texte = inputAdresse.value;

    // On ne lance la recherche qu'à partir de 3 caractères
    if (texte.length < 3) {
        listeAdresses.style.display = 'none';
        return;
    }

    // Appel à l'API (Gratuit et sans clé)
    fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(texte)}&limit=5`)
        .then(response => response.json())
        .then(data => {
            listeAdresses.innerHTML = ""; // On vide la liste précédente
            
            if (data.features.length > 0) {
                listeAdresses.style.display = 'block';
                
                data.features.forEach(feature => {
                    const li = document.createElement('li');
                    li.style.padding = "10px";
                    li.style.cursor = "pointer";
                    li.textContent = feature.properties.label;

                    // Quand on clique sur une adresse suggérée
                    li.addEventListener('click', () => {
                        inputAdresse.value = feature.properties.name;
                        inputVille.value = feature.properties.city;
                        inputCP.value = feature.properties.postcode;
                        listeAdresses.style.display = 'none';
                    });

                    listeAdresses.appendChild(li);
                });
            }
        });
}

// On écoute la saisie sur le champ adresse
inputAdresse.addEventListener('input', rechercherAdresse);

// On ferme la liste si on clique ailleurs sur la page
document.addEventListener('click', (e) => {
    if (e.target !== inputAdresse) listeAdresses.style.display = 'none';
});
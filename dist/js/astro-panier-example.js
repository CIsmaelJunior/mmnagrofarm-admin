// ========================================
// EXEMPLE D'INTÉGRATION POUR VOTRE SITE ASTRO
// ========================================
// Ce fichier montre comment intégrer l'API Laravel dans votre site Astro

// Configuration de l'API
const API_BASE_URL = 'http://localhost:8000/api'; // Remplacez par votre URL Laravel

// Fonction pour envoyer une demande de devis depuis votre site Astro
async function sendDevisRequest(devisData) {
    try {
        // Afficher un indicateur de chargement
        const submitButton = document.querySelector('#devis-form button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.innerHTML = '<div class="flex items-center justify-center"><div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>Envoi en cours...</div>';
        submitButton.disabled = true;

        const response = await fetch(`${API_BASE_URL}/devis`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                // Note: Pour un site Astro, vous devrez gérer le CSRF différemment
                // Soit en désactivant la protection CSRF pour cette route API
                // Soit en récupérant le token depuis une route dédiée
            },
            body: JSON.stringify(devisData)
        });

        const result = await response.json();

        if (result.success) {
            // Afficher une confirmation
            showDevisConfirmation(result.numero_commande);

            // Vider le panier
            clearCart();

            // Réinitialiser le formulaire
            document.getElementById('devis-form').reset();
        } else {
            throw new Error(result.message || 'Erreur lors de l\'envoi de la demande');
        }

    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'envoi de la demande de devis: ' + error.message);
    } finally {
        // Restaurer le bouton
        const submitButton = document.querySelector('#devis-form button[type="submit"]');
        submitButton.innerHTML = originalText;
        submitButton.disabled = false;
    }
}

// Fonction pour afficher la confirmation
function showDevisConfirmation(numeroCommande) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-32 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-2xl z-50 transform translate-x-full transition-transform duration-300';
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <div>
                <div class="font-semibold">Demande de devis envoyée !</div>
                <div class="text-sm opacity-90">Numéro: ${numeroCommande}</div>
            </div>
        </div>
    `;

    document.body.appendChild(notification);

    // Animer l'entrée
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Supprimer après 8 secondes
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 8000);
}

// Fonction pour vider le panier (à adapter selon votre logique Astro)
function clearCart() {
    // Remplacez par votre logique de panier Astro
    localStorage.removeItem('mmb-cart');
    // Ou appelez votre fonction de mise à jour du panier Astro
}

// ========================================
// EXEMPLE D'UTILISATION DANS VOTRE SITE ASTRO
// ========================================

// Dans votre composant Astro ou votre script, vous pouvez faire :

/*
// 1. Récupérer les données du panier (selon votre logique Astro)
const cartData = getCartData(); // Votre fonction pour récupérer le panier

// 2. Récupérer les données du formulaire
const formData = new FormData(document.getElementById('devis-form'));

// 3. Préparer les données pour l'API
const devisData = {
    produits: cartData,
    client: {
        nom: formData.get('nom'),
        email: formData.get('email'),
        telephone: formData.get('telephone'),
        entreprise: formData.get('entreprise'),
        adresse: formData.get('adresse'),
        ville: formData.get('ville'),
        code_postal: formData.get('code_postal'),
        date_livraison: formData.get('date_livraison'),
        commentaires: formData.get('commentaires')
    },
    date_demande: new Date().toISOString()
};

// 4. Envoyer à l'API Laravel
sendDevisRequest(devisData);
*/

// ========================================
// NOTES IMPORTANTES POUR L'INTÉGRATION
// ========================================

/*
1. CORS: Assurez-vous que votre API Laravel accepte les requêtes depuis votre domaine Astro
   - Ajoutez votre domaine dans config/cors.php
   - Ou utilisez un middleware CORS

2. CSRF: Pour les routes API, vous pouvez :
   - Désactiver la protection CSRF pour cette route spécifique
   - Ou créer une route pour récupérer le token CSRF

3. URL: Remplacez 'http://localhost:8000' par l'URL de votre serveur Laravel

4. Validation: L'API valide déjà les données, mais vous pouvez ajouter une validation côté client

5. Gestion d'erreurs: Adaptez la gestion d'erreurs selon vos besoins
*/

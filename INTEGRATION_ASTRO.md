# 🔗 Intégration API Laravel avec Site Astro

## 📋 Résumé de l'architecture

- **Laravel Admin** : Dashboard d'administration (ce projet)
- **Site Astro** : Site web public avec panier (votre autre projet)
- **API Laravel** : Reçoit les demandes de devis depuis Astro

## 🚀 API Endpoint

### **POST** `/api/devis`

**URL complète** : `http://localhost:8000/api/devis`

### **Payload attendu** :

```json
{
  "produits": [
    {
      "id": "1",
      "nom": "Oignon Safari",
      "variete": "Safari",
      "conditionnement": "20kg",
      "quantite": 5,
      "image": "/img/produits/oignon-safari.jpg"
    }
  ],
  "client": {
    "nom": "Jean Dupont",
    "email": "jean.dupont@example.com",
    "telephone": "+223 70 00 00 00",
    "entreprise": "Restaurant Le Gourmet",
    "adresse": "123 Avenue de la République, Quartier du Plateau",
    "ville": "Abidjan",
    "code_postal": "00225",
    "date_livraison": "2025-09-25",
    "commentaires": "Besoin urgent pour un événement"
  }
}
```

### **Réponse de succès** :

```json
{
  "success": true,
  "message": "Demande de devis envoyée avec succès !",
  "commande_id": 123,
  "numero_commande": "CMD-2025-1234"
}
```

### **Réponse d'erreur** :

```json
{
  "success": false,
  "message": "Erreur lors de l'envoi de la demande de devis.",
  "error": "Détails de l'erreur"
}
```

## 🔧 Intégration dans votre site Astro

### **1. Code JavaScript à ajouter dans votre site Astro** :

```javascript
// Configuration
const API_BASE_URL = 'http://localhost:8000/api'; // Remplacez par votre URL

// Fonction pour envoyer la demande de devis
async function sendDevisRequest(devisData) {
    try {
        const response = await fetch(`${API_BASE_URL}/devis`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(devisData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Afficher confirmation avec le numéro de commande
            showSuccessMessage(result.numero_commande);
            // Vider le panier
            clearCart();
        } else {
            throw new Error(result.message);
        }
        
    } catch (error) {
        console.error('Erreur:', error);
        showErrorMessage(error.message);
    }
}

// Utilisation dans votre formulaire
document.getElementById('devis-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Récupérer les données du panier (selon votre logique Astro)
    const cartData = getCartData(); // Votre fonction
    
    // Récupérer les données du formulaire
    const formData = new FormData(e.target);
    
    // Préparer les données
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
        }
    };
    
    // Envoyer la demande
    await sendDevisRequest(devisData);
});
```

### **2. Structure des données produits** :

Vos produits Astro doivent avoir cette structure :

```javascript
{
  id: "1",                    // ID unique du produit
  nom: "Oignon Safari",       // Nom du produit
  variete: "Safari",          // Variété
  conditionnement: "20kg",    // Conditionnement
  quantite: 5,                // Quantité demandée
  image: "/img/produits/..."  // Chemin de l'image
}
```

## 🔒 Configuration CORS

Le middleware CORS est configuré pour accepter les requêtes depuis :

- `http://localhost:4321` (Astro dev server)
- `http://localhost:3000` (Autre port possible)
- Votre domaine de production

**Pour ajouter votre domaine** : Modifiez `app/Http/Middleware/CorsMiddleware.php`

## 📊 Workflow complet

### **Côté Astro (Site public)** :
1. **Client ajoute des produits** au panier
2. **Client remplit le formulaire** de demande de devis
3. **Envoi à l'API Laravel** via `POST /api/devis`
4. **Confirmation** avec numéro de commande

### **Côté Laravel (Admin)** :
1. **Réception** de la demande dans `/orders`
2. **Identification** : Badge "Demande de devis"
3. **Traitement** : Admin fixe le prix et change le statut
4. **Suivi** : Passage de "en_attente" à "en_cours" puis "livrée"

## 🧪 Test de l'API

Vous pouvez tester l'API avec curl :

```bash
curl -X POST http://localhost:8000/api/devis \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "produits": [
      {
        "id": "1",
        "nom": "Oignon Safari",
        "variete": "Safari",
        "conditionnement": "20kg",
        "quantite": 5,
        "image": "/img/produits/oignon-safari.jpg"
      }
    ],
    "client": {
      "nom": "Test User",
      "email": "test@example.com",
      "telephone": "+223 70 00 00 00",
      "entreprise": "Test Company",
      "adresse": "123 Test Street",
      "ville": "Abidjan",
      "code_postal": "00225",
      "date_livraison": "2025-09-25",
      "commentaires": "Test de l'API"
    }
  }'
```

## 📝 Notes importantes

1. **Pas de CSRF** : Les routes API n'ont pas de protection CSRF
2. **Validation** : L'API valide tous les champs requis
3. **Clients** : Création automatique ou mise à jour des clients existants
4. **Numéros** : Génération automatique de numéros de commande uniques
5. **Statut** : Toutes les demandes arrivent en statut "en_attente"

## 🎯 Prochaines étapes

1. **Intégrer le code** dans votre site Astro
2. **Tester** avec des vraies données
3. **Configurer** l'URL de production
4. **Personnaliser** les messages de confirmation
5. **Ajouter** la gestion d'erreurs selon vos besoins

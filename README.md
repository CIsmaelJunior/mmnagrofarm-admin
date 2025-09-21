# MMB AgroFarm Admin

## 📋 Vue d'ensemble

**MMB AgroFarm Admin** est une plateforme d'administration complète pour la gestion d'une entreprise agricole. Cette application Laravel permet de gérer les produits, commandes, clients et paramètres de l'entreprise MMB AgroFarm.

## 🚀 Fonctionnalités principales

### 1. **Tableau de bord**
- **Statistiques en temps réel** : Chiffre d'affaires, commandes totales, clients actifs, nombre de produits
- **Vue d'ensemble** : Informations clés de l'entreprise avec indicateurs de performance
- **Design moderne** : Interface utilisateur intuitive avec cartes statistiques

### 2. **Gestion des Produits**
- **Catalogue complet** : 12 produits agricoles avec variétés spécifiques
- **Informations détaillées** : Description, origine, goût, conservation, saison, usage
- **Conditionnement** : Formats multiples (20kg, 45kg, etc.)
- **Bienfaits nutritionnels** : Propriétés santé de chaque produit
- **Images** : Photos des produits stockées dans `public/img/produits/`
- **CRUD complet** : Création, lecture, mise à jour, suppression avec soft delete
- **Slugs SEO** : URLs optimisées pour le référencement

### 3. **Gestion des Commandes**
- **Suivi complet** : Numéros de commande uniques, statuts, dates
- **Informations client** : Intégration avec la base clients
- **Produits commandés** : Stockage JSON des produits et quantités
- **Statuts** : En attente, en cours, livrée
- **Montants** : Calcul automatique des totaux
- **Historique** : Suivi des modifications et dates

### 4. **Gestion des Clients**
- **Base de données clients** : Informations complètes (nom, email, téléphone, entreprise)
- **Adresses de livraison** : Gestion des adresses complètes
- **Statut actif** : Activation/désactivation des comptes clients
- **Historique des commandes** : Lien avec les commandes passées
- **Notes** : Informations supplémentaires sur les clients

### 5. **Paramètres**
- **Profil utilisateur** : Gestion des informations personnelles et photo de profil
- **Paramètres système** : Configuration générale (nom du site, logo, contact)
- **Notifications** : Préférences email et SMS
- **Sécurité** : Changement de mot de passe
- **Informations système** : Version PHP, Laravel, base de données

## 🛠️ Technologies utilisées

- **Backend** : Laravel 10.x
- **Frontend** : Bootstrap 5, Soft UI Dashboard
- **Base de données** : MySQL
- **Icons** : Font Awesome
- **JavaScript** : Vanilla JS pour les interactions
- **Upload de fichiers** : Gestion native Laravel


## 📁 Structure du projet

```
mmbagrofarm-admin/
├── app/
│   ├── Http/Controllers/
│   │   ├── ProduitController.php
│   │   ├── CommandeController.php
│   │   ├── ClientController.php
│   │   └── SettingsController.php
│   └── Models/
│       ├── Produit.php
│       ├── Commande.php
│       └── Client.php
├── database/
│   ├── migrations/
│   │   ├── create_produits_table.php
│   │   ├── create_commandes_table.php
│   │   └── create_clients_table.php
│   └── seeders/
│       ├── ProduitsSeeder.php
│       ├── ClientsSeeder.php
│       └── DatabaseSeeder.php
├── resources/views/dashboard/
│   ├── index.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   └── edit.blade.php
│   ├── orders/
│   │   └── index.blade.php
│   ├── clients/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── settings/
│       ├── index.blade.php
│       ├── profile.blade.php
│       ├── system.blade.php
│       └── notifications.blade.php
└── public/img/produits/
    └── [images des produits]
```

## 🗄️ Base de données

### Table `produits`
- **Champs principaux** : `id`, `slug`, `nom`, `variete`, `description`
- **Caractéristiques** : `origine`, `gout`, `conservation`, `saison`, `usage`
- **Conditionnement** : `conditionnement` (JSON)
- **Média** : `image`
- **Prix** : `prix` (decimal)
- **Bienfaits** : `bienfaits` (JSON)
- **Soft delete** : `deleted_at`, `deleted_by`

### Table `clients`
- **Informations personnelles** : `nom`, `email`, `telephone`
- **Entreprise** : `entreprise`
- **Adresse** : `adresse_livraison`, `ville`, `code_postal`
- **Métadonnées** : `notes`, `actif`
- **Soft delete** : `deleted_at`, `deleted_by`

### Table `commandes`
- **Référence** : `numero_commande` (unique)
- **Client** : `client_id` (foreign key)
- **Produits** : `produits` (JSON)
- **Quantités** : `total_articles`
- **Montant** : `montant_total`
- **Dates** : `date_livraison_souhaitee`, `created_at`
- **Statut** : `statut` (enum)
- **Notes** : `commentaires`, `notes_admin`
- **Soft delete** : `deleted_at`, `deleted_by`


## 📊 Données de test

### Produits (12 variétés)
1. **Oignon Safari** - Variété africaine, saveur intense
2. **Gombo Hiré** - Texture tendre, goût délicat
3. **Tomate Cobra** - Hybride robuste, forme allongée
4. **Aubergine Djemba** - Variété traditionnelle africaine
5. **Poivron California** - Chair épaisse, saveur sucrée
6. **Piment Big Sun** - Piment doux, arôme fruité
7. **Choux KK Cross** - Hybride robuste, climats chauds
8. **Concombre Tokyo** - Variété japonaise, sans amertume
9. **Carotte New Kuroda** - Variété asiatique, sucrée
10. **Haricot Cora** - Texture tendre, goût délicat
11. **Pastèque Baby Doll** - Variété compacte, peu de graines
12. **Melon Galia** - Arôme exceptionnel, chair orange

### Clients (10 exemples)
- **Particuliers** : Clients individuels avec adresses personnelles
- **Entreprises** : Clients professionnels avec informations d'entreprise
- **Mixte** : Combinaison de particuliers et professionnels

## 🔧 Installation et configuration

### Prérequis
- PHP 8.1+
- Composer
- MySQL 5.7+
- Node.js (optionnel pour les assets)

### Installation
```bash
# Cloner le projet
git clone [repository-url]
cd mmbagrofarm-admin

# Installer les dépendances
composer install

# Configuration
cp .env.example .env
php artisan key:generate

# Base de données
php artisan migrate
php artisan db:seed

# Serveur de développement
php artisan serve
```

### Configuration de la base de données
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mmbagrofarm_admin
DB_USERNAME=root
DB_PASSWORD=
```


## 🚀 Fonctionnalités avancées

### Soft Delete
- **Implémentation** : Tous les modèles utilisent le trait `SoftDeletes`
- **Champs** : `deleted_at`, `deleted_by`
- **Avantages** : Récupération possible, audit trail

### Upload de fichiers
- **Images produits** : Stockage dans `public/img/produits/`
- **Validation** : Types et tailles de fichiers
- **Prévisualisation** : JavaScript pour aperçu immédiat

### Relations Eloquent
- **Commande → Client** : `belongsTo`
- **Client → Commandes** : `hasMany`
- **Eager loading** : Optimisation des requêtes

### Validation
- **Côté serveur** : Règles Laravel complètes
- **Côté client** : JavaScript pour UX améliorée
- **Messages d'erreur** : Affichage contextuel

## 📱 Pages et fonctionnalités

### Dashboard (`/`)
- Statistiques principales
- Vue d'ensemble de l'activité
- Accès rapide aux sections

### Produits (`/products`)
- **Index** : Liste avec filtres et actions
- **Détails** : Vue complète d'un produit
- **Édition** : Formulaire de modification
- **Suppression** : Modal de confirmation

### Commandes (`/orders`)
- **Index** : Liste avec statistiques
- **Détails** : Informations complètes
- **Statuts** : Gestion des états
- **Historique** : Suivi des modifications

### Clients (`/clients`)
- **Index** : Liste avec statistiques
- **Détails** : Profil complet
- **Création** : Formulaire d'ajout
- **Édition** : Modification des informations

### Paramètres (`/settings`)
- **Index** : Vue d'ensemble des paramètres
- **Profil** : Gestion du compte utilisateur
- **Système** : Configuration générale
- **Notifications** : Préférences de communication


## 🔒 Sécurité

### Authentification
- **Middleware** : Protection des routes
- **Sessions** : Gestion sécurisée
- **CSRF** : Protection contre les attaques

### Validation
- **Input sanitization** : Nettoyage des données
- **File upload** : Validation des types et tailles
- **SQL injection** : Protection via Eloquent ORM

### Soft Delete
- **Audit trail** : Traçabilité des suppressions
- **Récupération** : Possibilité de restaurer
- **Sécurité** : Données non perdues définitivement

## 📈 Performance

### Optimisations
- **Eager loading** : Réduction des requêtes N+1
- **Indexes** : Optimisation des recherches
- **Pagination** : Gestion des grandes listes
- **Cache** : Mise en cache des données statiques

### Base de données
- **Indexes** : Sur les champs de recherche fréquents
- **Relations** : Clés étrangères optimisées
- **Types de données** : Choix appropriés pour chaque champ

## 🎯 Améliorations futures

### Fonctionnalités suggérées
- **Authentification** : Système de connexion complet
- **Rôles et permissions** : Gestion des accès
- **API REST** : Endpoints pour applications mobiles
- **Rapports** : Génération de PDF et Excel
- **Notifications** : Système de notifications en temps réel
- **Backup** : Sauvegarde automatique
- **Logs** : Système de logs avancé

### Optimisations techniques
- **Cache Redis** : Mise en cache avancée
- **Queue jobs** : Traitement asynchrone
- **CDN** : Distribution des assets
- **Monitoring** : Surveillance des performances

## 📞 Support

### Contact
- **Email** : contact@mmbagrofarm.com
- **Téléphone** : +223 70 00 00 00
- **Adresse** : Bamako, Mali

### Documentation
- **Laravel** : [laravel.com/docs](https://laravel.com/docs)
- **Bootstrap** : [getbootstrap.com/docs](https://getbootstrap.com/docs)
- **Soft UI** : [creative-tim.com](https://creative-tim.com)

---

## 📝 Changelog

### Version 1.0.0 (2024)
- ✅ Création de la structure de base
- ✅ Implémentation du dashboard
- ✅ Gestion complète des produits
- ✅ Gestion des commandes et clients
- ✅ Système de paramètres
- ✅ Interface utilisateur moderne
- ✅ Base de données avec seeders
- ✅ Soft delete et relations
- ✅ Upload de fichiers
- ✅ Validation et sécurité

---

**MMB AgroFarm Admin** - Plateforme d'administration agricole moderne et complète.

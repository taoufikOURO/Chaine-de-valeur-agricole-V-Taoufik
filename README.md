# Système de Suivi des Parcelles et Interventions Agricoles

Ce projet Laravel est une application web permettant aux agriculteurs de gérer leurs parcelles agricoles et de suivre les différentes interventions effectuées (semis, arrosage, fertilisation, etc.). Ce TP a été réalisé dans un but pédagogique dans le cadre du cours intitulé <strong>outils de développement web</strong> avec Laravel.

## Fonctionnalités

### 🔓 Utilisateur non authentifié

-   Accès à la page de connexion
-   Demande de réinitialisation de mot de passe (formulaire + email)
-   Réinitialisation du mot de passe via lien reçu par mail
-   Redirection automatique vers la page de login s’il tente d’accéder à une page protégée

### 👨‍🌾 Utilisateur authentifié – Agriculteur

-   ✅ Accès sécurisé avec vérification email obligatoire
-   👤 Gestion de son profil utilisateur (édition, mise à jour)
- Affichage ds
-   📊 Accès à un tableau de bord personnalisé
    -   Statistiques générales
    -   Télécharger les informations relatives aux interventions sur des parcelles
    -   Statistiques spécifiques à l’agriculteur
    -   Graphiques des interventions
    -   Visualisation des semis non encore arrosés

#### 🗺️ Gestion des parcelles

-   Créer une nouvelle parcelle
-   Modifier une parcelle existante
-   Supprimer une parcelle (Tant qu'elle n'a pas encore été utilisée)
-   Lister toutes les parcelles

#### 🌱 Gestion des interventions (par type)

-   **Semis** :
    -   Créer, visualiser et modifier les semis
    -   Historique des semis
-   **Arrosage**, **Fertilisation**, **Récolte**

### 🛠️ Administrateur

-   ✅ Accès sécurisé avec vérification email obligatoire
-   🔧 Gestion des cultures :
    -   Ajouter, modifier, supprimer des cultures
-   🔖 Gestion des types de cultures :
    -   Ajouter, modifier, supprimer des types
-   Télécharger les informations relatives aux interventions sur des parcelles
-   👥 Gestion des utilisateurs (agriculteurs et administrarteurs) :
    -   Lister, créer ou désctiver des comptes utilisateurs.

### ✉️ Vérification Email

-   Notification de vérification à l'inscription
-   Possibilité de renvoyer une notification

## Technologies utilisées

### 🧱 Backend

-   **PHP 8.x**
-   **Laravel 12.x**
-   **Eloquent ORM** : gestion des relations entre modèles

### 🗄️ Base de données

-   **MySQL**

### 🎨 Frontend

-   **Blade** : moteur de template Laravel
-   **Tailwind CSS** : pour les styles
-   **Chart.js** : pour les graphiques dans le tableau de bord.

### 🔒 Sécurité

-   Middleware `auth`, `verified`, et `CheckRole`
-   Vérification d’adresse email
-   Protection des routes selon le rôle (admin/agriculteur)

### 🔧 Divers

-   **Leaflet.js**: pour les cartes et les modèles de carte
-   **dompdf**: pour générer des PDFs pour les rapports

## Installation du projet

### 📦 Prérequis

-   PHP 8.2
-   Composer
-   MySQL ou MariaDB
-   Node.js & npm (pour compiler les assets si besoin)
-   Un serveur local Xampp, Lampp ou Wamp

---

### 🧰 Étapes d'installation

1. **Cloner le dépôt**

    ```bash
    git clone https://github.com/taoufikOURO/Chaine-de-valeur-agricole-V-Taoufik.git

    cd <nom-du-dossier>
    ```

2. **Installer les dépendances PHP**

    ```bash
    composer install
    ```

3. **Créer le fichier d’environnement à la racine du projet:**
   Une fois le fichier créer, copiez le contenu du fichier `.env.example` dans le fichier `.env` et remplacez les variables par les valeurs appropriées.

    Si vous êtes sur Mac ou Linux, utilisez la commande suivante pour copier le contenu du fichier `.env.example` dans le fichier `.env` :

    ```bash
    touch .env
    cp .env.example .env
    ```

    puis changez les variables par les valeurs appropriées.

4. **Générer la clé d'application**
    ```bash
    php artisan key:generate
    ```
5. **Configurer la base de données**
   Ouvrez le fichier `.env` et modifiez les lignes suivantes avec vos informations de connexion à votre base de données MySQL :
    ```env
    DB_DATABASE=nom_de_ta_base
    DB_USERNAME=root
    DB_PASSWORD=motdepasse
    ```
6. **Configurz l'envoi de mails**

    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=votre-utilisateur
    MAIL_PASSWORD="votre-mot-de-passe-application-google"
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=adresse@destinataire.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```
7. **Lancer la commande pour migrer les tables de la base de données**
    ```bash
    php artisan migrate
    ```
8. **installer les packets node**
    ```bash
    npm install
    ```
10. **Modifier les comptes par défaut avant le lancement du projet** <br>
    Dans le fichier `app\Providers\UserServiceProvider.php`, veuillez modifier les comptes par défaut pour pouvoir valider les données de connexion.
9. **Lancer le serveur**
    ```bash
    composer run dev
    ```
    Accéder à l'application sur **http://localhost:8000**

## Conclusion

Ce projet a été réalisé en équipe dans un cadre pédagogique afin de mettre en pratique les notions essentielles du développement web avec Laravel : architecture MVC, manipulation de données via Eloquent, gestion des utilisateurs, sécurisation des accès et création d'interfaces fluides et ergonomiques.
---

👥 Projet réalisé par :  
- **SABI Céline**
- **OURO-BANG'NA Taoufik**
- **EKLU Charly**
- **MARDJA Liguili**

📅 Date : Avril 2025




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Suivi des Parcelles et Interventions Agricoles</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        :root {
            --primary: #2F855A;
            --primary-dark: #276749;
            --secondary: #38A169;
            --accent: #48BB78;
            --background: #F7FAFC;
            --text: #1A202C;
            --light-text: #4A5568;
            --very-light: #EDF2F7;
            --border: #CBD5E0;
            --shadow: rgba(0, 0, 0, 0.1);
            --success: #48BB78;
            --highlight: #FFC107;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text);
            background: var(--background);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(72, 187, 120, 0.03) 0%, rgba(72, 187, 120, 0.05) 90%),
                linear-gradient(120deg, rgba(240, 255, 244, 0.7) 0%, rgba(226, 242, 228, 0.8) 100%);
            background-attachment: fixed;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3.5rem 2.5rem 3rem;
            border-radius: 20px;
            margin-bottom: 3rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
            z-index: 0;
        }
        header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 40px;
            background: rgba(255, 255, 255, 0.05);
            z-index: 0;
            border-radius: 70% 70% 0 0;
        }
        .header-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }
        .logo-container {
            margin-left: 2rem;
            position: relative;
            z-index: 1;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        h1 {
            font-size: 2.8rem;
            margin-bottom: 1.2rem;
            position: relative;
            z-index: 1;
            font-weight: 700;
            line-height: 1.2;
        }
        .intro {
            font-size: 1.15rem;
            max-width: 700px;
            position: relative;
            z-index: 1;
            opacity: 0.9;
        }
        section {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.07);
            border-left: 6px solid var(--accent);
            transition: transform 0.3s ease;
        }
        section:hover {
            transform: translateY(-5px);
        }
        h2 {
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 1.8rem;
            border-bottom: 2px solid var(--very-light);
            padding-bottom: 0.8rem;
            position: relative;
        }
        h2::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 80px;
            height: 2px;
            background-color: var(--accent);
        }
        h3 {
            color: var(--secondary);
            font-size: 1.5rem;
            margin-top: 1.8rem;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
        }
        h3::before {
            content: '';
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: var(--accent);
            border-radius: 50%;
            margin-right: 12px;
        }
        h4 {
            color: var(--accent);
            font-size: 1.3rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        h4::before {
            content: '';
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: var(--accent);
            margin-right: 10px;
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        }
        p, li {
            margin-bottom: 0.8rem;
            color: var(--light-text);
        }
        ul, ol {
            padding-left: 1.8rem;
            margin-bottom: 1.8rem;
        }
        li {
            margin-bottom: 0.5rem;
            position: relative;
        }
        ul li::marker {
            color: var(--accent);
        }
        strong {
            color: var(--primary-dark);
            font-weight: 600;
        }
        code {
            background: var(--very-light);
            padding: 0.2rem 0.5rem;
            border-radius: 6px;
            font-family: 'Fira Code', 'Courier New', Courier, monospace;
            font-size: 0.9rem;
            color: var(--primary);
            display: block;
            margin: 1.2rem 0;
            padding: 1.2rem;
            border-left: 3px solid var(--accent);
            overflow-x: auto;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
            gap: 1.8rem;
            margin: 1.8rem 0;
        }
        .feature-card {
            background: var(--very-light);
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid var(--accent);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
            background: linear-gradient(to bottom right, var(--very-light), white);
        }
        .tech-section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.8rem;
            margin: 2rem 0;
        }
        .tech-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-top: 4px solid var(--accent);
        }
        .tech-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }
        .tech-title {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            position: relative;
            display: inline-block;
        }
        .tech-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 25%;
            width: 50%;
            height: 2px;
            background-color: var(--accent);
        }
        .tech-card ul {
            text-align: left;
            margin-top: 1rem;
        }
        .install-steps {
            counter-reset: step;
            margin: 2rem 0;
        }
        .install-step {
            background: white;
            border-radius: 12px;
            padding: 1.5rem 1.8rem 1.5rem 2.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        .install-step:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }
        .install-step::before {
            counter-increment: step;
            content: counter(step);
            position: absolute;
            left: -20px;
            top: calc(50% - 20px);
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .step-title {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }
        footer {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: white;
            padding: 3rem;
            text-align: center;
            border-radius: 16px;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: select partition 1;
        }
        footer::before, footer::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        footer::before {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -100px;
        }
        footer::after {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -50px;
        }
        .footer-content {
            position: relative;
            z-index: 1;
        }
        .team {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            margin: 2rem 0;
        }
        .member {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .member:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .date {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            margin-top: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        @media (max-width: 768px) {
            header {
                padding: 2rem 1.5rem;
                flex-direction: column;
            }
            .logo-container {
                margin: 0 0 1.5rem 0;
            }
            h1 {
                font-size: 1.8rem;
            }
            .container {
                padding: 1rem;
            }
            section {
                padding: 1.5rem;
            }
            .tech-section, .feature-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1>Système de Suivi des Parcelles et Interventions Agricoles</h1>
                <p class="intro">Ce projet Laravel est une application web permettant aux agriculteurs de gérer leurs parcelles agricoles et de suivre les différentes interventions effectuées (semis, arrosage, fertilisation, etc.). Ce TP a été réalisé dans un but pédagogique dans le cadre du cours intitulé <strong>outils de développement web</strong> avec Laravel.</p>
            </div>
            <div class="logo-container">
                <svg class="logo" width="120" height="120" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 5C12.8203 5 7 10.8203 7 18C7 23.3984 10.1016 27.7969 14.1016 32.3984C16.6016 34.8984 19.3984 37 20 37C20.6016 37 23.3984 34.8984 25.8984 32.3984C29.8984 27.7969 33 23.3984 33 18C33 10.8203 27.1797 5 20 5Z"
                        fill="#4CAF50" />
                    <path d="M20 10V23" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M13 18H27" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M12 25C14.5 23 19 23 20 28C21 23 25.5 23 28 25" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </header>
        <section>
            <h2>Fonctionnalités</h2>
            <h3>Utilisateur non authentifié</h3>
            <ul>
                <li>Accès à la page de connexion</li>
                <li>Demande de réinitialisation de mot de passe (formulaire + email)</li>
                <li>Réinitialisation du mot de passe via lien reçu par mail</li>
                <li>Redirection automatique vers la page de login s'il tente d'accéder à une page protégée</li>
            </ul>
            <h3>Utilisateur authentifié -- Agriculteur</h3>
            <div class="feature-grid">
                <div class="feature-card">
                    <h4>Accès et Profil</h4>
                    <ul>
                        <li>Accès sécurisé avec vérification email obligatoire</li>
                        <li>Gestion de son profil utilisateur (édition, mise à jour)</li>
                        <li>Affichage ds</li>
                    </ul>
                </div>
                <div class="feature-card">
                    <h4>Tableau de bord</h4>
                    <ul>
                        <li>Statistiques générales</li>
                        <li>Télécharger les informations relatives aux interventions sur des parcelles</li>
                        <li>Statistiques spécifiques à l'agriculteur</li>
                        <li>Graphiques des interventions</li>
                        <li>Visualisation des semis non encore arrosés</li>
                    </ul>
                </div>
            </div>
            <h4>Gestion des parcelles</h4>
            <ul>
                <li>Créer une nouvelle parcelle</li>
                <li>Modifier une parcelle existante</li>
                <li>Supprimer une parcelle (Tant qu'elle n'a pas encore été utilisée)</li>
                <li>Lister toutes les parcelles</li>
            </ul>
            <h4>Gestion des interventions (par type)</h4>
            <ul>
                <li><strong>Semis</strong> :
                    <ul>
                        <li>Créer, visualiser et modifier les semis</li>
                        <li>Historique des semis</li>
                    </ul>
                </li>
                <li><strong>Arrosage</strong>, <strong>Fertilisation</strong>, <strong>Récolte</strong></li>
            </ul>
            <h3>Administrateur</h3>
            <ul>
                <li>Accès sécurisé avec vérification email obligatoire</li>
                <li>Gestion des cultures :
                    <ul>
                        <li>Ajouter, modifier, supprimer des cultures</li>
                    </ul>
                </li>
                <li>Gestion des types de cultures :
                    <ul>
                        <li>Ajouter, modifier, supprimer des types</li>
                    </ul>
                </li>
                <li>Télécharger les informations relatives aux interventions sur des parcelles</li>
                <li>Gestion des utilisateurs (agriculteurs et administrarteurs) :
                    <ul>
                        <li>Lister, créer ou désctiver des comptes utilisateurs.</li>
                    </ul>
                </li>
            </ul>
            <h3>Vérification Email</h3>
            <ul>
                <li>Notification de vérification à l'inscription</li>
                <li>Possibilité de renvoyer une notification</li>
            </ul>
        </section>
        <section>
            <h2>Technologies utilisées</h2>
            <div class="tech-section">
                <div class="tech-card">
                    <div class="tech-title">Backend</div>
                    <ul>
                        <li>PHP 8.x</li>
                        <li>Laravel 12.x</li>
                        <li>Eloquent ORM</li>
                    </ul>
                </div>
                <div class="tech-card">
                    <div class="tech-title">Base de données</div>
                    <ul>
                        <li>MySQL</li>
                    </ul>
                </div>
                <div class="tech-card">
                    <div class="tech-title">Frontend</div>
                    <ul>
                        <li>Blade</li>
                        <li>Tailwind CSS</li>
                        <li>Chart.js</li>
                    </ul>
                </div>
                <div class="tech-card">
                    <div class="tech-title">Sécurité</div>
                    <ul>
                        <li>Middleware auth</li>
                        <li>Middleware verified</li>
                        <li>Middleware CheckRole</li>
                    </ul>
                </div>
                <div class="tech-card">
                    <div class="tech-title">Divers</div>
                    <ul>
                        <li>Leaflet.js</li>
                        <li>dompdf</li>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <h2>Installation du projet</h2>
            <h3>Prérequis</h3>
            <ul>
                <li>PHP 8.2</li>
                <li>Composer</li>
                <li>MySQL ou MariaDB</li>
                <li>Node.js & npm</li>
                <li>Un serveur local Xampp, Lampp ou Wamp</li>
            </ul>
            <h3>Étapes d'installation</h3>
            <div class="install-steps">
                <div class="install-step">
                    <div class="step-title">Cloner le dépôt</div>
                    <code>git clone https://github.com/taoufikOURO/Chaine-de-valeur-agricole-V-Taoufik.git

cd &lt;nom-du-dossier&gt;</code>

</div>
                <div class="install-step">
                    <div class="step-title">Installer les dépendances PHP</div>
                    <code>composer install</code>
                </div>
                <div class="install-step">
                    <div class="step-title">Créer le fichier d'environnement</div>
                    <p>Une fois le fichier créer, copiez le contenu du fichier <code>.env.example</code> dans le fichier <code>.env</code> et remplacez les variables par les valeurs appropriées.</p>
                    <p>Si vous êtes sur Mac ou Linux, utilisez la commande suivante :</p>
                    <code>touch .env

cp .env.example .env</code>

</div>
                <div class="install-step">
                    <div class="step-title">Générer la clé d'application</div>
                    <code>php artisan key:generate</code>
                </div>
                <div class="install-step">
                    <div class="step-title">Configurer la base de données</div>
                    <p>Ouvrez le fichier <code>.env</code> et modifiez les lignes suivantes :</p>
                    <code>DB_DATABASE=nom_de_ta_base

DB_USERNAME=root
DB_PASSWORD=motdepasse</code>

</div>
                <div class="install-step">
                    <div class="step-title">Configurer l'envoi de mails</div>
                    <code>MAIL_MAILER=smtp<br>
MAIL_HOST=smtp.gmail.com<br>
MAIL_PORT=587<br>
MAIL_USERNAME=votre-utilisateur<br>
MAIL_PASSWORD="votre-mot-de-passe-application-google"<br>
MAIL_ENCRYPTION=tls<br>
MAIL_FROM_ADDRESS=adresse@destinataire.com<br>
MAIL_FROM_NAME="${APP_NAME}"<br></code>
</div>
                <div class="install-step">
                    <div class="step-title">Migrer les tables de la base de données</div>
                    <code>php artisan migrate</code>
                </div>
                <div class="install-step">
                    <div class="step-title">Installer les packets node</div>
                    <code>npm install</code>
                </div>
                <div class="install-step">
                    <div class="step-title">Modifier les comptes par défaut</div>
                    <p>Dans le fichier <code>app\Providers\UserServiceProvider.php</code>, veuillez modifier les comptes par défaut pour pouvoir valider les données de connexion.</p>
                </div>
                <div class="install-step">
                    <div class="step-title">Lancer le serveur</div>
                    <code>composer run dev</code>
                    <p>Accéder à l'application sur <strong>http://localhost:8000</strong></p>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer-content">
                <h2 style="color: white; border-bottom: 1px solid rgba(255,255,255,0.2);">Conclusion</h2>
                <p style="color: rgba(255,255,255,0.9);">Ce projet a été réalisé en équipe dans un cadre pédagogique afin de mettre en pratique les notions essentielles du développement web avec Laravel : architecture MVC, manipulation de données via Eloquent, gestion des utilisateurs, sécurisation des accès et création d'interfaces fluides et ergonomiques.</p>
                <h3 style="color: white; margin-top: 2.5rem;">Projet réalisé par</h3>
                <div class="team">
                    <div class="member">SABI Céline</div>
                    <div class="member">OURO-BANG'NA Taoufik</div>
                    <div class="member">EKLU Charly</div>
                    <div class="member">MARDJA Liguili</div>
                </div>
                <div class="date">Avril 2025</div>
                <div style="margin-top: 2rem;">
                    <svg class="logo" width="70" height="70" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 5C12.8203 5 7 10.8203 7 18C7 23.3984 10.1016 27.7969 14.1016 32.3984C16.6016 34.8984 19.3984 37 20 37C20.6016 37 23.3984 34.8984 25.8984 32.3984C29.8984 27.7969 33 23.3984 33 18C33 10.8203 27.1797 5 20 5Z"
                            fill="white" />
                        <path d="M20 10V23" stroke="#2F855A" stroke-width="2" stroke-linecap="round" />
                        <path d="M13 18H27" stroke="#2F855A" stroke-width="2" stroke-linecap="round" />
                        <path d="M12 25C14.5 23 19 23 20 28C21 23 25.5 23 28 25" stroke="#2F855A" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>

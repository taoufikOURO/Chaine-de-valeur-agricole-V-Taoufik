<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Traçabilité Professionnelle')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminTemplate.css') }}">
    <link rel="icon" type="image/svg" href="{{ asset('logo.svg') }}">
</head>

<body class="bg-gray-50">
    <button class="mobile-menu-btn" id="mobile-menu-btn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="overlay" id="overlay"></div>

    <div class="sidebar shadow-sm" id="sidebar">
        <div class="logo-container">
            <div id="toggle-btn" data-tooltip="Réduire le menu" class=" cursor-pointer">
                @include('components.logo')
            </div>
            <span class="logo-text">MON APPLI</span>
        </div>

        <div class="sidebar-content">
            <nav class="mt-6">
                <a href="#" class="nav-item active">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-text">Tableau de bord</span>
                </a>
                <div class="section-title">Parcelles</div>
                <a href="#" class="nav-item">
                    <i class="fa-brands fa-buromobelexperte"></i>
                    <span class="nav-text">Liste des parcelles</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-plus"></i>
                    <span class="nav-text">Ajouter une parcelle</span>
                </a>

                <div class="section-title">Cultures et types de culture</div>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-leaf"></i>
                    <span class="nav-text">Liste des cultures</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-plus"></i>
                    <span class="nav-text">Ajouter une culture</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-leaf"></i>
                    <span class="nav-text">Liste des types de culture</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-plus"></i>
                    <span class="nav-text">Ajouter un type de culture</span>
                </a>

                <div class="section-title">Actions sur parcelles</div>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-wheat-awn"></i>
                    <span class="nav-text">Liste des semis</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-plus"></i>
                    <span class="nav-text">Effectuer un semis</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-droplet"></i>
                    <span class="nav-text">Arroser un semis</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-warehouse"></i>
                    <span class="nav-text">Recolter un semis</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-list"></i>
                    <span class="nav-text">Liste des recoltes</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-poop"></i>
                    <span class="nav-text">Fertiliser un champ</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-list"></i>
                    <span class="nav-text">Liste des fertilisations</span>
                </a>

                <div class="section-title">Utilisateurs</div>

                <a href="#" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span class="nav-text">Liste des utilisateurs</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="nav-text">Ajouter un utilisateur</span>
                </a>
            </nav>
        </div>
    </div>

    <div class="main-content">
        <header class="header px-6 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800"> @yield('title', 'Taoufik,noublie pas de completer le titre')</h1>

            <div class="flex items-center gap-4">

                <div class="dropdown-wrapper">
                    <button class="flex items-center gap-2 cursor-pointer" id="profile-btn">
                        <div class="w-9 h-9 rounded-full bg-agri-green-100 flex items-center justify-center">
                            <i class="fas fa-user text-agri-green-500"></i>
                        </div>
                        <span class="text-sm font-medium hidden md:block">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</span>
                        <i class="fas fa-chevron-down text-xs text-gray-500 hidden md:block"></i>
                    </button>

                    <div class="dropdown-content" id="profile-dropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user-circle"></i>
                            <span>Mon profil</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item w-full cursor-pointer" type="submit" id="logout-button">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-area">
            @yield('content')
        </div>
    </div>
    @include('components.confirmation-modal', [
        'title' => 'Confirmer la déconnexion',
        'message' => 'Êtes-vous sûr de vouloir vous déconnecter ?',
        'confirmText' => 'Déconnexion',
        'cancelText' => 'Annuler',
    ])

    <script src="{{ asset('js/adminTemplate.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');
            const modal = document.getElementById('formConfirmationModal');
            const confirmButton = document.getElementById('confirmFormSubmission');
            const cancelButton = document.getElementById('cancelFormSubmission');
            const closeButtons = document.querySelectorAll('.modal-close');

            // Show modal when logout button is clicked
            logoutButton.addEventListener('click', function(e) {
                e.preventDefault();
                modal.classList.remove('hidden');
            });

            // Submit form when confirm button is clicked
            confirmButton.addEventListener('click', function() {
                logoutForm.submit();
            });

            // Hide modal when cancel button is clicked
            cancelButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Hide modal when close button is clicked
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
            });

            // Hide modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal-backdrop')) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
    <script src="{{ asset('js/adminTemplate.js') }}"></script>
</body>

</html>

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
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="icon" type="image/svg" href="{{ asset('logo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <button class="mobile-menu-btn" id="mobile-menu-btn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="overlay" id="overlay"></div>

    <div class="sidebar shadow-sm" id="sidebar">
        <div class="logo-container">
            <div id="toggle-btn" data-tooltip="Réduire le menu" class="cursor-pointer">
                @include('components.logo')
            </div>
            <h1 class="logo-text text-3xl font-extrabold tracking-tight text-gray-900 flex items-center gap-3 md:block">
                <span class="bg-gradient-to-r from-green-700 to-lime-600 bg-clip-text text-transparent">
                    Agro Tracker
                </span>
            </h1>
        </div>

        <div class="sidebar-content">
            <nav class="mt-6">
                <div class="section-title">Analyses</div>
                <a href="{{ route('dashboard') }}" class="nav-item @if (Route::current()->uri() == 'dashboard') active @endif ">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-text">Tableau de bord</span>
                </a>
                <a href="{{ route('charts') }}" class="nav-item @if (Route::current()->uri() == 'dashboard/charts') active @endif ">
                    <i class="fas fa-chart-simple"></i>
                    <span class="nav-text">Graphes</span>
                </a>
                @if (Auth::user()->role->libelle === 'agriculteur')
                    <a href="{{ route('semisNonArroses') }}"
                        class="nav-item flex items-center justify-between gap-2 @if (Route::currentRouteName() == 'semisNonArroses') active @endif">

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-sun-plant-wilt"></i>
                            <span class="nav-text">Semis non arrosés</span>
                        </div>
                    </a>
                @endif
                @if (Auth::user()->role->libelle === 'agriculteur')
                    <div class="section-title">Parcelles</div>
                    <a href="{{ route('parcelle.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'parcelle') active @endif ">
                        <i class="fa-brands fa-buromobelexperte"></i>
                        <span class="nav-text">Liste des parcelles</span>
                    </a>
                    <a href="{{ route('parcelle.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'parcelle/create') active @endif ">
                        <i class="fa-solid fa-plus"></i>
                        <span class="nav-text">Ajouter une parcelle</span>
                    </a>
                @endif

                @if (Auth::user()->role->libelle === 'admin')
                    <div class="section-title">Cultures et types de culture</div>
                    <a href="{{ route('culture.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'culture') active @endif ">
                        <i class="fa-solid fa-seedling"></i>
                        <span class="nav-text">Liste des cultures</span>
                    </a>
                    <a href="{{ route('culture.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'culture/create') active @endif">
                        <i class="fa-solid fa-plus"></i>
                        <span class="nav-text">Ajouter une culture</span>
                    </a>
                    <a href="{{ route('type-culture.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'type-culture') active @endif">
                        <i class="fa-solid fa-leaf"></i>
                        <span class="nav-text">Liste des types de culture</span>
                    </a>
                    <a href="{{ route('type-culture.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'type-culture/create') active @endif">
                        <i class="fa-solid fa-plus"></i>
                        <span class="nav-text">Ajouter un type de culture</span>
                    </a>
                @endif
                @if (Auth::user()->role->libelle === 'agriculteur')
                    <div class="section-title">Actions sur parcelles</div>
                    <a href="{{ route('semis.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'semis') active @endif">
                        <i class="fa-solid fa-wheat-awn"></i>
                        <span class="nav-text">Liste des semis</span>
                    </a>
                    <a href="{{ route('semis.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'semis/create') active @endif">
                        <i class="fa-solid fa-plus"></i>
                        <span class="nav-text">Effectuer un semis</span>
                    </a>
                    <a href="{{ route('arrosage.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'arrosage/create') active @endif">
                        <i class="fa-solid fa-droplet"></i>
                        <span class="nav-text">Arroser un semis</span>
                    </a>
                    <a href="{{ route('recolte.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'recolte/create') active @endif">
                        <i class="fa-solid fa-warehouse"></i>
                        <span class="nav-text">Recolter un semis</span>
                    </a>
                    <a href="{{ route('recolte.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'recolte') active @endif">
                        <i class="fa-solid fa-list"></i>
                        <span class="nav-text">Liste des recoltes</span>
                    </a>
                    <a href="{{ route('fertilisation.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'fertilisation/create') active @endif">
                        <i class="fa-solid fa-poop"></i>
                        <span class="nav-text">Fertiliser un champ</span>
                    </a>
                    <a href="{{ route('fertilisation.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'fertilisation') active @endif">
                        <i class="fa-solid fa-list"></i>
                        <span class="nav-text">Liste des fertilisations</span>
                    </a>
                @endif

                @if (Auth::user()->role->libelle === 'admin')
                    <div class="section-title">Utilisateurs</div>

                    <a href="{{ route('user.index') }}"
                        class="nav-item @if (Route::current()->uri() == 'user') active @endif">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Liste des utilisateurs</span>
                    </a>
                    <a href="{{ route('user.create') }}"
                        class="nav-item @if (Route::current()->uri() == 'user/create') active @endif">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="nav-text">Ajouter un utilisateur</span>
                    </a>
                @endif
                @if (Auth::user()->role->libelle === 'agriculteur')
                    <div class="section-title">Historique</div>
                    <a href="{{ route('historique.semis') }}"
                        class="nav-item @if (Route::current()->uri() == 'historique/semis') active @endif">
                        <i class="fa-solid fa-wheat-awn"></i>
                        <span class="nav-text">Historique des semis</span>
                    </a>
                @endif
            </nav>
        </div>
    </div>

    <div class="main-content">
        <header class="header px-6 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800"></h1>

            <div class="flex items-center gap-4">

                <div class="dropdown-wrapper">
                    <button class="flex items-center gap-2 cursor-pointer" id="profile-btn">
                        <h1
                            class="text-sm font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4 md:block">
                            <span class="border-l-4 border-green-500 pl-4">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}</span>
                        </h1>
                    </button>

                    <div class="dropdown-content" id="profile-dropdown">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fas fa-user-circle"></i>
                            <span>Mon profil</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}"
                            id="edit-profile-button">
                            <i class="fas fa-pen-to-square"></i>
                            <span>Editer le profil</span>
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
    <script src="{{ asset('js/adminTemplate.js') }}"></script>
</body>

</html>

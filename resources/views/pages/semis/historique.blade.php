@extends('layout.layout')
@section('title', 'Liste des types de culture')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/type-culture/index.css') }}">
@section('title', 'Historique des semis')

@section('content')
    @if (session('showSuccessModal'))
        @include('components.success-modal')
    @endif
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif

    <body class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center">
                        Historique des semis
                    </h1>
                    <p class="text-emerald-600 font-medium ml-16">visualiser tout mes semis qui ont déjà été récoltés</p>
                </div>
            </div>

            <!-- Filtres et recherche -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
                <div class="flex flex-col sm:flex-row gap-5 justify-between items-start sm:items-center">
                    <div class="search-container w-full">
                        <div class="search-icon">
                            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.5 17.5L12.5 12.5M14.1667 8.33333C14.1667 11.555 11.555 14.1667 8.33333 14.1667C5.11167 14.1667 2.5 11.555 2.5 8.33333C2.5 5.11167 5.11167 2.5 8.33333 2.5C11.555 2.5 14.1667 5.11167 14.1667 8.33333Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <input type="text" id="searchInput" class="search-input"
                            placeholder="Rechercher par le nom de la culture..." autocomplete="off">
                    </div>
                </div>
            </div>

            <!-- Tableau de données -->
            <div class="table-container animate-fade-in">
                <table class="data-table">
                    <thead class="bg-emerald-600">
                        <tr>
                            <th class="w-1/6">Date</th>
                            <th class="w-1/6">Culture</th>
                            <th class="w-1/6">Parcelle</th>
                            <th class="w-1/6">Nombre d'arrosage</th>
                            <th class="w-1/6">Date récolte</th>
                            <th class="w-1/6">Quantité récoltée</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($semis as $item)
                            <tr class="transition-all duration-300 ease-in-out">
                                <td>
                                    {{ $item->date_semis }}
                                </td>
                                <td>{{ $item->culture->nom }} | <span
                                        class="text-green-500">{{ $item->culture->typeCulture->libelle }}</span> </td>
                                <td>{{ $item->parcelle->nom }} <span class="text-green-500">|</span>
                                    {{ $item->parcelle->surface }} hectares</td>
                                <td>
                                    {{ $item->arrosage_count }}
                                </td>
                                <td>
                                    {{ $item->recolte->date_recolte }}
                                </td>
                                <td>
                                    {{ $item->recolte->quantite_recolte }}T
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- État vide (s'affiche lorsqu'aucun résultat ne correspond à la recherche) -->
            <div id="emptyState" class="empty-state mt-6">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-800 mb-2">Aucun résultat trouvé</h3>
                <p class="text-gray-500">Aucune donnée ne correspond à votre recherche.</p>
            </div>

            <div class="mt-5 text-sm text-gray-600 flex justify-between items-center">
                {{$semis->links('pagination::tailwind')}}
            </div>
        </div>
        <script src="{{ asset('js/type-culture/index.js') }}"></script>
    </body>
@endsection

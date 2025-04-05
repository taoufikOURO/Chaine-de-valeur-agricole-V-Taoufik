@extends('layout.layout')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/type-culture/index.css') }}">

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
                        Liste de vos récoltes
                    </h1>
                    <p class="text-emerald-600 font-medium ml-16">Visualiser vos récoltes</p>
                </div>
            </div>

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
                        <input type="text" id="searchInput" class="search-input" placeholder="Rechercher par le nom de la culture..."
                            autocomplete="off">

                    </div>
                    <a href="{{ route('recolte.create') }}"
                        class="cursor-pointer group relative flex items-center gap-3 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white py-2.5 px-5 rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg overflow-hidden font-medium">
                        <span
                            class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transform -translate-x-full group-hover:translate-x-full transition-all duration-1000 ease-out"></span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 transition-transform duration-300 group-hover:rotate-90" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <span class="relative z-10">Ajouter</span>
                    </a>
                </div>
            </div>

            <!-- Tableau de données -->
            <div class="table-container animate-fade-in">
                <table class="data-table">
                    <thead class="bg-emerald-600">
                        <tr>
                            <th class="w-1/6">Date</th>
                            <th class="w-2/6">Culture</th>
                            <th class="w-1/6">Quantite</th>
                            <th class="w-2/6">Parcelle</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($recoltes as $recolte)
                            <tr class="transition-all duration-300 ease-in-out">
                                <td>{{ $recolte->date_recolte}}</td>
                                <td>{{ $recolte->semis->culture->nom }}</td>
                                <td>{{ $recolte->quantite_recolte }} T</td>
                                <td>{{ $recolte->parcelle->nom }} | {{ $recolte->parcelle->surface }}m²</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- État vide (s'affiche lorsqu'aucun résultat ne correspond à la recherche) -->
            <div id="emptyState" class="empty-state mt-6">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-800 mb-2">Aucun résultat trouvé</h3>
                <p class="text-gray-500">Aucune donnée ne correspond à votre recherche.</p>
            </div>

            <!-- Information sur le nombre de résultats -->
            <div class="mt-5 text-sm text-gray-600 flex justify-between items-center">
                <p id="resultCount" class="font-medium">Affichage de 0 entrées</p>
            </div>
        </div>
        <script src="{{ asset('js/type-culture/index.js') }}"></script>

        @include('components.confirmation-modal', [
            'title' => 'Confirmer la suppression',
            'message' => 'Êtes-vous sûr de vouloir supprimer cet élément ?',
            'confirmText' => 'Supprimer',
            'cancelText' => 'Annuler',
        ])

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('formConfirmationModal');
                const confirmButton = document.getElementById('confirmFormSubmission');
                const cancelButton = document.getElementById('cancelFormSubmission');
                const closeButtons = document.querySelectorAll('.modal-close');

                let deleteForm = null;

                document.querySelectorAll('.deleteButton').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        let itemId = this.getAttribute('data-id');
                        deleteForm = document.getElementById('deleteForm-' +
                            itemId);
                        modal.classList.remove('hidden');
                    });
                });

                confirmButton.addEventListener('click', function() {
                    if (deleteForm) {
                        deleteForm.submit();
                    }
                });

                cancelButton.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });

                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        modal.classList.add('hidden');
                    });
                });

                modal.addEventListener('click', function(e) {
                    if (e.target.classList.contains('modal-backdrop')) {
                        modal.classList.add('hidden');
                    }
                });
            });
        </script>
    </body>
@endsection

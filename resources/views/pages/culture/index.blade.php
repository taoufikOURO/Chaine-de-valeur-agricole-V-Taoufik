@extends('layout.layout')
@section('title', 'Liste des cultures')

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
                        Liste des types de cultures
                    </h1>
                    <p class="text-emerald-600 font-medium ml-16">Visualiser vos cultures</p>
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
                        <input type="text" id="searchInput" class="search-input" placeholder="Rechercher par le nom..."
                            autocomplete="off">

                    </div>
                    <a href="{{ route('culture.create') }}"
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
                            <th class="w-2/6">Code</th>
                            <th class="w-1/6">Nom</th>
                            <th class="w-1/6">Type de culture</th>
                            <th class="w-2/6">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($cultures as $culture)
                            <tr class="transition-all duration-300 ease-in-out">
                                <td>
                                    <span class="code-cell">{{ $culture->code }}</span>
                                </td>
                                <td>{{ $culture->nom }}</td>
                                <td>{{ $culture->typeCulture->libelle }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <form action="{{ route('culture.edit', $culture->id) }}" method="GET">
                                            @csrf
                                            <button type="submit"
                                                class="cursor-pointer group relative flex items-center gap-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-2.5 px-5 rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg overflow-hidden font-medium">
                                                <span
                                                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transform -translate-x-full group-hover:translate-x-full transition-all duration-1000 ease-out"></span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 transition-transform duration-300 group-hover:rotate-12"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                    </path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                    </path>
                                                </svg>
                                                <span class="relative z-10">Modifier</span>
                                            </button>
                                        </form>
                                        <form id="deleteForm-{{ $culture->id }}"
                                            action="{{ route('culture.destroy', $culture->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button data-id="{{ $culture->id }}" type="submit"
                                                class="cursor-pointer group relative flex items-center gap-3 bg-gradient-to-r from-red-500 to-red-600 text-white py-2.5 px-5 rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg overflow-hidden font-medium deleteButton">
                                                <span
                                                    class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white to-transparent opacity-0 group-hover:opacity-20 transform -translate-x-full group-hover:translate-x-full transition-all duration-1000 ease-out"></span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 transition-transform duration-300 group-hover:-translate-y-1"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>
                                                <span class="relative z-10">Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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


            <div class="mt-5 text-sm text-gray-600 flex justify-between items-center">
                {{$cultures->links('pagination::tailwind')}}
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

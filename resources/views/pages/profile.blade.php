@extends('layout.layout')

@section('title', 'Profile')

@section('content')


    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="{{ asset('js/profile.js') }}"></script>


    <body class="min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-8">
        <!-- Motifs décoratifs -->
        <div class="absolute inset-0 subtle-pattern opacity-40"></div>

        <!-- Décorations SVG -->
        <svg class="card-decoration leaf-pattern-top-right" viewBox="0 0 160 160" fill="none">
            <path d="M80 10C121.421 10 155 43.5786 155 85C155 126.421 121.421 160 80 160" stroke="currentColor"
                stroke-width="8" />
            <path d="M80 25C113.137 25 140 51.8629 140 85C140 118.137 113.137 145 80 145" stroke="currentColor"
                stroke-width="6" />
            <path d="M80 40C104.853 40 125 60.1472 125 85C125 109.853 104.853 130 80 130" stroke="currentColor"
                stroke-width="4" />
            <path d="M80 60C93.8071 60 105 71.1929 105 85C105 98.8071 93.8071 110 80 110" stroke="currentColor"
                stroke-width="3" />
        </svg>

        <svg class="card-decoration leaf-pattern-bottom-left" viewBox="0 0 160 160" fill="none">
            <path d="M80 10C121.421 10 155 43.5786 155 85C155 126.421 121.421 160 80 160" stroke="currentColor"
                stroke-width="8" />
            <path d="M80 25C113.137 25 140 51.8629 140 85C140 118.137 113.137 145 80 145" stroke="currentColor"
                stroke-width="6" />
            <path d="M80 40C104.853 40 125 60.1472 125 85C125 109.853 104.853 130 80 130" stroke="currentColor"
                stroke-width="4" />
            <path d="M80 60C93.8071 60 105 71.1929 105 85C105 98.8071 93.8071 110 80 110" stroke="currentColor"
                stroke-width="3" />
        </svg>

        <div class="relative z-10 p-6 sm:p-8 md:p-10 grid md:grid-cols-3 gap-8">
            <!-- Colonne de gauche avec avatar et badges -->
            <div class="md:col-span-1 flex flex-col items-center md:items-start">
                <div class="avatar-circle w-32 h-32 sm:w-40 sm:h-40 rounded-full text-4xl sm:text-5xl mb-6">
                    {{ Auth::user()->first_name[0] }}{{ Auth::user()->last_name[0] }}
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-1 text-center md:text-left">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>

                <div class="flex items-center text-gray-600 mb-6">
                    <svg class="w-5 h-5 mr-2 text-agri-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="text-lg font-medium">@ {{ Auth::user()->username }}</span>
                </div>

                <div class="flex flex-col gap-3 w-full">

                    @if (Auth::user()->role_id == 1)
                        <!-- Badge admin -->
                        <div
                            class="badge flex items-center px-5 py-3 rounded-xl bg-agri-green-700 text-white shadow-badge cursor-pointer">
                            <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none">
                                <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                    stroke="currentColor" stroke-width="2" />
                                <path d="M12 2V4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M12 20V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M4 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M22 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <div>
                                <div class="text-sm opacity-70">Privilèges</div>
                                <div class="font-semibold">Administrateur</div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->role_id == 2)
                        <div
                            class="badge flex items-center px-5 py-3 rounded-xl bg-agri-green-100 text-agri-green-700 shadow-badge cursor-pointer">
                            <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M15 6.5C15 8.98528 12.9853 11 10.5 11C8.01472 11 6 8.98528 6 6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5Z"
                                    stroke="currentColor" stroke-width="2" />
                                <path
                                    d="M3 19.5C3 16.1863 6.03834 13.5 9.8 13.5H11.2C14.9617 13.5 18 16.1863 18 19.5V20C18 21.1046 17.1046 22 16 22H5C3.89543 22 3 21.1046 3 20V19.5Z"
                                    stroke="currentColor" stroke-width="2" />
                                <path d="M18 14L20 14C21.1046 14 22 14.8954 22 16V18C22 19.1046 21.1046 20 20 20H19"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path
                                    d="M16.5 9.5C16.5 8.11929 17.6193 7 19 7C20.3807 7 21.5 8.11929 21.5 9.5C21.5 10.8807 20.3807 12 19 12"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <div>
                                <div class="text-sm opacity-70">Statut</div>
                                <div class="font-semibold">Agriculteur</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Colonne de droite avec informations -->
            @if (Auth::user()->role_id == 2)
                <div class="md:col-span-2">
                    <div class="section-divider mb-8"></div>
                    <div class="section-divider mb-8"></div>
                    <!-- Section de culture -->
                    <h2 class="text-xl font-semibold text-gray-800 mb-5">Principales cultures</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($semis as $item)
                            <span
                                class="px-3 py-1 bg-agri-green-100 text-agri-green-700 rounded-full text-sm">{{ $item->culture->nom }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </body>

@endsection

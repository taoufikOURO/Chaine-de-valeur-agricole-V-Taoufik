<link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --agri-green-500: #7aad7a;
    }

    body {
        font-family: 'SF Pro Display', sans-serif;
    }

    .sidebar-expanded {
        width: 250px;
    }

    .sidebar-collapsed {
        width: 80px;
    }

    input:focus,
    select:focus {
        outline: none;
    }

    input,
    select {
        padding: 0.875rem 1rem 0.875rem 2.5rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        width: 100%;
        transition: all 0.25s ease;
        background-color: white;
        font-size: 0.95rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: var(--agri-green-500);
        box-shadow: 0 0 0 4px rgba(122, 173, 122, 0.12);
    }
</style>
@extends('layout.layout')
@section('title', 'Editer le profile')

@section('content')
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif

    <body class="bg-gray-50">
        <div class="flex min-h-screen">

            <div class="flex-1 p-8 bg-gradient-to-br">
                <div class="max-w-4xl mx-auto">
                    <div class="mb-8 flex justify-between items-center">
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center">
                                Editer son profile
                            </h1>
                            <p class="text-emerald-600 font-medium ml-16">Modifier les informations de votre compte.</p>
                            </p>
                        </div>
                    </div>
                    <!-- Enhanced Form -->
                    <form action="{{ route('profile.update', $user->id) }}" method="POST"
                        class="space-y-8 bg-white rounded-2xl shadow-[0_10px_40px_-15px_rgba(6,95,70,0.1)] p-8">
                        @csrf
                        @method('PUT')

                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1 ml-2">Nom
                            d'utilisateur</label>
                        <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-xl p-1 shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-circle-user  text-gray-400 mr-2 ml-2"></i>
                            </div>
                            <input type="text" required name="username" value="{{ $user->username }}"
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200"
                                placeholder="Nom d'utilisateur">
                        </div>
                        @error('username')
                            <div id="libelle-error" class="text-red-500 font-bold text-xs mt-[-15px] text-center">
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1 ml-2">Nom</label>
                        <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-xl p-1 shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-person  text-gray-400 mr-2 ml-2"></i>
                            </div>
                            <input type="text" required name="last_name" value="{{ $user->last_name }}"
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200"
                                placeholder="Veuillez entrer votre nom">
                        </div>
                        @error('last_name')
                            <div id="libelle-error" class="text-red-500 font-bold text-xs mt-[-15px] text-center">
                                {{ $message }}
                            </div>
                        @enderror

                        <label for="email" class="block text-sm font-medium text-gray-400 mb-1 ml-2">Prénom</label>
                        <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-xl p-1 shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-person  text-gray-400 mr-2 ml-2"></i>
                            </div>
                            <input type="text" required name="first_name" value="{{ $user->first_name }}"
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200"
                                placeholder="Veuillez entrer votre prénom">
                        </div>
                        @error('first_name')
                            <div id="libelle-error" class="text-red-500 font-bold text-xs mt-[-15px] text-center">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit"
                            class=" mt-5 w-full group relative overflow-hidden bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl px-4 py-5 font-medium hover:from-emerald-700 hover:to-emerald-800 transition duration-300 shadow-lg hover:shadow-emerald-200/50 cursor-pointer">
                            <div class="absolute inset-0 bg-white/10 group-hover:bg-white/0 transition duration-300"></div>
                            <i class="fas fa-plus-circle mr-2"></i>
                            <span class="relative">Enregistrer</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection

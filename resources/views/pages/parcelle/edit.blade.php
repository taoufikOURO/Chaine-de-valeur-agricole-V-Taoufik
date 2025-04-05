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

    input:focus {
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


@section('content')
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif

    <body class="bg-gray-50">
        <div class="flex min-h-screen">

            <div class="flex-1 p-8 bg-gradient-to-br from-green-50/50 to-emerald-100/50">
                <div class="max-w-4xl mx-auto">
                    <div class="mb-8 flex justify-between items-center">
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center">
                                <span class="bg-emerald-100 text-emerald-800 p-3 rounded-2xl mr-4">
                                    @include('components.logo')
                                </span>
                                Modifier une parcelle
                            </h1>
                            <p class="text-emerald-600 font-medium ml-16">Modifier la parcelle {{ $parcelle->nom }}</p>
                        </div>
                    </div>

                    <!-- Enhanced Form -->
                    <form action="{{ route('parcelle.update', $parcelle->id) }}" method="POST"
                        class="space-y-8 bg-white rounded-2xl shadow-[0_10px_40px_-15px_rgba(6,95,70,0.1)] p-8">
                        @csrf
                        @method('PUT')
                        <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-xl p-1 shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag mr-2 text-gray-400"></i>
                            </div>
                            <input type="text" required name="nom" required value="{{ $parcelle->nom }}"
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200"
                                placeholder="Nom de la parcelle">
                        </div>
                        @error('nom')
                            <span id="nom-error" class="text-red-500 text-xs mb-5">
                                {{ $message }}
                            </span>
                        @enderror

                        <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-xl p-1 shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-layer-group mr-2 text-gray-400"></i>
                            </div>
                            <input type="number" required name="surface" required value="{{ $parcelle->surface }}"
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200"
                                placeholder="Donner la surface de la parcelle en m²">
                        </div>
                        @error('adresse')
                            <span id="nom-error" class="text-red-500 text-xs mb-5">
                                {{ $message }}
                            </span>
                        @enderror

                        <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-xl p-1 shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-location-dot mr-2 text-gray-400"></i>
                            </div>
                            <input type="text" required name="adresse" required value="{{ $parcelle->adresse }}"
                                class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200"
                                placeholder="Adresse de la parcelle">
                        </div>
                        @error('adresse')
                            <span id="nom-error" class="text-red-500 text-xs mb-5">
                                {{ $message }}
                            </span>
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

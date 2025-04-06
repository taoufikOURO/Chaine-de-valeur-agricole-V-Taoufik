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

@section('title', 'Créer un type de culture')

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
                                Modifier un utilisateur
                            </h1>
                            <p class="text-emerald-600 font-medium ml-16">Modifier le compte utilisateur de:
                                {{ $user->first_name }} {{ $user->last_name }}
                            </p>
                        </div>
                    </div>
                    <!-- Enhanced Form -->
                    <form action="{{ route('user.update', $user->id) }}" method="POST"
                        class="space-y-8 bg-white rounded-2xl shadow-[0_10px_40px_-15px_rgba(6,95,70,0.1)] p-8">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center justify-between bg-gradient-to-b from-white to-gray-50 rounded-xl p-4 shadow-inner">
                            <label for="active" class="text-gray-800 font-medium">Activer le compte utilisateur</label>

                            <!-- Champ caché pour forcer la valeur à 0 si décoché -->
                            <input type="hidden" name="active" value="0">

                            <!-- Switch -->
                            <label for="active" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="active" value="1" id="active"
                                    class="sr-only peer" {{ old('active', $user->active) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-300 rounded-full peer-checked:bg-emerald-500 transition-all duration-300"></div>
                                <div
                                    class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full shadow-md transform peer-checked:translate-x-full transition-transform duration-300">
                                </div>
                            </label>
                        </div>

                        <select type="text" required name="role_id"
                            class="w-full pl-10 pr-4 py-3.5 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:border bg-transparent transition duration-200">
                            <option value="" disabled selected> Veuillez sélectionnez le role de votre utilisateur
                            </option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->libelle }}</option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class=" mt-5 w-full group relative overflow-hidden bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl px-4 py-5 font-medium hover:from-emerald-700 hover:to-emerald-800 transition duration-300 shadow-lg hover:shadow-emerald-200/50 cursor-pointer">
                            <div class="absolute inset-0 bg-white/10 group-hover:bg-white/0 transition duration-300"></div>
                            <i class="fas fa-plus-circle mr-2"></i>
                            <span class="relative">Modifier</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection

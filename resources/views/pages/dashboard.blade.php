@extends('layout.layout')

@section('title', 'Tableau de bord')

@section('content')
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif

    @if (Auth::user()->role->libelle === 'admin')
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-full flex items-center justify-center bg-green-100 text-green-600 hover:bg-green-200 transition-colors duration-300">
                <i class="fas fa-users text-xl"></i>
            </div>
            <span class="border-l-4 border-green-500 pl-4">Utilisateurs</span>
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
            {{-- Utilisateurs --}}
            <div
                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Utilisateurs</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">
                            {{ $stats['users']['total'] }}</h3>
                    </div>
                    <div
                        class="rounded-full p-3 bg-green-100 text-green-600 group-hover:bg-green-200 transition-colors duration-300">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex text-sm">
                        <div class="flex items-center text-gray-500">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
                            <span>Actifs: {{ $stats['users']['active'] }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 ml-4">
                            <span class="inline-block w-2 h-2 rounded-full bg-gray-300 mr-1"></span>
                            <span>Inactifs: {{ $stats['users']['inactive'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Administrateurs --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-300 to-indigo-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Administrateurs</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['users']['admins']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-indigo-100 text-indigo-600">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex text-sm">
                        <div class="flex items-center text-gray-500">
                            <i class="fas fa-circle text-xs text-indigo-500 mr-1"></i>
                            <span>Actifs: {{ $stats['users']['admins']['active'] }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 ml-4">
                            <i class="fas fa-circle text-xs text-indigo-300 mr-1"></i>
                            <span>Inactifs: {{ $stats['users']['admins']['inactive'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Agriculteurs --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-300 to-amber-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Agriculteurs</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['users']['farmers']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-amber-100 text-amber-600">
                        <i class="fas fa-tractor text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="flex items-center text-gray-500">
                            <i class="fas fa-circle text-xs text-amber-500 mr-1"></i>
                            <span>Actifs: {{ $stats['users']['farmers']['active'] }}</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <i class="fas fa-circle text-xs text-amber-300 mr-1"></i>
                            <span>Inactifs: {{ $stats['users']['farmers']['inactive'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->role->libelle === 'admin')
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                <i class="fas fa-map-marked-alt text-xl"></i>
            </div>
            <span class="border-l-4 border-indigo-500 pl-4">Parcelles</span>
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            {{-- Total des Parcelles --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-300 to-green-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Parcelles</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['parcelles']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-green-100 text-green-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">{{ $stats['parcelles']['totalArea'] }} hectares</div>
                    </div>
                </div>
            </div>
            {{-- Parcelles en culture  --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-300 to-green-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Parcelles en culture</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['parcelles']['cultivated']['total'] }}
                        </h3>
                    </div>
                    <div class="rounded-full p-3 bg-green-100 text-green-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">{{ $stats['parcelles']['cultivated']['totalArea'] }}
                            hectares
                        </div>
                    </div>
                </div>
            </div>
            {{-- Parcelles récoltee --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-300 to-amber-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Parcelles récoltées</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['parcelles']['harvested']['total'] }}
                        </h3>
                    </div>
                    <div class="rounded-full p-3 bg-amber-100 text-amber-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">{{ $stats['parcelles']['harvested']['totalArea'] }} hectares
                        </div>
                    </div>
                </div>
            </div>
            {{-- parcelles en jachère --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-300 to-indigo-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Parcelles en jachère</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['parcelles']['fallow']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-indigo-100 text-indigo-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">{{ $stats['parcelles']['fallow']['totalArea'] }} hectares
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (Auth::user()->role->libelle === 'agriculteur')
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                <i class="fas fa-map-marked-alt text-xl"></i>
            </div>
            <span class="border-l-4 border-indigo-500 pl-4">Parcelles</span>
        </h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            {{-- Total des Parcelles --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-300 to-green-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Parcelles</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $stats['parcelleAgriculteur']['total'] }}
                        </h3>
                    </div>
                    <div class="rounded-full p-3 bg-green-100 text-green-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">{{ $stats['parcelleAgriculteur']['totalArea'] }} hectares
                        </div>
                    </div>
                </div>
            </div>
            {{-- Parcelles en culture  --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-300 to-green-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Parcelles en culture</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">
                            {{ $stats['parcelleAgriculteur']['cultivated']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-green-100 text-green-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">
                            {{ $stats['parcelleAgriculteur']['cultivated']['totalArea'] }} hectares
                        </div>
                    </div>
                </div>
            </div>
            {{-- Parcelles récoltee --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-amber-300 to-amber-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Parcelles récoltées</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">
                            {{ $stats['parcelleAgriculteur']['harvested']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-amber-100 text-amber-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">
                            {{ $stats['parcelleAgriculteur']['harvested']['totalArea'] }} hectares
                        </div>
                    </div>
                </div>
            </div>
            {{-- parcelles en jachère --}}
            <div class="bg-white rounded-xl shadow-md p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-300 to-indigo-600"></div>
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Parcelles en jachère</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">
                            {{ $stats['parcelleAgriculteur']['fallow']['total'] }}</h3>
                    </div>
                    <div class="rounded-full p-3 bg-indigo-100 text-indigo-600">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <div class="flex justify-between text-sm">
                        <div class="text-gray-500">Superficie totale</div>
                        <div class="font-medium text-gray-800">{{ $stats['parcelleAgriculteur']['fallow']['totalArea'] }}
                            hectares
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ALERTES --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-6 mb-8">
            @if ($stats['semis']['nonArroses'] > 0 && Auth::user()->role->libelle === 'agriculteur')
                <div>
                    <div class="bg-red-50 rounded-lg p-3 border-l-4 border-red-500">
                        <a class="flex items-center" href="{{ route('semisNonArroses') }}">
                            <div class="rounded-full bg-red-100 p-2 mr-3">
                                <i class="fas fa-exclamation-triangle text-red-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-red-800">Alerte arrosage</h4>
                                <p class="text-sm text-red-600">Vous avez des semis qui n'ont pas encore été arrosés</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @if ($stats['parcelleAgriculteur']['fallow']['total'] == 0 && Auth::user()->role->libelle === 'agriculteur')
                <div class="mt-2">
                    <div class="bg-amber-50 rounded-lg p-3 border-l-4 border-amber-500">
                        <a class="flex items-center" href="{{ route('parcelle.index') }}">
                            <div class="rounded-full bg-amber-100 p-2 mr-3">
                                <i class="fas fa-exclamation-triangle text-amber-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-amber-800">Alerte parcelles</h4>
                                <p class="text-sm text-amber-600">Vous n'avez plus de parcelles libres pour éffectuer des
                                    semis
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    @endif
@endsection

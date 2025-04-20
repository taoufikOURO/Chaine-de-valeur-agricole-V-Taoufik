@extends('layout.layout')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    @if (Auth::user()->role->libelle === 'admin')
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-6 mb-8">
            {{-- Tous les utilisateurs --}}
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-green-100 text-green-600 hover:bg-green-200 transition-colors duration-300">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <span class="border-l-4 border-green-500 pl-4">Tous les utilisateurs</span>
                </h1>
                <canvas id="usersChart" width="300" height="200"></canvas>
            </div>
            <div>
                <canvas id="usersPieChart" width="300" height="200" class="ml-30"></canvas>
            </div>

            {{-- Administrateurs --}}
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <span class="border-l-4 border-indigo-500 pl-4">Administrateurs</span>
                </h1>
                <canvas id="adminsChart" width="300" height="200"></canvas>
            </div>
            {{-- Agriculteurs --}}
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-amber-100 text-amber-600 hover:bg-amber-200 transition-colors duration-300">
                        <i class="fas fa-tractor text-xl"></i>
                    </div>
                    <span class="border-l-4 border-amber-500 pl-4">Agriculteurs</span>
                </h1>
                <canvas id="farmersChart" width="300" height="200"></canvas>
            </div>
        </div>
    @endif

    {{-- Pour les parcelles --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-2 gap-6 mb-8 h-100">
        {{-- Admin --}}
        @if (Auth::user()->role->libelle === 'admin')
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <span class="border-l-4 border-indigo-500 pl-4">Statut des parcelles</span>
                </h1>
                <canvas id="globalPlotsPieChart" width="300" height="200"></canvas>
            </div>
        @endif
        @if (Auth::user()->role->libelle === 'agriculteur')
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <span class="border-l-4 border-indigo-500 pl-4">Statut des parcelles</span>
                </h1>
                <canvas id="farmerPlotsPieChart" width="300" height="200" class="ml-30"></canvas>
            </div>
        @endif

        @if (Auth::user()->role->libelle === 'admin')
            {{-- Surface des parcelles globalement --}}
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <span class="border-l-4 border-indigo-500 pl-4">Surface de parcelles</span>
                </h1>
                <canvas id="globalAreaChart" width="300" height="250"></canvas>
            </div>
        @endif

        {{-- Surface de parcelle spécifique --}}
        @if (Auth::user()->role->libelle === 'agriculteur')
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-6 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition-colors duration-300">
                        <i class="fas fa-map-marked-alt text-xl"></i>
                    </div>
                    <span class="border-l-4 border-indigo-500 pl-4">Surface de parcelles</span>
                </h1>
                <canvas id="farmerAreaChart" width="300" height="250"></canvas>
            </div>
        @endif
    </div>

    {{-- Users --}}
    <script>
        const ctx = document.getElementById('usersChart').getContext('2d');

        const usersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total', 'Actifs', 'Inactifs'],
                datasets: [{
                    label: 'Tous les utilisateurs',
                    data: [
                        {{ $stats['users']['total'] }},
                        {{ $stats['users']['active'] }},
                        {{ $stats['users']['inactive'] }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>

    {{-- Admin Chart --}}
    <script>
        const adminsCtx = document.getElementById('adminsChart').getContext('2d');

        const adminsChart = new Chart(adminsCtx, {
            type: 'bar',
            data: {
                labels: ['Total', 'Actifs', 'Inactifs'],
                datasets: [{
                    label: 'Administrateurs',
                    data: [
                        {{ $stats['users']['admins']['total'] }},
                        {{ $stats['users']['admins']['active'] }},
                        {{ $stats['users']['admins']['inactive'] }}
                    ],
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>

    {{-- Pour les agriculteurs --}}
    <script>
        const farmersCtx = document.getElementById('farmersChart').getContext('2d');

        const farmersChart = new Chart(farmersCtx, {
            type: 'bar',
            data: {
                labels: ['Total', 'Actifs', 'Inactifs'],
                datasets: [{
                    label: 'Agriculteurs',
                    data: [
                        {{ $stats['users']['farmers']['total'] }},
                        {{ $stats['users']['farmers']['active'] }},
                        {{ $stats['users']['farmers']['inactive'] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>

    {{-- Utilisateurs actifs et inactifs --}}
    <script>
        const pieCtx = document.getElementById('usersPieChart').getContext('2d');

        const usersPieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Actifs', 'Inactifs'],
                datasets: [{
                    label: 'Répartition utilisateurs',
                    data: [
                        {{ $stats['users']['active'] }},
                        {{ $stats['users']['inactive'] }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>

    {{-- Parcelles pour l'espace admin --}}
    <script>
        const globalPlotsCtx = document.getElementById('globalPlotsPieChart').getContext('2d');

        const globalPlotsPieChart = new Chart(globalPlotsCtx, {
            type: 'pie',
            data: {
                labels: ['Cultivées', 'Récoltées', 'En jachère'],
                datasets: [{
                    label: 'Parcelles globales',
                    data: [
                        {{ $stats['parcelles']['cultivated']['total'] }},
                        {{ $stats['parcelles']['harvested']['total'] }},
                        {{ $stats['parcelles']['fallow']['total'] }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>

    {{-- parcelles pour l’agriculteur --}}
    <script>
        const farmerPlotsCtx = document.getElementById('farmerPlotsPieChart').getContext('2d');

        const farmerPlotsPieChart = new Chart(farmerPlotsCtx, {
            type: 'pie',
            data: {
                labels: ['Cultivées', 'Récoltées', 'En jachère'],
                datasets: [{
                    label: 'Parcelles de l’agriculteur',
                    data: [
                        {{ $stats['parcelleAgriculteur']['cultivated']['total'] }},
                        {{ $stats['parcelleAgriculteur']['harvested']['total'] }},
                        {{ $stats['parcelleAgriculteur']['fallow']['total'] }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(201, 203, 207, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>

    {{-- Surface des parcelles globalement --}}
    <script>
        const globalAreaCtx = document.getElementById('globalAreaChart').getContext('2d');

        const globalAreaChart = new Chart(globalAreaCtx, {
            type: 'bar',
            data: {
                labels: ['Cultivées', 'Récoltées', 'En jachère'],
                datasets: [{
                    label: 'Surface totale (en ha)',
                    data: [
                        {{ $stats['parcelles']['cultivated']['totalArea'] }},
                        {{ $stats['parcelles']['harvested']['totalArea'] }},
                        {{ $stats['parcelles']['fallow']['totalArea'] }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

    {{-- Surface de parcelle pour un agriculteur spécifique --}}
    <script>
        const farmerAreaCtx = document.getElementById('farmerAreaChart').getContext('2d');

        const farmerAreaChart = new Chart(farmerAreaCtx, {
            type: 'bar',
            data: {
                labels: ['Cultivées', 'Récoltées', 'En jachère'],
                datasets: [{
                    label: 'Surface (en ha)',
                    data: [
                        {{ $stats['parcelleAgriculteur']['cultivated']['totalArea'] }},
                        {{ $stats['parcelleAgriculteur']['harvested']['totalArea'] }},
                        {{ $stats['parcelleAgriculteur']['fallow']['totalArea'] }}
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(201, 203, 207, 0.7)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection

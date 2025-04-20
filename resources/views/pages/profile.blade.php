@extends('layout.layout')

@section('title', 'Profile')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        @if (session('showSuccessModal'))
            @include('components.success-modal')
        @endif

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header with solid color -->
                <div class="bg-green-700 h-32 relative">
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 16H12V14H14V16ZM22 16H20V14H22V16ZM30 16H28V14H30V16ZM38 16H36V14H38V16ZM46 16H44V14H46V16ZM54 16H52V14H54V16ZM62 16H60V14H62V16ZM70 16H68V14H70V16ZM14 24H12V22H14V24ZM22 24H20V22H22V24ZM30 24H28V22H30V24ZM38 24H36V22H38V24ZM46 24H44V22H46V24ZM54 24H52V22H54V24ZM62 24H60V22H62V24ZM70 24H68V22H70V24ZM14 32H12V30H14V32ZM22 32H20V30H22V32ZM30 32H28V30H30V32ZM38 32H36V30H38V32ZM46 32H44V30H46V32ZM54 32H52V30H54V32ZM62 32H60V30H62V32ZM70 32H68V30H70V32ZM14 40H12V38H14V40ZM22 40H20V38H22V40ZM30 40H28V38H30V40ZM38 40H36V38H38V40ZM46 40H44V38H46V40ZM54 40H52V38H54V40ZM62 40H60V38H62V40ZM70 40H68V38H70V40ZM14 48H12V46H14V48ZM22 48H20V46H22V48ZM30 48H28V46H30V48ZM38 48H36V46H38V48ZM46 48H44V46H46V48ZM54 48H52V46H54V48ZM62 48H60V46H62V48ZM70 48H68V46H70V48ZM14 56H12V54H14V56ZM22 56H20V54H22V56ZM30 56H28V54H30V56ZM38 56H36V54H38V56ZM46 56H44V54H46V56ZM54 56H52V54H54V56ZM62 56H60V54H62V56ZM70 56H68V54H70V56ZM14 64H12V62H14V64ZM22 64H20V62H22V64ZM30 64H28V62H30V64ZM38 64H36V62H38V64ZM46 64H44V62H46V64ZM54 64H52V62H54V64ZM62 64H60V62H62V64ZM70 64H68V62H70V64ZM14 72H12V70H14V72ZM22 72H20V70H22V72ZM30 72H28V70H30V72ZM38 72H36V70H38V72ZM46 72H44V70H46V72ZM54 72H52V70H54V72ZM62 72H60V70H62V72ZM70 72H68V70H70V72Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </div>

                <div class="relative px-8 pb-12">
                    <!-- Avatar -->
                    <div class="absolute -top-16 left-8">
                        <div class="p-1 bg-white rounded-full shadow-md">
                            <div
                                class="h-32 w-32 rounded-full flex items-center justify-center bg-green-600 text-white text-4xl font-bold">
                                {{ Auth::user()->first_name[0] }}{{ Auth::user()->last_name[0] }}
                            </div>
                        </div>
                    </div>

                    <!-- Profile content -->
                    <div class="pt-20 sm:pt-4 sm:pl-44">
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10">
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </h1>
                                <div class="flex items-center mt-2 text-gray-600">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-lg font-medium">@ {{ Auth::user()->username }}</span>
                                </div>
                            </div>

                            <!-- Edit profile button -->
                            <a href="{{ route('profile.edit', Auth::user()->id) }}"
                                class="mt-4 sm:mt-0 py-2.5 px-5 text-center font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out shadow-sm">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Modifier le profil
                                </span>
                            </a>
                        </div>

                        <hr class="my-8 border-gray-200">

                        <div class="grid md:grid-cols-3 gap-10">
                            <!-- Left column - Role badges -->
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Informations
                                </h3>

                                @if (Auth::user()->role_id == 1)
                                    <div
                                        class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm mb-4 hover:border-green-300 transition-colors">
                                        <div class="flex-shrink-0 mr-4 p-2 bg-green-100 rounded-full">
                                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500">Privilèges</div>
                                            <div class="font-semibold text-gray-800">Administrateur</div>
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::user()->role_id == 2)
                                    <div
                                        class="flex items-center p-4 bg-white border border-gray-200 rounded-lg shadow-sm mb-4 hover:border-green-300 transition-colors">
                                        <div class="flex-shrink-0 mr-4 p-2 bg-green-100 rounded-full">
                                            <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500">Statut</div>
                                            <div class="font-semibold text-gray-800">Agriculteur</div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Right column - Additional info -->
                            <div class="md:col-span-2">
                                @if (Auth::user()->role_id == 2)
                                    <div
                                        class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:border-green-300 transition-colors">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center">
                                            <svg class="w-6 h-6 mr-2 text-green-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                                </path>
                                            </svg>
                                            Principales cultures
                                        </h2>

                                        <div class="flex flex-wrap gap-2 mt-3">
                                            @foreach ($semis as $item)
                                                <span
                                                    class="px-4 py-2 bg-green-50 text-green-700 border border-green-200 rounded-lg text-sm font-medium">
                                                    {{ $item->culture->nom }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

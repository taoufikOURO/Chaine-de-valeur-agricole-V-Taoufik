<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Traçabilité Professionnelle</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    @vite('resources/css/app.css')
</head>


<body class="font-sans text-gray-900 bg-white bg-pattern min-h-screen">
    <div class="relative w-full min-h-screen flex flex-col items-center justify-center">
        <!-- Background subtle gradient -->
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-gray-50 to-white opacity-80 z-0">
        </div>

        <!-- Content container -->
        <div class="container max-w-6xl mx-auto px-4 py-12 relative z-10">
            <!-- Logo section -->
            <div class="flex justify-center mb-16 animate-fade-in h-20 cursor-pointer">
                @include('components.logo')
            </div>

            <!-- Main content -->
            <div class="max-w-4xl mx-auto">
                <!-- Hero section -->
                <div class="flex flex-col items-center text-center mb-16 animate-fade-up" style="animation-delay: 0.2s">
                    <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-8 text-gray-900">
                        Suivez l’évolution de vos cultures et enregistrez toutes
                        les interventions effectuées sur vos parcelles
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 max-w-2xl mb-12">
                        Une solution de traçabilité experte pour les professionnels exigeants.
                    </p>
                    <a href="#"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-8 rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        Se connecter
                    </a>
                    <p class="text-sm text-gray-500 mt-4">
                        Accédez à l'application et commencez à gérer vos processus.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="w-full py-8 border-gray-100 fixed bottom-0 left-0">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        @include('components.logo')
                    </div>
                    <div class="text-sm text-center md:text-left">
                        <span class="font-bold mr-2">&copy; 2025</span>
                        <div class="mt-2 md:mt-0 md:inline-block">
                            <span class="block md:inline">SABI Céline</span>
                            <span class="mx-2 hidden md:inline">|</span>
                            <span class="block md:inline">OURO-BANG'NA Taoufik</span>
                            <span class="mx-2 hidden md:inline">|</span>
                            <span class="block md:inline">MARDJA Liguili</span>
                            <span class="mx-2 hidden md:inline">|</span>
                            <span class="block md:inline">EKLU Charly</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>

</html>

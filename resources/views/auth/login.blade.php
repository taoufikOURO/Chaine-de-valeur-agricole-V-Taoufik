<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" type="image/svg" href="{{ asset('logo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center p-4 bg-gray-50">

    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif
    @if (session('showSuccessModal'))
        @include('components.success-modal')
    @endif
    <div class="login-container w-full max-w-md p-8 md:p-10">
        <!-- Logo placeholder -->
        <div class="logo-container">
            <!-- Remplacer par votre logo -->
            <div class="logo flex items-center justify-center">
                <a href="{{ route('login.page') }}">
                    @include('components.logo')
                </a>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-center mb-8 text-gray-900">Connexion</h1>

        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" required
                    class="form-input w-full px-4 py-3 text-gray-900" placeholder="votre@email.com">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <a href="{{ route('password.request') }}" class="text-sm text-black hover:underline">Mot de passe
                        oublié?</a>
                </div>
                <input type="password" id="password" name="password" required
                    class="form-input w-full px-4 py-3 text-gray-900" placeholder="Votre mot de passe">
            </div>

            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox"
                    class="h-4 w-4 border-gray-300 rounded text-black focus:ring-0">
                <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                    Se souvenir de moi
                </label>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="login-button w-full py-3 font-medium text-base bg-green-700 text-white hover:bg-green-800 cursor-pointer">
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</body>

</html>

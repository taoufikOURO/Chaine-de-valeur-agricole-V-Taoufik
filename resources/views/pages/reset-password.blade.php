<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de mot de passe</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" type="image/svg" href="{{ asset('logo.svg') }}">
</head>

<body class="min-h-screen flex items-center justify-center p-4 bg-gray-50">
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

        <h1 class="text-2xl font-bold text-center mb-8 text-gray-900">Modifier votre mot de passe</h1>

        <form class="space-y-6" method="POST" action="{{route('password.update')}}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                </div>
                <input type="email" id="email" name="email" required
                    class="form-input w-full px-4 py-3 text-gray-900" placeholder="exemple@exemple.com">
            </div>
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                </div>
                <input type="password" id="password" name="password" required
                    class="form-input w-full px-4 py-3 text-gray-900" placeholder="Mot de passe">
            </div>
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="form-input w-full px-4 py-3 text-gray-900" placeholder="Confirmation de mot de passe">
            </div>
            <div class="pt-2">
                <button type="submit"
                    class="login-button w-full py-3 font-medium text-base bg-green-700 text-white hover:bg-green-800 cursor-pointer">
                    Modifier le mot de passe
                </button>
            </div>
        </form>
    </div>
</body>

</html>

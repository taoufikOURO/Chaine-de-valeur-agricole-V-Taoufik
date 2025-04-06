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
    @if (session('showErrorModal'))
        @include('components.error-modal')
    @endif
    @if (session('showSuccessModal'))
        @include('components.success-modal')
    @endif
    <div class="login-container w-full max-w-md p-8 md:p-10">
        <form class="space-y-6" method="POST" action="{{ route('password.request') }}">
            @csrf
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                </div>
                <input type="email" id="email" name="email" required
                    class="form-input w-full px-4 py-3 text-gray-900" placeholder="exemple@exemple.com">
            </div>
            <div class="pt-2">
                <button type="submit"
                    class="login-button w-full py-3 font-medium text-base bg-green-700 text-white hover:bg-green-800 cursor-pointer">
                    Valider
                </button>
            </div>
        </form>
    </div>
</body>

</html>

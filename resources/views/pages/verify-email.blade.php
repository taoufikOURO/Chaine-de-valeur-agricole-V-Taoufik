<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification d'email</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --agri-green-100: #eef6ee;
            --agri-green-200: #ddeedd;
            --agri-green-300: #c5dfc5;
            --agri-green-400: #a8cba8;
            --agri-green-500: #7aad7a;
        }

        .bg-agri-green-100 {
            background-color: var(--agri-green-100);
        }

        .bg-agri-green-200 {
            background-color: var(--agri-green-200);
        }

        .bg-agri-green-300 {
            background-color: var(--agri-green-300);
        }

        .bg-agri-green-400 {
            background-color: var(--agri-green-400);
        }

        .bg-agri-green-500 {
            background-color: var(--agri-green-500);
        }

        .border-agri-green-300 {
            border-color: var(--agri-green-300);
        }

        .border-agri-green-500 {
            border-color: var(--agri-green-500);
        }

        .text-agri-green-500 {
            color: var(--agri-green-500);
        }

        .hover-bg-agri-green-400:hover {
            background-color: var(--agri-green-400);
        }

        .hover-bg-agri-green-500:hover {
            background-color: var(--agri-green-500);
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <div
        class="max-w-md w-full mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl transform transition-all duration-300 hover:shadow-xl">
        <div class="md:flex">
            <div class="p-8 w-full">
                <div class="bg-agri-green-100 p-6 rounded-lg border-l-4 border-agri-green-500 mb-6">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-agri-green-500 mr-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h1 class="text-2xl font-bold text-gray-800">Vérification de votre adresse email</h1>
                    </div>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600 mb-2">Un email de vérification a été envoyé à votre adresse email. Veuillez
                        cliquer sur le lien contenu dans l'email pour activer votre compte.</p>
                    <p class="text-gray-500 text-sm italic">Vérifiez également votre dossier de spam si vous ne trouvez
                        pas l'email.</p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-gray-700 mb-4 font-medium">Vous n'avez pas reçu l'email ?</p>

                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-white bg-agri-green-500 hover:bg-agri-green-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-agri-green-300 transition-all duration-300 transform hover:-translate-y-1">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-white group-hover:text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </span>
                            <span class="ml-2">Renvoyer l'email de confirmation</span>
                        </button>
                    </form>
                </div>

                <div class="mt-8 bg-agri-green-100 rounded-lg p-4 border border-agri-green-300 animate-pulse-slow">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-agri-green-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-gray-600">La vérification de votre email garantit la sécurité de votre
                            compte.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

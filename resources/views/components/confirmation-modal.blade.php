<style>
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0px);
        }

        to {
            opacity: 1;
            backdrop-filter: blur(8px);
        }
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-30px) scale(0.95);
            opacity: 0;
        }

        to {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    @keyframes modalPulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.2);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .modal-backdrop {
        animation: modalFadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .modal-content {
        animation: modalSlideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-highlight {
        animation: modalPulse 2s infinite;
    }

    .glassmorphism {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    :root {
        --warning-gradient: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    }
</style>
<div id="formConfirmationModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-opacity-30 modal-backdrop flex items-center justify-center p-4">
        <div class="modal-content w-full max-w-md overflow-hidden rounded-2xl glassmorphism" role="dialog"
            aria-modal="true" aria-labelledby="warningModalTitle">
            <div class="px-6 pt-6 pb-4">
                <div class="flex flex-col items-center text-center">
                    <div class="h-20 w-20 rounded-full flex items-center justify-center mb-4 modal-highlight"
                        style="background: var(--warning-gradient)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 id="warningModalTitle" class="text-xl font-bold text-gray-900 mb-1">
                        {{ $title ?? 'Confirmer l\'envoi' }}</h3>
                    <p class="text-gray-600 mb-6">
                        {{ $message ?? 'Êtes-vous sûr de vouloir envoyer ce formulaire ? Cette action ne pourra pas être annulée.' }}
                    </p>
                    <div class="w-full flex items-center justify-center gap-4">
                        <button type="button" id="cancelFormSubmission"
                            class="modal-close px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer">
                            Annuler
                        </button>
                        <button type="button" id="confirmFormSubmission" style="background: var(--warning-gradient)"
                            class="modal-close btn-pulse px-6 py-3 bg-premium-warning text-white font-medium rounded-lg hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer">
                            Continuer
                        </button>
                    </div>
                </div>
            </div>

            <button class=" cursor-pointer absolute top-4 right-4 text-gray-400 hover:text-gray-500 modal-close" aria-label="Fermer">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

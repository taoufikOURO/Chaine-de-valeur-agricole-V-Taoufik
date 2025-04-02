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
        --success-gradient: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    }
</style>
<div id="errorModal" class="fixed inset-0 z-50">
    <div class="absolute inset-0 bg-opacity-30 modal-backdrop flex items-center justify-center p-4">
        <div class="modal-content w-full max-w-md overflow-hidden rounded-2xl glassmorphism" role="dialog"
            aria-modal="true" aria-labelledby="successModalTitle">
            <div class="px-6 pt-6 pb-4">
                <div class="flex flex-col items-center text-center">
                    <div class="h-20 w-20 rounded-full flex items-center justify-center mb-4 modal-highlight"
                        style="background: var(--success-gradient)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 id="successModalTitle" class="text-xl font-bold text-gray-900 mb-1">
                        {{ session('successTitle') ?? 'Opération réussie' }}</h3>
                    <p class="text-gray-600 mb-6">
                        {{ session('successMessage') ??
                            'Toutes vos modifications ont été enregistrées avec succès dans
                                                    notre système.' }}
                    </p>

                    <div class="w-full flex items-center justify-center gap-4">
                        <button type="button"
                            class="modal-close px-6 py-3 bg-premium-error cursor-pointer  text-white hover:text-white font-medium rounded-lg  focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg"
                            style="background: var(--success-gradient)">
                            Parfait !
                        </button>
                    </div>
                </div>
            </div>

            <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 modal-close cursor-pointer"
                aria-label="Fermer">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        trapFocus(modal);

        // Empêcher le défilement du corps
        document.body.style.overflow = 'hidden';

        // Animation d'entrée
        const content = modal.querySelector('.modal-content');
        content.style.opacity = '0';
        content.style.transform = 'translateY(-30px) scale(0.95)';

        setTimeout(() => {
            content.style.opacity = '';
            content.style.transform = '';
        }, 10);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = modal.querySelector('.modal-content');

        // Animation de sortie
        content.style.opacity = '0';
        content.style.transform = 'translateY(-10px) scale(0.95)';

        setTimeout(() => {
            modal.classList.add('hidden');
            content.style.opacity = '';
            content.style.transform = '';

            // Restaurer le défilement du corps
            if (!document.querySelector('.fixed.inset-0:not(.hidden)')) {
                document.body.style.overflow = '';
            }
        }, 200);
    }

    function findModalContainer(element) {
        let parent = element;
        while (parent && !parent.hasAttribute('role') && parent.getAttribute('role') !== 'dialog') {
            if (parent.classList.contains('fixed') && parent.classList.contains('inset-0')) {
                return parent;
            }
            parent = parent.parentNode;
        }
        return parent.closest('.fixed.inset-0');
    }

    // Accessibilité - piéger le focus dans la modale
    function trapFocus(modal) {
        const focusableElements = modal.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusableElements.length === 0) return;

        const firstFocusableElement = focusableElements[0];
        const lastFocusableElement = focusableElements[focusableElements.length - 1];

        // Mettre le focus sur le premier élément
        setTimeout(() => {
            firstFocusableElement.focus();
        }, 50);

        modal.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                // Shift + Tab
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusableElement) {
                        lastFocusableElement.focus();
                        e.preventDefault();
                    }
                    // Tab
                } else {
                    if (document.activeElement === lastFocusableElement) {
                        firstFocusableElement.focus();
                        e.preventDefault();
                    }
                }
            }
        });
    }

    // Initialisation des modales
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la fermeture des modales
        const closeButtons = document.querySelectorAll('.modal-close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = findModalContainer(this);
                if (modal) {
                    closeModal(modal.id);
                }
            });
        });

        // Fermer la modale quand on clique en dehors
        const modalBackdrops = document.querySelectorAll('.modal-backdrop');
        modalBackdrops.forEach(backdrop => {
            backdrop.addEventListener('click', function(event) {
                if (event.target === this) {
                    const modal = this.parentNode;
                    closeModal(modal.id);
                }
            });
        });

        // Fermer la modale avec la touche Echap
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const openModals = document.querySelectorAll('.fixed.inset-0:not(.hidden)');
                openModals.forEach(modal => {
                    closeModal(modal.id);
                });
            }
        });
    });

    // Exposer les fonctions pour une utilisation globale
    window.openModal = openModal;
    window.closeModal = closeModal;
</script>

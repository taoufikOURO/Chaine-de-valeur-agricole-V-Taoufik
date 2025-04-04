document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.querySelectorAll('tr');
    const emptyState = document.getElementById('emptyState');
    const resultCount = document.getElementById('resultCount');

    // Animation des lignes au chargement initial avec délai progressif
    rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(15px)';

        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, 150 + (index * 100));
    });

    // Fonction de recherche améliorée avec animations fluides
    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        // Retarder légèrement la recherche pour de meilleures performances d'animation
        setTimeout(() => {
            rows.forEach((row, index) => {
                const libelle = row.children[1].textContent.toLowerCase();
                const matchFound = libelle.includes(searchTerm);

                // Retarder l'animation de chaque ligne pour créer un effet en cascade
                setTimeout(() => {
                    if (matchFound) {
                        if (row.style.display === 'none') {
                            row.style.display = '';
                            row.style.opacity = '0';
                            row.style.transform = 'translateY(15px)';

                            // Déclencher l'animation après une courte pause
                            setTimeout(() => {
                                row.style.opacity = '1';
                                row.style.transform =
                                    'translateY(0)';
                            }, 10);
                        }
                        visibleCount++;
                    } else {
                        // Animer la suppression
                        row.style.opacity = '0';
                        row.style.transform = 'translateY(15px)';

                        // Masquer après la fin de l'animation
                        setTimeout(() => {
                            row.style.display = 'none';
                        }, 250);
                    }

                    // Mettre à jour le compteur une fois toutes les lignes traitées
                    if (index === rows.length - 1) {
                        // Afficher ou masquer l'état vide avec une animation douce
                        if (visibleCount === 0) {
                            emptyState.style.display = 'block';
                            emptyState.style.opacity = '0';
                            setTimeout(() => {
                                emptyState.style.opacity = '1';
                            }, 10);
                        } else {
                            if (emptyState.style.display === 'block') {
                                emptyState.style.opacity = '0';
                                setTimeout(() => {
                                    emptyState.style.display =
                                        'none';
                                }, 250);
                            }
                        }

                        // Mettre à jour le compteur de résultats avec une animation subtile
                        resultCount.style.opacity = '0';
                        setTimeout(() => {
                            resultCount.textContent =
                                `Affichage de ${visibleCount} entrée${visibleCount > 1 ? 's' : ''}`;
                            resultCount.style.opacity = '1';
                        }, 200);
                    }
                }, index * 50);
            });
        }, 100);
    });

    // Ajouter des effets d'ondulation et de luminosité au clic sur les boutons
    const buttons = document.querySelectorAll('.btn, .add-button');
    buttons.forEach(button => {
        button.addEventListener('mousedown', function () {
            this.style.transform = 'scale(0.95)';
            this.style.boxShadow = '0 1px 2px rgba(0, 0, 0, 0.1)';
        });

        button.addEventListener('mouseup', function () {
            this.style.transform = '';
            this.style.boxShadow = '';
        });

        button.addEventListener('mouseleave', function () {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Focus automatique sur la recherche
    setTimeout(() => {
        searchInput.focus();
    }, 800);
});

const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('toggle-btn');
const toggleIcon = document.getElementById('toggle-icon');
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const overlay = document.getElementById('overlay');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    if (sidebar.classList.contains('collapsed')) {
        toggleIcon.classList.remove('fa-chevron-left');
        toggleIcon.classList.add('fa-chevron-right');
        toggleBtn.setAttribute('data-tooltip', 'Élargir le menu');
    } else {
        toggleIcon.classList.remove('fa-chevron-right');
        toggleIcon.classList.add('fa-chevron-left');
        toggleBtn.setAttribute('data-tooltip', 'Réduire le menu');
    }
});

// Mobile menu
mobileMenuBtn.addEventListener('click', () => {
    sidebar.classList.toggle('mobile-open');
    overlay.classList.toggle('active');
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('mobile-open');
    overlay.classList.remove('active');
});

const profileBtn = document.getElementById('profile-btn');
const profileDropdown = document.getElementById('profile-dropdown');


profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('active');
});

document.addEventListener('click', () => {
    profileDropdown.classList.remove('active');
});

profileDropdown.addEventListener('click', (e) => {
    e.stopPropagation();
});

window.addEventListener('resize', () => {
    if (window.innerWidth > 1024) {
        overlay.classList.remove('active');
    }
});

// Highlight the active navigation link based on the current page
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
});

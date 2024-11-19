document.addEventListener("DOMContentLoaded", function () {
    // Attach event listener to the hamburger button only when the DOM is loaded
    const hamburgerBtn = document.getElementById('hamburger-btn');
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', toggleMenu);
    }
});

function toggleMenu() {
    const sidebar = document.querySelector('.sidebar');
    const hamburgerBtn = document.getElementById('hamburger-btn');
    
    // Toggle the 'active' class on the sidebar
    sidebar.classList.toggle('active');

    // Toggle visibility of the hamburger button
    if (sidebar.classList.contains('active')) {
        hamburgerBtn.style.display = 'none';
    } else {
        hamburgerBtn.style.display = 'block';
    }
}

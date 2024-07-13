// JavaScript for mobile menu button functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menuButton');
    const navigationList = document.querySelector('.navigation_list');

    menuButton.addEventListener('click', function() {
        navigationList.classList.toggle('active');
    });
});

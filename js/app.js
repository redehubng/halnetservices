// Loader File
window.addEventListener('load', function() {
  document.getElementById('loader').style.display = 'none';
});

// JavaScript for mobile menu button functionality
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('menuButton');
    const navigationList = document.querySelector('.navigation_list');

    menuButton.addEventListener('click', function() {
        navigationList.classList.toggle('active');
    });
});


// Feature card styles
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

function checkCardsInViewport() {
    const firstCard = document.querySelector('.first_card');
    const secondCard = document.querySelector('.second_card');
    const thirdCard = document.querySelector('.third_card');
    const fourthCard = document.querySelector('.fourth_card');

    if (isInViewport(firstCard)) {
        firstCard.classList.add('rotated');
    }
    if (isInViewport(secondCard)) {
        secondCard.classList.add('rotated');
    }
    if (isInViewport(thirdCard)) {
        thirdCard.classList.add('rotated');
    }
    if (isInViewport(fourthCard)) {
        fourthCard.classList.add('rotated');
    }
}

// icon load
document.getElementById("orderForm").onsubmit = function() {
    document.querySelector("order_btn").style.display = "none";
    document.getElementById("loader").style.display = "inline-block";
  };

window.addEventListener('scroll', checkCardsInViewport);
window.addEventListener('resize', checkCardsInViewport);
document.addEventListener('DOMContentLoaded', checkCardsInViewport);

// Back to Top Button
const backToTopButton = document.getElementById('back-to-top');

window.addEventListener('scroll', () => {
  if (window.scrollY > 200) { // adjust this value to your header height
    backToTopButton.style.display = 'block';
  } else {
    backToTopButton.style.display = 'none';
  }
});

backToTopButton.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});
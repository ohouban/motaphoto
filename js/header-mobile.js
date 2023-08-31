const burger = document.getElementById('burger-btn');
const mobileMenu = document.querySelector('.liens-mobile');

burger.addEventListener('click', () => {
    if (burger.classList.contains('active')) {
        burger.classList.remove('active');
        burger.classList.add('inactive');
    } else {
        burger.classList.remove('inactive');
        burger.classList.add('active');
    }
    mobileMenu.classList.toggle('active');
});

const menuLinks = document.querySelectorAll(".liens-mobile ul li a, .contact-btn");

menuLinks.forEach((link) => {
    link.addEventListener('click', () => {
        burger.classList.remove('active');
        burger.classList.add('inactive');
        mobileMenu.classList.remove('active');
    });
});



document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainMenu = document.querySelector('.main-menu');
  
    // Par défaut, le menu est fermé en version mobile
    mainMenu.classList.add('open');
  
    menuToggle.addEventListener('click', function () {
      mainMenu.classList.toggle('open'); // Ajoute ou supprime la classe 'open'
    });
  });
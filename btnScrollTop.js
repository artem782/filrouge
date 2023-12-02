// Sélectionnez le bouton et attachez un gestionnaire d'événements
var btnScrollToTop = document.getElementById('btnScrollToTop');

// Gérez le comportement du bouton lorsque la page est défilée
window.addEventListener('scroll', function () {
    if (window.pageYOffset > 100) { // Vous pouvez ajuster cette valeur en fonction de votre préférence
        btnScrollToTop.style.display = 'block';
    } else {
        btnScrollToTop.style.display = 'none';
    }
});

// Gérez le clic sur le bouton pour remonter en haut
btnScrollToTop.addEventListener('click', function () {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Cette option ajoute une animation de défilement fluide
    });
});





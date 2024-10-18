
    // Fonction pour faire défiler la page vers l'élément cible
    // function scrollToElement(elementId) {
    //     const element = document.getElementById(elementId);
    //     if (element) {
            
    //         element.scrollIntoView({ behavior: 'smooth', block: "start" });
    //     }
    // }

    // // Attachez un gestionnaire d'événements à chaque lien dans le sous-menu
    // const scrollButtons = document.querySelectorAll('.scrollButton a');
    // scrollButtons.forEach(button => {
    //     button.addEventListener('click', (event) => {
    //         event.preventDefault();
    //         const targetId = event.target.getAttribute('href').substring(1); // Supprime le '#'
    //         scrollToElement(targetId);
    //     });
    // });


    // Fonction pour faire défiler la page pour centrer l'intitulé
    // Fonction pour faire défiler la page pour centrer l'élément à l'écran
    // Fonction pour faire défiler la page et centrer l'élément à l'écran



    document.addEventListener('click', function(event) {
        if (event.target.tagName === 'A' && event.target.getAttribute('href').startsWith('#intitule_')) {
            event.preventDefault(); // Empêche le comportement de lien par défaut
    
            const targetId = event.target.getAttribute('href').substring(1); // Récupère l'identifiant cible sans le '#'
            const targetElement = document.getElementById(targetId);
    
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth', // Animation de défilement fluide
                    block: 'start',     // Défilement vers le haut de l'élément
                });
            }
        }
    });
    
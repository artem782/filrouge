
    // Fonction pour faire défiler la page vers une section spécifique
    function scrollToSection(sectionId) {
      const section = document.getElementById(sectionId);

      if (section) {
          section.scrollIntoView({
              behavior: "smooth", // Défilement en douceur
              block: "start" // Vous pouvez ajuster cette valeur en fonction de vos préférences
          });
      }
  }

  // Sélectionnez tous les boutons par leur classe commune
  const scrollButtons = document.querySelectorAll(".scrollButton");

  // Ajoutez un gestionnaire d'événements à chaque bouton
  scrollButtons.forEach(function(button) {
      button.addEventListener("click", function() {
          const targetSectionId = button.getAttribute("data-target");
          scrollToSection(targetSectionId);
      });
  });



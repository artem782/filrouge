function openForm() {
  document.getElementById("popupForm").style.display = "block";
}

function closeForm() {
  document.getElementById("popupForm").style.display = "none";
}

function checkLogin() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;

  if (username === "Artem" && password === "root") {
      alert("Connexion réussie !");
      window.location.href = "./adminpage.php";

      closeForm(); // Ferme la fenêtre de connexion
  } else {
      alert("Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.");
      document.getElementById("username").value = ""; // Efface le champ nom d'utilisateur
      document.getElementById("password").value = ""; // Efface le champ mot de passe
  }
}





function loadInfo(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
          document.getElementById("info-container").innerHTML = this.responseText;
          scrollToInfo();
      }
  };
  xhttp.open("GET", "get_info.php?id=" + id, true);
  xhttp.send();
}

function scrollToInfo() {
  var infoContainer = document.getElementById("info-container");
  infoContainer.scrollIntoView({ behavior: "smooth", block: "start" });
}

var buttons = document.querySelectorAll('.bouton');
buttons.forEach(function(button) {
  button.addEventListener('click', function() {
      var id = button.getAttribute('data-target').replace('content', '');
      loadInfo(id);
  });
});

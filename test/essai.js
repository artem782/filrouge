
//TODO : inutile ?
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

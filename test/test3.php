<!DOCTYPE html>
<html lang="fr">
<head>


    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> : -->
    <title>UHA 4.0 L&#039;école du Numérique, une formation informatique à Mulhouse</title>
    <link rel="icon" type="image/png" href="./image/téléchargement-removebg-preview.png"/>
    <!-- <link rel="stylesheet" type="text/css" href="./main.css"/> -->
    <link rel="stylesheet" type="text/css" href="./test2.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>
<header>
  
   <img class="img3" src="./image/cropped-uha40_fst-1.png">
   <nav>


   <?php
// Fonction pour afficher les informations de l'API par année
function afficherIntituleParAnnee($intituleannee) {
    $api_url = 'https://filrouge.uha4point0.fr/V2/UHA40/certifications';
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json_data = curl_exec($ch);
    $response_data = json_decode($json_data);
    echo '<ul class="niveau1">';
    echo '<li class="sousmenu">';
    echo '<a href="#"><h1 class="h2" >Parcours ▼</h1></a>';
    echo '<ul class="niveau2">';
    
    if (is_array($response_data)) {
        foreach ($response_data as $item) {
            $intitule = $item->intitule;
            if ($item->annee == $intituleannee) {

                echo '<li class="scrollButton"><a href="#intitule_' . $intitule . '">' . $intitule . '</a></li>';
                // echo '<li class="scrollButton"><a href="#intitule_position1">' . $intitule . '</a></li>';

                
            }
            
        }
    }
    echo '</ul>';
    echo '</li>';
    echo '</ul>';
    curl_close($ch);
}

// Récupérer l'année depuis les paramètres d'URL
if (isset($_GET['annee'])) {
    $anneeSaisie = $_GET['annee'];

    // Utilisation de la fonction pour afficher les informations pour l'année saisie
   
    afficherIntituleParAnnee($anneeSaisie);
    
}
?>
<!-- 
<form action="submit_contact.php" method="GET">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email">
    </div>
    <div>
        <label for="message">Votre message</label>
        <textarea placeholder="Exprimez vous" name="message"></textarea>
    </div>
    <button type="submit">Envoyer</button>
</form> -->
<!-- <h1>Message bien reçu !</h1> 
<div class="card"> 
<div class="card-body"> 
<h5 class="card-title">Rappel de vos informations</h5> 
<p class="card-text"><b>Email</b> : <?php echo $_GET['email']; ?></p> 
<p class="card-text"><b>Message</b> : <?php echo $_GET['message']; ?></p> 
</div> 
</div> -->


  </nav> 
  
   <!-- <nav class="menu">
    
    <span class="contact"> <a href="#">Contact</a></span>
     <button class="scrollButton" data-target="apprenez-a-programmer">Défiler vers Section 1</button>
     <button class="scrollButton" data-target="decouvrir-la-programmation-creative">Défiler vers Section 2</button>


  


  </nav> -->
  
</header>
<main>
  <div>
    <button  id="btnScrollToTop"></button>
    <script src="btnScrollTop.js"></script>
  </div>

</main>
 <body>

    
  <div class=" position2" >
   <img
   src="./image/logouha4.0.png"
   title="L&#039;école du Numérique , une formation universitaire en développement informatique 100% projet à Mulhouse, en Alsace !" />
   <div class="position3">
    <!-- <div class="content-container"> -->
       
    <?php
// Informations de connexion à la base de données
$serveur = 'localhost';
$base_de_donnees = 'fil_rouge_401_Artem_Tatkov';
$utilisateur = 'root';
$mot_de_passe = '';

// Établir une connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}
function afficherNomParAnnee($numannee, $connexion) {
    // Évitez les attaques par injection SQL en utilisant des requêtes préparées
    $requete = $connexion->prepare("SELECT nom FROM ApiAnnees WHERE id = ?");
    $requete->bind_param("i", $numannee);
    $requete->execute();
    $resultat = $requete->get_result();

    if ($resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        echo '<h1 class="h1"> Programme de la formation ' . htmlspecialchars($row["nom"], ENT_QUOTES, 'UTF-8') . '</h1>';
    }

    $requete->close();
}
if (isset($_GET['annee'])) 
    $anneeSaisie = $_GET['annee'];
    
    // Utilisation de la fonction pour afficher les informations pour l'année saisie
    afficherNomParAnnee($anneeSaisie, $connexion);

    $connexion->close();
?>
    
    
      </h1>
        <div class="positionbouton6">
            <div class="img-container">
                <span class="button-container">
                    <button class="bouton6">Inscription</button>
                    <i class="fab fa-telegram"></i>
                </span>
            </div>
        </div>
    </div>
</div>

  </div>
  
  
    <div class="img1">
     <a href="./index.php">

      <input type="image" src="./image/flasharriere-removebg-preview.png">
     </a>
    </div>
    
   
    <!-- <secion class="position1" id="intitule_position1"> -->
    <!-- <div id="intitule_position1"> -->
    <script>
function afficherInfosParAnnee(numannee) {
    const api_url = 'https://filrouge.uha4point0.fr/V2/UHA40/certifications';

    fetch(api_url)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                data.forEach(item => {
                    if (item.annee == numannee) {
                        const position1 = document.createElement('div');
                        position1.className = 'position1';
                        position1.id = 'intitule_' + item.intitule;
                        
                        const h1 = document.createElement('h1');
                        h1.textContent = item.intitule;

                        const img4 = document.createElement('img');
                        img4.className = 'img4';
                        img4.src = item.image;
                        img4.alt = 'Image';

                        const bouton5 = document.createElement('div');
                        bouton5.className = 'bouton5';

                        const a = document.createElement('a');
                        a.href = item.lienOpenClassRoom;
                        a.className = 'bouton7';
                        a.textContent = 'Accéder à OpenClassroom';

                        bouton5.appendChild(a);
                        position1.appendChild(h1);
                        position1.appendChild(img4);
                        position1.appendChild(bouton5);

                        document.body.appendChild(position1);
                    }
                });
            }
        })
        .catch(error => {
            console.error('Une erreur s\'est produite :', error);
        });
}

// Récupérer l'année depuis les paramètres d'URL
const urlParams = new URLSearchParams(window.location.search);
const anneeSaisie = urlParams.get('annee');

if (anneeSaisie) {
    afficherInfosParAnnee(anneeSaisie);
}
</script>










<script> src="test.js" </script>



</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>UHA 4.0 L'école du Numérique, une formation informatique à Mulhouse</title>
    <link rel="icon" type="image/png" href="./image/téléchargement-removebg-preview.png"/>
    <link rel="stylesheet" type="text/css" href="./main.css"/>
</head>
<body>
    <header>
     <img class="img3" src="./image/cropped-uha40_fst-1.png">
        <div>
        <div class="open-btn">
    </div>
    <div class="login-popup">
     <div class="form-popup" id="popupForm" style="display: none;">
        <form action="./adminpage.php" class="form-container">
            <h2>Veuillez vous connecter</h2>
            <label for="username"><strong>Nom d'utilisateur</strong></label>
            <input type="text" id="username" placeholder="Nom d'utilisateur" name="username" required />
            <label for="password"><strong>Mot de passe</strong></label>
            <input type="password" id="password" placeholder="Mot de passe" name="password" required />
            <button type="button"  onclick="checkLogin()">Connecter</button>
            <button type="button"  onclick="closeForm()">Fermer</button>
        </form>
     </div>
   </div>     
        <nav>
        <ul>
        <button style="color: black;"  onclick="openForm()"> Login </button>
                 <li><a href="#">Contact ▼</a>
                     <ul>
                         <?php
                           $numid = $_GET['id'];

                           include_once('config.php'); 


                            try {
                               $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);

                               $anneesQuery = $bdd->prepare("SELECT mail FROM ApiAnnees WHERE id = 1");
                               $anneesQuery->execute();
  
                               while ($anneesData = $anneesQuery->fetch()) {
                                      echo '<li><a href="#">' . htmlspecialchars($anneesData["mail"], ENT_QUOTES, 'UTF-8') . '</a></li>';
                                }
                            }catch (PDOException $e) {
                                echo 'Erreur : ' . $e->getMessage();
                             }

                            
                        ?>
                 </ul>
            </li>
        </ul>
    </nav>
     </div>
    </header>

    <video autoplay muted loop id="background-video">
        <source src="./video/video2.mp4" type="video/mp4">
    </video>
   <div >
     <img
    src="./image/logouha4.0.png"
    title="L'école du Numérique , une formation universitaire en développement informatique 100% projet à Mulhouse, en Alsace!" />
   </div>
    <br>

    <h1>Intégrez la formation universitaire professionnalisante en mode projets</h1>

    <div class="bouton-container">
    <?php
    $mysqli = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    if (!$mysqli) {
        die("Échec de la connexion à la base de données: " . mysqli_connect_error());
    }

    $query = "SELECT id, nom FROM ApiAnnees";
    $result = mysqli_query($mysqli, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="bouton1">';
        echo '<div class="positionimage">';
        echo '<button class="bouton togg" data-target="content' . $row['id'] . '">' . $row['nom'] . '</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>


<div id="info-container" ></div>
    


    <script src="main.js"></script>
</body>
</html>

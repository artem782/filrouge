<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>UHA 4.0 L'école du Numérique, une formation informatique à Mulhouse</title>
    <link rel="icon" type="image/png" href="./image/téléchargement-removebg-preview.png"/>
    <link rel="stylesheet" type="text/css" href="./programme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function updatePage(page) {
            const anneeSaisie = <?php echo isset($_GET['annee']) ? $_GET['annee'] : 'null'; ?>;
            if (anneeSaisie) {
                window.location.href = `?annee=${anneeSaisie}&page=${page}`;
            }
        }
    </script>
</head>
<body>
    <header>
        <img class="img3" src="./image/cropped-uha40_fst-1.png">
        <nav>
            <?php
            // Établir une connexion à la base de données (vous devez configurer ces valeurs)
            include_once('config.php');
            
            $conn = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

            // Vérifier la connexion
            if (!$conn) {
                die("La connexion à la base de données a échoué: " . mysqli_connect_error());
            }

            // Fonction pour afficher les informations depuis la base de données
            function afficherIntituleParAnnee($intituleannee, $conn) {
                $sql = "SELECT intitule FROM ApiCertifications WHERE annee = " . $intituleannee;
                $result = mysqli_query($conn, $sql);
            
                if (mysqli_num_rows($result) > 0) {
                    echo '<ul class="niveau1">';
                    echo '<li class="sousmenu">';
                    echo '<a href="#"><h1 class="h2" >Parcours ▼</h1></a>';
                    echo '<ul class="niveau2">';
            
                    while ($row = mysqli_fetch_assoc($result)) {
                        $intitule = $row['intitule'];
                        echo '<li class="scrollButton"><a href="#intitule_' . $intitule . '">' . htmlspecialchars($intitule, ENT_QUOTES, 'UTF-8') . '</a></li>';
                    }
            
                    echo '</ul>';
                    echo '</li>';
                    echo '</ul>';
                } else {
                    echo "Aucun résultat trouvé.";
                }
            }

            // Récupérer l'année depuis les paramètres d'URL
            if (isset($_GET['annee'])) {
                $anneeSaisie = $_GET['annee'];

                // Utilisation de la fonction pour afficher les informations depuis la base de données
                afficherIntituleParAnnee($anneeSaisie, $conn);
            }

            // Fermer la connexion à la base de données
            ?>
        </nav>
    </header>
    <main>
        <div>
            <button id="btnScrollToTop"></button>
            <script src="btnScrollTop.js"></script>
        </div>
    

    <div class="position2">
        <img src="./image/logouha4.0.png" title="L'école du Numérique , une formation universitaire en développement informatique 100% projet à Mulhouse, en Alsace !" />
        <div class="position3">
            <?php
            // Établir une connexion à la base de données
            $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("La connexion à la base de données a échoué : " . $connexion->connect_error);
            }

            function afficherNomParAnnee($numannee, $connexion) {
                // Évitez les attaques par injection SQL en utilisant des requêtes préparées
                $programmeRequete = $connexion->prepare("SELECT nom FROM ApiAnnees WHERE id = ?");
                $programmeRequete->bind_param("i", $numannee);
                $programmeRequete->execute();
                $resultat = $programmeRequete->get_result();

                if ($resultat->num_rows > 0) {
                    $row = $resultat->fetch_assoc();
                    echo '<h1 class="h1"> Programme de la formation ' . htmlspecialchars($row["nom"], ENT_QUOTES, 'UTF-8') . '</h1>';
                }

                $programmeRequete->close();
            }

            if (isset($_GET['annee'])) {
                $anneeSaisie = $_GET['annee'];

                // Utilisation de la fonction pour afficher les informations pour l'année saisie
                afficherNomParAnnee($anneeSaisie, $connexion);
            }
            ?>
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

    <div class="img1">
        <a href="./index.php">
            <input type="image" src="./image/flasharriere-removebg-preview.png">
        </a>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <button id="prevPage">Page précédente</button>
        <button id="nextPage">Page suivante</button>
    </div>
    <div id="contentContainer"></div>
    <!-- TODO: tu devrais mettre le code JS dans un fichier à part -->
    <script src="programme.js"></script>
    <script src="php.js"></script>
    </main>
</body>
</html>

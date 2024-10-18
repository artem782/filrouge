
 <nav>
        <ul>
            <a class="link" style="color: black;" href="./adminpage.php"> Login </a>
                 <li><a href="#">Contact ▼</a>
                     <ul>
                         <?php
                           $numid = $_GET['id'];

                           $serveur = 'localhost';
                           $base_de_donnees = 'fil_rouge_401_Artem_Tatkov';
                           $utilisateur = 'root';
                           $mot_de_passe = '';

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
















<?php
$numid = $_GET['id'];


try {
    $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);

    $anneesQuery = $bdd->prepare("SELECT id, nom, description, concerne FROM ApiAnnees");
    $anneesQuery->execute();

    while($anneesData = $anneesQuery->fetch()) {
        $annee = htmlspecialchars($anneesData["id"], ENT_QUOTES, 'UTF-8');
        echo '<div class="position" id="d' . $annee . '">';
        echo '<br>';
        echo '<p>Nom : ' . htmlspecialchars($anneesData["nom"], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Description : ' . htmlspecialchars($anneesData["description"], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Concerne : ' . htmlspecialchars($anneesData["concerne"], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Compétences :</p>';
        echo '<ul>';
        
        // Récupérer les compétences associées à cette année de formation
        $competencesQuery = $bdd->prepare("SELECT C.nom FROM CompetencesAnnees CA
        INNER JOIN Competences C ON CA.id_competence = C.id
        WHERE CA.id_annees = :id_annee");
        $competencesQuery->bindParam(':id_annee', $annee, PDO::PARAM_INT);
        $competencesQuery->execute();

        while($competenceData = $competencesQuery->fetch()) {
            echo '<li class="li">' . htmlspecialchars($competenceData["nom"], ENT_QUOTES, 'UTF-8') . '</li>';
        }

        echo '</ul>';
        echo '<br><br><br>';
        echo '<a class="link" href="./filrouge2.php?annee=' . $annee . '">';
        echo '<div class="bouton5">';
        echo '<button class="bouton6">Intégrer ' . htmlspecialchars($anneesData["nom"], ENT_QUOTES, 'UTF-8') . '</button>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>




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
if (isset($_GET['annee'])) 
    $anneeSaisie = $_GET['annee'];
    
    // Utilisation de la fonction pour afficher les informations pour l'année saisie
  afficherNomParAnnee($anneeSaisie, $connexion);

?>




<?php
// Établir une connexion à la base de données (vous devez configurer ces valeurs)


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
<script>

function afficherInfosParAnnee(numannee) {
    const api_url = 'http://localhost/apiCertifications.php'; //  l'URL de l'API locale

    fetch(api_url)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                data.forEach(item => {
                    if (item.annee == numannee) {
                        const position1 = document.createElement('div');
                        position1.className = 'position1';
                        position1.id = 'intitule_' + item.intitule;
                        
                        
                        const h2 = document.createElement('h2');
                        h2.textContent = item.intitule;

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
                        position1.appendChild(h2);
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



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('config.php'); 


$mysqli = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué: " . $mysqli->connect_error);
}

// Fonction pour récupérer les certifications
function getCertifications() {
    global $mysqli;

    // Paramètre de tri par année
    $annee = isset($_GET['annee']) ? intval($_GET['annee']) : 1;

    
    if (isset($_GET['page'])) {
        // Get the requested page
        $page = max(1, (int)$_GET['page']);

        // Pagination parameters
        $CertificationsPerPage = 2; // Nombre de certifications par page

        // Calculate the offset based on the requested page
        $offset = ($page - 1) * $CertificationsPerPage;

        // Query with sorting by year and pagination
        $query = "SELECT id, annee, intitule, lienOpenClassRoom, image FROM ApiCertifications WHERE annee = $annee LIMIT $offset, $CertificationsPerPage";
    } else {
        // No pagination parameters provided, so return all certifications for the specified year
        $query = "SELECT id, annee, intitule, lienOpenClassRoom, image FROM ApiCertifications WHERE annee = $annee";
    }

    $result = $mysqli->query($query);

    if (!$result) {
        http_response_code(500); // Internal Server Error
        die('Erreur dans la requête SQL : ' . $mysqli->error);
    }

    $certifications = array();

    while ($row = $result->fetch_assoc()) {
        $certifications[] = $row;
    }

    return $certifications;
}

// Créer un tableau de certifications
$tabCertif = getCertifications();

// Convertir le tableau en JSON en gardant les chiffres en tant que chiffres (sans guillemets)
$json = json_encode($tabCertif, JSON_NUMERIC_CHECK);

// Envoyer le JSON en tant que réponse HTTP
header('Content-Type: application/json');
echo $json;
?>

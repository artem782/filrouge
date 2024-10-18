
<?php
include_once('config.php'); 

 

try {
    $mysqlClient = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);

    $response = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['annee']) && isset($_POST['intitule']) && isset($_POST['lienOpenClassRoom']) && isset($_POST['image'])) {
            $annee = $_POST['annee'];
            $intitule = $_POST['intitule'];
            $lienOpenClassRoom = $_POST['lienOpenClassRoom'];
            $image = $_POST['image'];
            
            $insertAnnee = $mysqlClient->prepare('INSERT INTO ApiCertifications(annee, intitule, lienOpenClassRoom, image) VALUES (:annee, :intitule, :lienOpenClassRoom, :image)');
            
            if ($insertAnnee->execute(['annee' => $annee, 'intitule' => $intitule, 'lienOpenClassRoom' => $lienOpenClassRoom, 'image' => $image])) {
                //TODO : ton API devrait retourner les informations au format JSON
               $response = ['message'=>"Le programme a été ajouté avec succès à la base de données."];
            } else {
               $response = ['error' => "Erreur lors de l'ajout de l'année à la base de données."];
            }
        } else {
            $response = ['error' => "Veuillez fournir toutes les données nécessaires."];
        }
    }
} catch (PDOException $e) {
    $response = ['error' => ' Erreur de connexion à la base de données : ' . $e->getMessage()];
}

// Définir les en-têtes de réponse pour indiquer le type de contenu JSON
header('Content-Type: application/json');

// Encoder la réponse au format JSON et l'afficher
echo json_encode($response);
?>

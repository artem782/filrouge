<?php
include_once('config.php'); 

try {
    $mysqlClient = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);

    $response = []; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['description']) && isset($_POST['concerne']) && isset($_POST['competence'])) {
            $nom = $_POST['nom'];
            $mail = $_POST['mail'];
            $description = $_POST['description'];
            $concerne = $_POST['concerne'];
            $competence = $_POST['competence'];

            $insertCompetence = $mysqlClient->prepare('INSERT INTO Competences(nom) VALUES (:competence)');
            if ($insertCompetence->execute(['competence' => $competence])) {
                $insertAnnee = $mysqlClient->prepare('INSERT INTO ApiAnnees(nom, mail, description, concerne) VALUES (:nom, :mail, :description, :concerne)');
                
                if ($insertAnnee->execute(['nom' => $nom, 'mail' => $mail, 'description' => $description, 'concerne' => $concerne])) {
                    $response = ['message' => "L'année a été ajoutée avec succès à la base de données."];
                } else {
                    $response = ['error' => "Erreur lors de l'ajout de l'année à la base de données."];
                }
            } else {
                $response = ['error' => "Erreur lors de l'ajout de la compétence à la base de données."];
            }
        } else {
            $response = ['error' => "Veuillez fournir toutes les données nécessaires, y compris la compétence."];
        }
    }
} catch (PDOException $e) {
    $response = ['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()];
}

header('Content-Type: application/json');

echo json_encode($response); 
?>
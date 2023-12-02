<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('config.php'); 


$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe);

// Vérifiez la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion au serveur MySQL : " . $connexion->connect_error);
}

// Supprimer la base de données si elle existe déjà
$drop_database_query = "DROP DATABASE IF EXISTS $base_de_donnees";
if ($connexion->query($drop_database_query) === true) {
    echo "La base de données existante a été supprimée .<br>";
} else {
    echo "Erreur lors de la suppression de la base de données existante : " . $connexion->error . "<br>";
}

// Créer une nouvelle base de données
$create_database_query = "CREATE DATABASE $base_de_donnees";
if ($connexion->query($create_database_query) === true) {
    echo "La nouvelle base de données a été créée avec succès.<br>";
} else {
    echo "Erreur lors de la création de la nouvelle base de données : " . $connexion->error . "<br>";
}

// Sélectionnez la base de données nouvellement créée
$connexion->select_db($base_de_donnees);


// creation des tables


// Créer la table ApiAnnees si elle n'existe pas
$create_table_annees_query = "CREATE TABLE IF NOT EXISTS ApiAnnees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    concerne VARCHAR(255) NOT NULL
)";
$connexion->query($create_table_annees_query);

// Créer la table Competences si elle n'existe pas
$create_table_competences_query = "CREATE TABLE IF NOT EXISTS Competences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
)";
$connexion->query($create_table_competences_query);

// Créer la table CompetencesAnnees si elle n'existe pas
$create_table_competencesannees_query = "CREATE TABLE IF NOT EXISTS CompetencesAnnees (
    id_annees INT NOT NULL,
    id_competence INT NOT NULL,
    FOREIGN KEY (id_annees) REFERENCES ApiAnnees(id),
    FOREIGN KEY (id_competence) REFERENCES Competences(id),
    PRIMARY KEY (id_annees, id_competence)

)";
$connexion->query($create_table_competencesannees_query);


// Créer la table ApiCertifications si elle n'existe pas
$create_table_apicertifications_query = "CREATE TABLE IF NOT EXISTS ApiCertifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    annee INT NOT NULL,
    intitule VARCHAR(255) NOT NULL,
    lienOpenClassRoom VARCHAR(255) NOT NULL,
    image VARCHAR(500) NOT NULL,
    FOREIGN KEY (annee) REFERENCES ApiAnnees(id)
)";
$connexion->query($create_table_apicertifications_query);

// Recuperation des données des api


$api_annees = 'https://filrouge.uha4point0.fr/V2/UHA40/annees';
$api_certifications = 'https://filrouge.uha4point0.fr/V2/UHA40/certifications';

// Récupérez les données de l'API
$annees = file_get_contents($api_annees);
$certifications = file_get_contents($api_certifications);

if ($annees !== false && $certifications !== false) {
    $data_annees = json_decode($annees, true);
    $data_certifications = json_decode($certifications, true);

// Remplissage des info des competences    
 foreach ($data_annees as $entry) {
    $id = $connexion->real_escape_string($entry['id']);
    $nom = $connexion->real_escape_string($entry['nom']);
    $mail = $connexion->real_escape_string($entry['mail']);
    $description = $connexion->real_escape_string($entry['description']);
    $concerne = $connexion->real_escape_string($entry['concerne']);


    $sql = "INSERT INTO ApiAnnees (id, nom, mail, description, concerne) VALUES ('$id', '$nom', '$mail', '$description', '$concerne')";
    $connexion->query($sql);
     

    if (isset($entry['compétences']) && is_array($entry['compétences'])) {
        foreach ($entry['compétences'] as $competence) {
            $competence = $connexion->real_escape_string($competence);

            $existing_competence_query = "SELECT id FROM Competences WHERE nom = '$competence'";
            $existing_competence_result = $connexion->query($existing_competence_query);

            if ($existing_competence_result->num_rows == 0) {
                $insert_competence_query = "INSERT INTO Competences (nom) VALUES ('$competence')";
                if ($connexion->query($insert_competence_query) === true) {
                    $id_competence = $connexion->insert_id;
                    $insert_annees_query = "INSERT INTO CompetencesAnnees (id_annees, id_competence) VALUES ('$id', '$id_competence')";
                    $connexion->query($insert_annees_query);
                }
            } else {
                $row = $existing_competence_result->fetch_assoc();
                $id_competence = $row['id'];

                $insert_annees_query = "INSERT INTO CompetencesAnnees (id_annees, id_competence) VALUES ('$id', '$id_competence')";
                $connexion->query($insert_annees_query);
            }
        }
    }
}

// Ajout des informations dans la table Certifications
foreach ($data_certifications as $entry) {
    $id = $connexion->real_escape_string($entry['id']);
    $annee = $connexion->real_escape_string($entry['annee']);
    $intitule = $connexion->real_escape_string($entry['intitule']);
    $lienOpenClassRoom = $connexion->real_escape_string($entry['lienOpenClassRoom']);
    $image = $connexion->real_escape_string($entry['image']);

    $sql = "INSERT INTO ApiCertifications (id, annee, intitule, lienOpenClassRoom, image) VALUES ('$id', '$annee', '$intitule', '$lienOpenClassRoom', '$image')";
    $connexion->query($sql);
    
}
}
 
$connexion->close();
?>


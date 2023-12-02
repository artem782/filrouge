<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('config.php'); 


// Vérifiez la connexion

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe);
if ($connexion->connect_error) {
    die("Échec de la connexion au serveur MySQL : " . $connexion->connect_error);
}

// Supprimer la base de données si elle existe déjà
$drop_database_query = "DROP DATABASE IF EXISTS $base_de_donnees";
if ($connexion->query($drop_database_query) === true) {
    echo "La base de données existante a été supprimée avec succès.<br>";
} else {
    echo "Erreur lors de la suppression de la base de données existante : " . $connexion->error . "<br>";
}

$connexion->close();
?>

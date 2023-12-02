<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('config.php'); 

header('Content-Type: application/json');

try {
    $mysqlClient = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion à la base de données : ' . $e->getMessage()]);
    exit;
}

if (!isset($_POST['id'])) {
    echo json_encode(['error' => 'Il faut un identifiant valide pour supprimer une année.']);
} else {
    $id = $_POST['id'];

    $deleteCertificationsStatement = $mysqlClient->prepare('DELETE FROM ApiCertifications WHERE annee = :id');
    $deleteCertificationsStatement->execute([
        'id' => $id,
    ]);
    $deleteCompetencesAnneesStatement = $mysqlClient->prepare('DELETE FROM CompetencesAnnees WHERE id_annees = :id');
    $deleteCompetencesAnneesStatement->execute([
        'id' => $id,
    ]);

    $deleteAnneeStatement = $mysqlClient->prepare('DELETE FROM ApiAnnees WHERE id = :id');
    $deleteAnneeStatement->execute([
        'id' => $id,
    ]);

    echo json_encode(['message' => 'L\'année a été supprimée avec succès.']);
}
?>

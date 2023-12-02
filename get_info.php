<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include_once('config.php'); 


    try {
        $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);
        $query = $bdd->prepare("SELECT nom, description, concerne FROM ApiAnnees WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();

        if ($data) {
            echo '<div class="position">';
            echo '<p>Nom : ' . htmlspecialchars($data["nom"], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p>Description : ' . htmlspecialchars($data["description"], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p>Concerne : ' . htmlspecialchars($data["concerne"], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p>Compétences :</p>';
            echo '<ul>';

            $competencesQuery = $bdd->prepare("SELECT C.nom FROM CompetencesAnnees CA
                INNER JOIN Competences C ON CA.id_competence = C.id
                WHERE CA.id_annees = :id_annee");
            $competencesQuery->bindParam(':id_annee', $id, PDO::PARAM_INT);
            $competencesQuery->execute();

            while ($competenceData = $competencesQuery->fetch()) {
                echo '<li class="li">' . htmlspecialchars($competenceData["nom"], ENT_QUOTES, 'UTF-8') . '</li>';
            }
            echo '</ul>';
            echo '<br><br><br><br><br><br><br>';
            echo '<a class="link" href="./programme.php?annee=' . $id . '">';
            echo '<div class="bouton5">';
            echo '<button class="bouton6">Intégrer ' . htmlspecialchars($data["nom"], ENT_QUOTES, 'UTF-8') . '</button>';
            echo '</div>';
            echo '</a>';
            echo '</div>';

        } else {
            echo "Aucune donnée trouvée pour l'ID : $id";
        }
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>

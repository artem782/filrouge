

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>UHA 4.0 L'école du Numérique, une formation informatique à Mulhouse</title>
    <link rel="icon" type="image/png" href="./image/téléchargement-removebg-preview.png"/>
    <link rel="stylesheet" type="text/css" href="./adminpage.css"/>
    <script src="adminpage.js" defer ></script>
</head>
<!--TODO : le header est dans le body -->
<body>
<header>
<div class="img1">
      <a href="./index.php">

       <input type="image" src="./image/flasharriere-removebg-preview.png">
      </a>
</div>
<h1 class="positionh1">Page d'admin </h1>
    <div> 
        <ul>
            <button class="bouton1" onclick="openForm()"  >Ajouter une année de la Formation </button>
            <button class="bouton1" onclick="openForm1()" >Ajouter le programme de l'année </button>
            <button class="bouton1" onclick="openForm2()" >Supprimer une année de la Formation </button>
            <button class="bouton1"id="supp_bdd" >Supprimer la base de donnée</button>
            <button class="bouton1" id="reset_bdd" >Réinitialiser la base de donnée</button>
            </a>
        </ul>
    </div>
    <br>
</header>

   <div class="form1" id="popupForm" style="display: none;">

     <form action="#" method="POST" id="myForm">
            <div class="">
                <label for="nom"  style="color:white;">Ajout année</label>
                <input type="text" class=""  id="nom" name="nom" aria-describedby="nom-help">
            </div>
            <div class="">
                <label for="description" >Description de l'année</label>
                <textarea class="" placeholder="Descritpion.." id="description" name="description"></textarea>
            </div>
            <div class="">
                <label for="mail" >Mail</label>
                <input class="" placeholder="mail" id="mail" name="mail">
            </div>
            <div class="">
                <label for="concerne" >Concerne les personnes?</label>
                <textarea class="" placeholder="bac etc" id="concerne" name="concerne"></textarea>
            </div>
            <div class="">
                <label for="competence" >Compétences</label>
                <textarea class="" placeholder="compétences" id="competence" name="competence"></textarea>
            </div>
            <button type="submit" class="bouton-form1" id="env_bdd">Envoyer</button>
            <button type="button" class="bouton-form1"  onclick="closeForm()">Fermer</button>
     </form>

    </div>

    <div class="form2" id="popupForm1" style="display: none;">

<form action="#" method="POST" id="myForm2" >
       <div class="">
           <label for="annee"  style="color:white;">Ajout année</label>
           <input type="text" class="" placeholder="nombre" id="annee" name="annee" aria-describedby="annee-help">
       </div>
       <div class="">
           <label for="intitule" >Intitulé</label>
           <textarea class="" placeholder="Intitulé.." id="intitule" name="intitule"></textarea>
       </div>
       <div class="">
           <label for="lienOpenClassRoom" >lienOpenClassRoom</label>
           <textarea class="" placeholder="lien" id="lienOpenClassRoom" name="lienOpenClassRoom"></textarea>
       </div>
       <div class="">
           <label for="image" >Image</label>
           <textarea class="" placeholder="lien" id="image" name="image"></textarea>
       </div>
       
       <button type="submit" class="bouton-form1" id="env2_bdd">Envoyer</button>
       <button type="button" class="bouton-form1" onclick="closeForm1()">Fermer</button>
</form>

</div>
<div class="form3" id="popupForm2" style="display: none;"> 

<form method="POST" action="#" id="myForm3">
    <label for="id">Choisissez une année à supprimer </label>
    <select name="id">
        <?php
      include_once('config.php'); 

        try {
            $bdd = new PDO("mysql:host=$serveur;dbname=$base_de_donnees;charset=utf8", $utilisateur, $mot_de_passe);

            $anneesQuery = $bdd->prepare("SELECT id, nom FROM ApiAnnees"); 
            $anneesQuery->execute();

            while ($anneesData = $anneesQuery->fetch()) {
                echo '<option value="' . $anneesData["id"] . '">' . htmlspecialchars($anneesData["nom"], ENT_QUOTES, 'UTF-8') . '</option>';
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        ?>
    </select>

    <button type="submit" class="bouton-form2" id="env3_bdd">Supprimer l'année </button>
    <button type="button" class="bouton-form2" onclick="closeForm2()">Fermer</button>

</form>
</div>



</body>
</html>





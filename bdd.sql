DROP DATABASE IF EXISTS fil_rouge_401_Artem_Tatkov;

CREATE DATABASE IF NOT EXISTS fil_rouge_401_Artem_Tatkov;

USE fil_rouge_401_Artem_Tatkov;

-- Table pour stocker les compétences
CREATE TABLE Competences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE ApiAnnees(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    concerne VARCHAR(255) NOT NULL
);

CREATE TABLE CompetencesAnnees (
    -- id INT AUTO_INCREMENT PRIMARY KEY,
    id_annees INT NOT NULL,
    id_competence INT NOT NULL,
    FOREIGN KEY (id_annees) REFERENCES ApiAnnees(id),
    FOREIGN KEY (id_competence) REFERENCES Competences(id),
    PRIMARY KEY (id_annees, id_competence)
    
);

CREATE TABLE ApiCertifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    annee INT NOT NULL,
    intitule VARCHAR(255) NOT NULL,
    lienOpenClassRoom VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (annee) REFERENCES ApiAnnees(id)
);

INSERT INTO Competences (nom)
VALUES
    ('HTML/CSS'),
    ('JS'),
    ('PHP'),
    ('SQL'),
    ('Projet'),
    ('3-tiers'),
    ('git'),
    ('POO'),
    ('framework web'),
    ('N-tiers'),
    ('UNIX'),
    ('MVP'),
    ('merges'),
    ('UML'),
    ('Reseau'),
    ('Mobile'),
    ('BDD avancée'),
    ('CI-CD'),
    ('Tests'),
    ('Architecture');

-- Insertion de données depuis la première API (annees)
INSERT INTO ApiAnnees (nom, mail, description, concerne)
VALUES
    ('UHA 4.0.0', 'uha4point0@gmail.fr', 'UHA 4.0.0 est une formation d''une année permettant aux non bacheliers et aux personnes sans expériences de développement d''accéder au monde du développement logiciel.', 'Toutes personnes au niveau bac'),
    ('UHA 4.0.1', 'uha4point0@gmail.fr', 'Les étudiants en 4.0.1 se forment aux différentes technologies employées dans la planète web; avec pour objectif de devenir développeur Web.', 'Toutes personnes titulaire du bac et ayant dévoppés en autonomie ou titulaire du DU 4.0.0'),
    ('UHA 4.0.2', 'uha4point0@gmail.fr', 'Afin d''élargir les horizons sur lesquels ils pourront intervenir, les étudiants en 4.0.2 se forment au développement Objet, aux frameworks de développement web ainsi qu''aux prémisses de la gestion de projet.', 'Toutes personnes avec un bac+2 relatif à l''informatique ou titulaire du DU1'),
    ('UHA 4.0.3', 'uha4point0@gmail.fr', 'Cette année a pour objectif d''apprendre à l''étudiant à devenir acteur dans l''ensemble du cycle de développement de toute solution logiciel. Il abordera le développement d''applications mobiles, la gestion de projet, le CI-CD.', 'Toutes personnes titulaire du DU2');

-- Insertion de données des competences
INSERT INTO CompetencesAnnees (id_annees, id_competence)
VALUES
    (1, 1), (1, 2), (1, 3), (1, 4), 
    (2, 1), (2, 2), (2, 3), (2, 5), (2, 4), (2, 6), (2, 7), 
    (3, 8), (3, 9), (3, 5), (3, 10), (3, 11), (3, 12), (3, 13), (3, 14), (3, 15), 
    (4, 12), (4, 16), (4, 17), (4, 18), (4, 19), (4, 20);


-- Insertion de données depuis la deuxième API (certifications)
INSERT INTO ApiCertifications (annee, intitule, lienOpenClassRoom, image)
VALUES
    ( 2, 'Apprenez à créer votre site web avec HTML5 et CSS3', 'https://openclassrooms.com/courses/apprenez-a-creer-votre-site-web-avec-html5-et-css3', 'https://user.oc-static.com/files/339001_340000/339311.png'),
    ( 1, 'Apprenez à programmer en C !', 'https://openclassrooms.com/courses/apprenez-a-programmer-en-c', 'https://user.oc-static.com/files/359001_360000/359044.png'),
    ( 2, 'Apprenez à coder en javascript !', 'https://openclassrooms.com/courses/apprenez-a-coder-avec-javascript', 'https://s3-eu-west-1.amazonaws.com/sdz-upload/prod/upload/JavaScript-logo3.png'),
    ( 3, 'Débutez l''analyse logicielle avec UML !', 'https://openclassrooms.com/courses/debutez-l-analyse-logicielle-avec-uml', 'https://sdz-upload.s3.amazonaws.com/prod/upload/Fotolia_39308785_Subscription_Monthly_XL_©%20raywoo1.jpg'),   
    ( 4, 'Gérez votre projet avec une équipe Scrum', 'https://openclassrooms.com/courses/gerez-votre-projet-avec-une-equipe-scrum', 'https://user.oc-static.com/upload/2017/10/04/15071250336374_scrum-diagram.png'),     
    ( 1, 'Découvrir la programmation créative', 'https://openclassrooms.com/fr/courses/3075566-decouvrir-la-programmation-creative', 'https://yt3.ggpht.com/a/AGF-l7_iZa1IGxj5jfq520RVRRgQUIR3Brax6ggl=s900-c-k-c0xffffffff-no-rj-mo'),
    ( 1, 'Apprenez à créer votre site web avec HTML5 et CSS3', 'https://openclassrooms.com/courses/apprenez-a-creer-votre-site-web-avec-html5-et-css3', 'https://user.oc-static.com/files/339001_340000/339311.png'),
    ( 1, 'Créez votre site professionnel avec WordPress', 'https://openclassrooms.com/fr/courses/3302211-creez-votre-site-professionnel-avec-wordpress', 'https://s.w.org/style/images/about/simplified.png'),
    ( 1, 'initiez vous au design thinking', 'https://openclassrooms.com/fr/courses/3013836-initiez-vous-au-design-thinking', 'https://images.squarespace-cdn.com/content/v1/5ba51d97a0cd275a0f80d3ed/1551221865269-3SEYDZPB6SWUPZF20BGP/ke17ZwdGBToddI8pDm48kDZqyJCH6-4IMMFun-eXo8VZw-zPPgdn4jUwVcJE1ZvWEtT5uBSRWt4vQZAgTJucoTqqXjS3CfNDSuuf31e0tVEHAO-lWWgb_zBs0PeyVZzkwYoCA-sMKnNif7Bv0VVdqJAuzE1eM6SlJUBvP4BxmE0/Artboard+4.jpg'),
    ( 1, 'Composez des interfaces utilisateurs en Material Design', 'https://openclassrooms.com/fr/courses/3936801-composez-des-interfaces-utilisateurs-en-material-design', 'https://s3.amazonaws.com/ionic-marketplace/ionic-material-design/icon.png'),
    ( 1, 'Reprenez le contrôle à l''aide de Linux !', 'https://openclassrooms.com/fr/courses/43538-reprenez-le-controle-a-laide-de-linux', 'https://images.vexels.com/media/users/3/140692/isolated/lists/72d1f12edf758d24f5b6db73bac4f297-linux-logo.png'),
    ( 1, 'Comprendre le Web', 'https://openclassrooms.com/courses/comprendre-le-web', 'https://cdn0.iconfinder.com/data/icons/internet-line/512/Internet_Line-20-512.png'),
    ( 1, 'Connecter le réseau', 'https://openclassrooms.com/courses/connecter-le-reseau', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4WNP0qaamY-Uro7F9HdNMubHf9HPBNU0JF3Lm-vyQsy4qZsn1'),
    ( 1, 'PIX', 'https://pix.fr', 'https://pix.fr/images/pix-logo.svg'),
    ( 2, 'Créez des pages web interactives avec Javascript', 'https://openclassrooms.com/courses/creez-des-pages-web-interactives-avec-javascript', 'https://opusapplabs.com/wp-content/uploads/2017/10/js-dom.png'),
    ( 2, 'Propulsez votre site avec WordPress', 'https://openclassrooms.com/courses/1891206/next-page-to-do', 'https://d1q6f0aelx0por.cloudfront.net/product-logos/fcbd05b8-ec7e-4191-80f6-dae8ec3d9d25-wordpress.png'),
    ( 2, 'Prenez en main bootstrap', 'https://openclassrooms.com/courses/prenez-en-main-bootstrap', 'http://www.culliton.net/assets/images/bootstrap-logo.png'),
    ( 2, 'Gérez votre code avec Git et GitHub', 'https://openclassrooms.com/courses/2342361/next-page-to-do', 'https://git-scm.com/images/logo@2x.png'),
    ( 2, 'Concevez votre site web avec PHP et MySQL', 'https://openclassrooms.com/courses/concevez-votre-site-web-avec-php-et-mysql', 'https://www.php.net/images/logos/php-logo.svg'),                                            
    ( 3, 'Démarrez votre projet avec Java', 'https://openclassrooms.com/fr/courses/4975451-demarrez-votre-projet-avec-java', 'https://upload.wikimedia.org/wikipedia/fr/thumb/2/2e/Java_Logo.svg/550px-Java_Logo.svg.png'),
    ( 3, 'Apprenez l’objet avec Java', 'https://openclassrooms.com/fr/courses/4989236-apprenez-l-objet-avec-java', 'https://upload.wikimedia.org/wikipedia/fr/thumb/2/2e/Java_Logo.svg/550px-Java_Logo.svg.png'),
    ( 3, 'Apprenez à programmer en Java', 'https://openclassrooms.com/courses/apprenez-a-programmer-en-java', 'https://upload.wikimedia.org/wikipedia/fr/thumb/2/2e/Java_Logo.svg/550px-Java_Logo.svg.png'),
    ( 3, 'Programmez avec le langage C++', 'https://openclassrooms.com/courses/programmez-avec-le-langage-c', 'https://ourcodeworld.com/public-media/gallery/categorielogo-5a284afe1346e.png'),
    ( 3, 'Débutez l''analyse logicielle avec UML', 'https://openclassrooms.com/courses/debutez-l-analyse-logicielle-avec-uml', 'https://www.projectsmart.co.uk/img/uml-logo.png'),
    ( 3, 'Reprenez le contrôle à l''aide de Linux !', 'https://openclassrooms.com/fr/courses/43538-reprenez-le-controle-a-laide-de-linux', 'https://images.vexels.com/media/users/3/140692/isolated/lists/72d1f12edf758d24f5b6db73bac4f297-linux-logo.png'),
    ( 3, 'Apprenez le fonctionnement des réseaux TCP/IP', 'https://openclassrooms.com/courses/apprenez-le-fonctionnement-des-reseaux-tcp-ip', 'https://cdn-images-1.medium.com/max/1200/1*02RbWDjlayP5LCjXPY9M-Q.png'),
    ( 3, 'Construisez des Microservices', 'https://openclassrooms.com/fr/courses/4668056-construisez-des-microservices', 'https://pivotal.gallerycdn.vsassets.io/extensions/pivotal/vscode-boot-dev-pack/0.0.8/1537205812649/Microsoft.VisualStudio.Services.Icons.Default'),
    ( 3, 'Développez des applications Web avec Angular', 'https://openclassrooms.com/fr/courses/4668271-developpez-des-applications-web-avec-angular', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_LtJR5C9Vhiz7kyy9uccr9UVk_yThcuNEVEbMVUnLqelk0meUmA'),
    ( 3, 'Développez votre site web avec le framework Symfony', 'https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony', ''),
    ( 4, 'Simplifiez vos développements JavaScript avec jQuery', 'https://openclassrooms.com/courses/simplifiez-vos-developpements-javascript-avec-jquery', 'https://ourcodeworld.com/public-media/gallery/categorielogo-5713d24f9fa5f.png'),
    ( 4, 'Administrez vos bases de données avec MySQL', 'https://openclassrooms.com/courses/administrez-vos-bases-de-donnees-avec-mysql', 'https://d1q6f0aelx0por.cloudfront.net/product-logos/0dd7193f-e747-4a15-b797-818b9fac3656-mysql.png'),
    ( 4, 'Maîtrisez les bases de données NoSQL', 'https://openclassrooms.com/courses/maitrisez-les-bases-de-donnees-nosql', 'https://cdn.iconscout.com/icon/free/png-256/mongodb-5-1175140.png'),
    ( 4, 'Modélisez, implémentez et requêtez une base de données relationnelle avec UML et SQL', 'https://openclassrooms.com/fr/courses/4055451-modelisez-implementez-et-requetez-une-base-de-donnees-relationnelle-avec-uml-et-sql', 'https://cdn4.iconfinder.com/data/icons/file-extension-2/256/sql-128.png'),
    ( 4, 'Développez une application pour Android', 'https://openclassrooms.com/courses/developpez-une-application-pour-android', 'https://support.appsflyer.com/hc/article_attachments/115011109089/android.png'),        
    ( 4, 'Développez votre première application pour iOS', 'https://openclassrooms.com/courses/developpez-une-app-pour-ios', 'https://styles.redditmedia.com/t5_2qh1f/styles/communityIcon_omsxpmvxkyx11.jpg?format=pjpg&s=33eed303e7a984e2eef974226567e7e88355abf1'),
    ( 4, 'Développez une application mobile multi-plateforme avec Ionic', 'https://openclassrooms.com/fr/courses/5098931-developpez-une-application-mobile-multiplateforme-avec-ionic', 'https://b.thumbs.redditmedia.com/2OKLeyyh40OngWk52sHJ6gtdFeq06JgUnIh1NFf6R5I.png'),
    ( 4, 'Structurez vos données avec XML', 'https://openclassrooms.com/courses/structurez-vos-donnees-avec-xml', 'http://icons.iconarchive.com/icons/custom-icon-design/flatastic-9/256/Xml-tool-icon.png');
            


// document.addEventListener('DOMContentLoaded', function () {
//     const button = document.querySelectorAll('button');


//     button.forEach(button => {
//         button.addEventListener('click', function () {
//             const targetId = button.getAttribute('data-target');
//             const targetDiv = document.getElementById(targetId);
//             if (targetDiv) {
//                 targetDiv.style.display = 'block';
//             }
//         });
//     });


function openForm() {
    document.getElementById("popupForm").style.display = "block";
}
function closeForm() {
    document.getElementById("popupForm").style.display = "none";
}
function openForm1() {
    document.getElementById("popupForm1").style.display = "block";
}
function closeForm1() {
    document.getElementById("popupForm1").style.display = "none";
}

function openForm2() {
    document.getElementById("popupForm2").style.display = "block";
}
function closeForm2() {
    document.getElementById("popupForm2").style.display = "none";
}


//TODO : attention à l'indentation = corrigé 
const envoyerButton2 = document.getElementById('env2_bdd');
const envoyerButton3 = document.getElementById('env3_bdd');

const envoyerButton = document.getElementById('env_bdd');
const suprimerButton = document.getElementById('supp_bdd');
const resetButton = document.getElementById('reset_bdd');
const myForm = document.getElementById('myForm');
const myForm2 = document.getElementById('myForm2');
const myForm3 = document.getElementById('myForm3');

resetButton.addEventListener('click', function () {
    const xhr = new XMLHttpRequest();
    console.log("click");
    xhr.open('POST', './resetbdd.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Base de données réinitialisée avec succès.');
            alert("La base de donnée a été réinitialisée avec succès.");
        }
    };
    xhr.send();
});

suprimerButton.addEventListener('click', function () {
    const xhr = new XMLHttpRequest();
    console.log("click");
    xhr.open('POST', './suppbdd.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Base de données supprimée avec succès.');
            alert("La base de donnée a été supprimée avec succès.");
        }
    };
    xhr.send();
});

envoyerButton.addEventListener('click', function (e) {
    e.preventDefault(); // Empêche l'envoi par défaut du formulaire

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './createAnnee.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                alert("L'année a été ajoutée avec succès à la base de données.");
                popupForm.style.display = 'none'; // Masquer le formulaire
            } else {
                alert("Une erreur s'est produite lors de l'envoi des données.");
            }
        }
    };

    // Récupérer les données du formulaire
    const formData = new FormData(myForm);

    // Envoyer les données du formulaire
    xhr.send(formData);
});

envoyerButton2.addEventListener('click', function (e) {
    e.preventDefault(); // Empêche l'envoi par défaut du formulaire

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './createCertif.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                alert("Le programme a été ajouté avec succès à la base de données.");
                popupForm1.style.display = 'none'; // Masquer le formulaire
            } else {
                alert("Une erreur s'est produite lors de l'envoi des données.");
            }
        }
    };

    // Récupérer les données du formulaire
    const formData2 = new FormData(myForm2);

    // Envoyer les données du formulaire
    xhr.send(formData2);
});

envoyerButton3.addEventListener('click', function (e) {
    e.preventDefault(); // Empêche l'envoi par défaut du formulaire

    const xhr = new XMLHttpRequest();
    xhr.open('POST', './deleteAnnee.php', true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                alert("L'année a été supprimée avec succès à la base de données.");
                popupForm2.style.display = 'none'; // Masquer le formulaire
            } else {
                alert("Une erreur s'est produite lors de l'envoi des données.");
            }
        }
    };

    // Récupérer les données du formulaire
    const formData3 = new FormData(myForm3);

    // Envoyer les données du formulaire
    xhr.send(formData3);
});

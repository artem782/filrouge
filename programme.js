document.addEventListener("DOMContentLoaded", function () {
    const prevPageButton = document.getElementById("prevPage");
    const nextPageButton = document.getElementById("nextPage");
    const contentContainer = document.getElementById("contentContainer"); // Add this container to hold the dynamic content

    // Function to load a specific page
    function loadPage(page) {
        fetch(`apiCertifications.php?page=${page}`)
            .then(response => response.json())
            .then(data => {
                // Clear the previous content
                contentContainer.innerHTML = '';
                //TODO : la variable data n'est pas explicite vis à vis de son contenu
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(item => {
                        const position1 = document.createElement('div');
                        position1.className = 'position1';
                        position1.id = 'intitule_' + item.intitule;

                        const h2 = document.createElement('h2');
                        h2.textContent = item.intitule;

                        const img4 = document.createElement('img');
                        img4.className = 'img4';
                        img4.src = item.image;
                        img4.alt = 'Image';

                        const bouton5 = document.createElement('div');
                        bouton5.className = 'bouton5';

                        const a = document.createElement('a');
                        a.href = item.lienOpenClassRoom;
                        a.className = 'bouton7';
                        a.textContent = 'Accéder à OpenClassroom';

                        bouton5.appendChild(a);
                        position1.appendChild(h2);
                        position1.appendChild(img4);
                        position1.appendChild(bouton5);

                        contentContainer.appendChild(position1);
                    });
                } else {
                    // No data available for this page, you can handle this case here
                    contentContainer.textContent = "Aucune donnée disponible pour cette page.";
                }

                // Update pagination buttons based on the data availability
                updatePaginationButtons(page, data.length);
            })
            .catch(error => {
                console.error('Une erreur s\'est produite :', error);
            });
    }

    // Function to update pagination buttons
    function updatePaginationButtons(currentPage, dataLength) {
        if (currentPage > 1) {
            prevPageButton.disabled = false;
        } else {
            prevPageButton.disabled = true;
        }

        if (dataLength > 1) {
            nextPageButton.disabled = false;
        } else {
            nextPageButton.disabled = true;
        }
    }

    let currentPage = 1; // Current page

    // Event listeners for pagination buttons
    prevPageButton.addEventListener("click", () => {
        if (currentPage >  1) {
            currentPage--;
            loadPage(currentPage);
        }
    });

    nextPageButton.addEventListener("click", () => {
        currentPage++;
        loadPage(currentPage);
    });

    // Load the first page when the page loads
    loadPage(currentPage);
});
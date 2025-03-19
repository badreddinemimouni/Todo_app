// supprime une tache avec fetch api
function supprimerTache(id) {
    // confirmation avant suppression
    if (!confirm("tu veux vraiment supprimer ?")) {
        return;
    }

    // url pour supprimer
    const url = `index.php?page=delete`;

    // données pour la requête
    const formData = new FormData();
    formData.append("id", id);

    // appel fetch api
    fetch(url, {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("pb réseau");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // si ok, supprime l'element du dom
                document.getElementById(`task-${id}`).remove();
            } else {
                alert("erreur: " + data.message);
            }
        })
        .catch((error) => {
            // gere les erreurs
            console.error("erreur:", error);
            alert("impossible de supprimer la tache");
        });
}

// ajoute une tache avec fetch api
function ajouterTache(e) {
    e.preventDefault();

    // récupère les valeurs
    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const status = document.getElementById("status").value;

    // vérifie si le titre est rempli
    if (title.trim() === "") {
        alert("le titre est obligatoire");
        return;
    }

    // url et données pour la requête
    const url = "index.php?page=add";
    const formData = new FormData();
    formData.append("title", title);
    formData.append("description", description);
    formData.append("status", status);

    // appel fetch api
    fetch(url, {
        method: "POST",
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("pb réseau");
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                // si ok, ajoute la tache au dom sans recharger
                const taskList = document.querySelector(".task-list");

                // cree l'element html pour la tache
                const newTask = document.createElement("div");
                newTask.className = "task-card";
                newTask.id = `task-${data.id}`;

                // met le contenu html
                newTask.innerHTML = `
            <div class="task-header">
              <h3>${title}</h3>
              <span class="status ${status.replace(" ", "-")}">${status}</span>
            </div>
            <div class="task-body">
              <p>${description}</p>
            </div>
            <div class="task-footer">
              <div class="date">Créée le: ${new Date().toLocaleDateString("fr-FR")}</div>
              <div class="actions">
                <button onclick="supprimerTache(${data.id})" class="btn delete">Supprimer</button>
              </div>
            </div>
          `;

                // ajoute au debut de la liste
                taskList.prepend(newTask);

                // reset le form
                document.getElementById("add-task-form").reset();
            } else {
                alert("erreur: " + data.message);
            }
        })
        .catch((error) => {
            console.error("erreur:", error);
            alert("impossible d'ajouter la tache");
        });
}

// initialisation quand le dom est chargé
document.addEventListener("DOMContentLoaded", function () {
    // form d'ajout
    const addForm = document.getElementById("add-task-form");
    if (addForm) {
        addForm.addEventListener("submit", ajouterTache);
    }
});

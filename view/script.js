


let markdown = document.getElementById("editor");

if (markdown) {
    let simplemde = new SimpleMDE({
        element: markdown,
        placeholder: 'Write your description',
    });

    function updatePreview() {
        const desc = document.getElementById("jsonMarkdown");
        if (desc) {
            desc.value = JSON.stringify(simplemde.value());
        }
    }

    simplemde.codemirror.on("change", updatePreview);
} else {
    console.error("Element with id 'editor' not found.");
}



document.addEventListener('DOMContentLoaded', function () {
    const openPopupVideo = document.getElementById('openPopupVideo');
    const closePopup = document.getElementById('closePopup');
    const popup = document.getElementById('popup');
    const overlay = document.getElementById('overlay');
    
    const openPopupDocument = document.getElementById('openPopupDocument');
    const closePopupDocument = document.getElementById('closePopupDocument');
    const popupDocument = document.getElementById('PopupDocument');

    // Ouvrir le popup vidéo
    openPopupVideo?.addEventListener('click', function () {
        popup.classList.remove('hidden');
        overlay.classList.remove('hidden');
    });

    // Fermer le popup vidéo
    closePopup?.addEventListener('click', function () {
        popup.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    // Ouvrir le popup document
    openPopupDocument?.addEventListener('click', function () {
        popupDocument.classList.remove('hidden');
        overlay.classList.remove('hidden');
    });

    // Fermer le popup document
    closePopupDocument?.addEventListener('click', function () {
        popupDocument.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    // Fermer en cliquant sur l'overlay
    overlay?.addEventListener('click', function () {
        popup.classList.add('hidden');
        popupDocument.classList.add('hidden');
        overlay.classList.add('hidden');
    });
});

function AfficherAdministrateur(btnId, sectionId) {
    let btn = document.getElementById(btnId);
    let section = document.getElementById(sectionId);

    // Ajoute un gestionnaire d'événements pour le clic
    btn.addEventListener('click', function () {
        // Vérifie l'état actuel et bascule entre 'block' et 'none'
        if (section.style.display === 'block') {
            section.style.display = 'none';
        } else {
            section.style.display = 'block';
        }
    });
}


AfficherAdministrateur('btnTableUser','openTableUser');
AfficherAdministrateur('btnTablestatic','openTablestatic');
AfficherAdministrateur('btnTableContenue','openTableContenue');
AfficherAdministrateur('btnInsertTags','openInsertTags');
AfficherAdministrateur('btnTableUtilisateur','openTableUtilisateur');
AfficherAdministrateur('btnAfficherSectionCour','AfficherSectionCour');





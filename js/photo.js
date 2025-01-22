// Liste des images et mots de passe
const images = [
    { src: "icons/1.jpg", password: "password" },
    { src: "icons/5.jpg", password: "tigrou" },
    { src: "icons/4.jpg", password: "13/05/2008" },
    { src: "icons/6.jpg", password: "BON.JEAN" },
    { src: "icons/3.jpg", password: "etonup458" }
];

let currentIndex = 0; // Index de l'image actuelle
const imageElement = document.getElementById("image");
const passwordInput = document.getElementById("password-input");
const nextButton = document.getElementById("next-btn");
const messageElement = document.getElementById("message");

// Gérer le clic sur le bouton "Suivant"
nextButton.addEventListener("click", () => {
    const enteredPassword = passwordInput.value;

    // Vérifie si le mot de passe est correct
    if (enteredPassword === images[currentIndex].password) {
        currentIndex++; // Passer à l'image suivante
        if (currentIndex < images.length) {
            // Affiche l'image suivante
            imageElement.src = images[currentIndex].src;
            passwordInput.value = ""; // Réinitialise le champ mot de passe
            messageElement.textContent = ""; // Efface le message d'erreur
        } else {
            // Toutes les images sont affichées
            nextButton.addEventListener("click", function() {
                window.location.href = "profil.html";  // Remplacez par l'URL de la page de votre choix
              });
        }
    } else {
        // Mot de passe incorrect
        messageElement.textContent = "Mot de passe incorrect, essayez à nouveau.";
    }
});

// Gérer le clic pour zoomer/dézoomer
imageElement.addEventListener("click", () => {
    if (imageElement.classList.contains("zoomed")) {
        // Dézoomer
        imageElement.classList.remove("zoomed");
    } else {
        // Zoomer
        imageElement.classList.add("zoomed");
    }
});
// animaton du curseur
function spark(event) {
    let i = document.createElement('i');
    i.style.left = (event.pageX) + 'px';
    i.style.top = (event.pageY) + 'px';
    i.style.scale = `${Math.random() * 2 + 1}`;
    i.style.setProperty('--x', getRandomTransitionValue());
    i.style.setProperty('--y', getRandomTransitionValue());

    document.body.appendChild(i);

    setTimeout(() => {
        document.body.removeChild(i);
    }, 2000)
}


function getRandomTransitionValue() {
    return `${Math.random() * 100 - 100}px`
}

document.addEventListener('mousemove', spark);
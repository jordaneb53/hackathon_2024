function checkInput() {
    const userInput = document.getElementById('user-input').value.trim(); // Récupère et nettoie l'entrée
    const feedback = document.getElementById('feedback'); // Zone de feedback
    const nextStepBtn = document.getElementById('next-step-btn'); // Bouton Étape Suivante

    if (userInput === "PAS QUATRE") {
        // Affiche un message de succès
        feedback.textContent = "✅ Correct ! Bien joué.";
        feedback.style.color = "#00ff00";

        // Affiche le bouton Étape Suivante
        nextStepBtn.style.display = "inline-block";

        // Ajoute une redirection au clic sur le bouton
        nextStepBtn.onclick = () => {
            window.location.href = "clef_ceasar.html"; // accéder à l'étape suivante
        };
    } else {
        // Affiche un message d'erreur
        feedback.textContent = "❌ Incorrect, essayez encore.";
        feedback.style.color = "#ff0000";

        // Cache le bouton Étape Suivante si la réponse est incorrecte
        nextStepBtn.style.display = "none";
    }
}


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
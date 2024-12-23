function checkInput() {
    const userInput = document.getElementById('user-input').value.trim(); // Récupère et nettoie l'entrée
    const feedback = document.getElementById('feedback'); // Zone de feedback
    const nextStepBtn = document.getElementById('next-step-btn'); // Bouton Étape Suivante

    fetch('verify_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ password: userInput }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                feedback.textContent = data.message;
                feedback.style.color = "#00ff00";
                nextStepBtn.style.display = "inline-block";

                nextStepBtn.onclick = () => {
                    window.location.href = "clef_ceasar.html"; // accéder à l'étape suivante
                };
            } else {
                feedback.textContent = data.message;
                feedback.style.color = "#ff0000";
                nextStepBtn.style.display = "none";
            }
        })
        .catch((error) => {
            console.error('Erreur:', error);
            feedback.textContent = "❌ Une erreur est survenue.";
            feedback.style.color = "#ff0000";
            nextStepBtn.style.display = "none";
        });
}

// Animation du curseur
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
    }, 2000);
}

function getRandomTransitionValue() {
    return `${Math.random() * 400 - 200}px`;
}

document.addEventListener('mousemove', spark);
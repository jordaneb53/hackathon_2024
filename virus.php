<?php
    session_start();

    // Initialisation du temps restant si non défini
    if (!isset($_SESSION['timeLeft'])) {
        $_SESSION['timeLeft'] = 30*60; // 30 minutes en secondes
    }

    $isVirusDestroyed = false; // Nouvelle variable pour indiquer si le virus est détruit
    $formVisible = true; // Variable pour savoir si le formulaire doit être visible

    // Traitement du formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['arreterVirus'])) {
            if (empty($_POST['nom'])) {
                $message = "<p class='error'>Le champ Nom est vide.</p>";
            } elseif (empty($_POST['mdp'])) {
                $message = "<p class='error'>Le champ Mot de passe est vide.</p>";
            } elseif ($_POST['nom'] === 'moreau.sophie' && $_POST['mdp'] === 'loremipsum') {
                $isVirusDestroyed = true; // Le virus est détruit
                $formVisible = false; // Cacher le formulaire
            } else {
                $message = "<p class='error'>Informations de connexion invalides !</p>";
            }
        }
    }

    // Pour la requête AJAX
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateTimer'])) {
        // Simuler une seconde de décompte à chaque requête AJAX
        $_SESSION['timeLeft'] -= 1;
        echo json_encode(['timeLeft' => $_SESSION['timeLeft']]);
        exit; // Terminer ici la requête AJAX
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virus</title>
    <link rel="icon" type="image/x-icon" href="./icons/logo-mns.svg">
    <style>

        @font-face {
          font-family: Roboto;
          src: url(./ressources/font/Roboto-Medium.ttf);
        }
        body {
            font-family: "Roboto", serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-image: url('icons/virus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: white;
        }

        .avertissement{
            position:absolute;
            right:10px;
            bottom:10px;
            border: 2px solid #ec6834;
            display: flex;
            color: #ec6834;
            background-color: rgb(22, 29, 56);
            border-radius: 12px;
            opacity: 0.95;
            text-align: center;
            padding: 0 5px 0 5px;

        }
        


        .timer {
            font-size: 4em;
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px black;
        }

        .timer.success {
            color: green;
        }

        .container {
            text-align: center;
            background:  rgb(22, 29, 56);
            padding: 20px;
            border-radius: 10px;
            border:2px solid  #ec6834;

        }

        form {
            margin-top: 20px;
        }

       

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #ec6834 ;
            background-color:black;
            color: white ;
            border-radius: 5px;
            font-size: 1em;
            width: 250px;   
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color:  #ec6834 ;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color:rgb(190, 78, 34);
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .message {
            margin-top: 20px;
            color: green;
            font-size: 1.5em;
        }

        .link, .fail{
            display: block;
            margin-top: 50px;
            font-size: 1.2em;
            color: #ec6834;
            text-decoration: none;
            text-align: center;
            background: #1b1b1b;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #ec6834;
            opacity: 0.98;
        }

        .link:hover, .fail:hover{
            text-decoration: underline;
            background: #ec6834;
            color: #1b1b1b;
        }

        .start{
            display: block;
            margin-top: 75px;
            color: #ec6834;
            text-decoration: none;
            text-align: center;
            background-color: rgb(22, 29, 56);
            padding: 20px;
            border-radius: 12px;
            border: 2px solid #ec6834;
            width: 50%;
        }

        .start p{
            font-size: 1.3em;
        }

        .start-button{
            font-size: 1.2em;
            color: #ec6834;
            text-decoration: none;
            text-align: center;
            border: 2px solid #ec6834;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            background-color: rgb(22, 29, 56);

        }



        .start-button:hover {
            background-color: #ec6834;
            color: white;
        }
        i {
        position: absolute;
        width: 4px;
        height: 4px;
        background:  #ec6834;
        pointer-events: none;
        animation: animate 2s linear forwards;
        }
            @keyframes animate {
        0% {
        opacity: 1;
        transform: translate(0, 0);
        }
    
        100% {
        opacity: 0;
        transform: translate(var(--x), var(--y));
        }
    }

    @media (max-width:500px){
        .avertissement{
            margin-top:20px;
            right:10px;
            border: 2px solid #ec6834;
            color: #ec6834;
            background: linear-gradient(180deg, rgba(49,62,116,1) 0%, rgba(23,30,59,1) 100%);
            border-radius: 12px;
            opacity: 0.95;
            text-align: center;
            padding: 0 5px 0 5px;

        }
        .start-button{
            font-size: 1.2em;
            color: #ec6834;
            text-decoration: none;
            text-align: center;
            border: 2px solid #ec6834;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
            margin-bottom:25px;
            background-color: rgb(22, 29, 56);

        }
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="timer" id="timer">30:00</div>

        <audio id="alertSound" src="audio/alert_sound.mp3" preload="auto"></audio>
        <audio id="endSound" src="audio/virus.mp3" preload="auto"></audio>
        <audio id="success" src="audio/success.mp3" preload="auto"></audio>

        <script>
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
            let timeLeft = <?php echo $_SESSION['timeLeft']; ?>; // Temps restant
            let elapsedTime = 0; // Temps écoulé depuis le début
            let isVirusDestroyed = <?php echo json_encode($isVirusDestroyed); ?>; // Statut du virus
            let formVisible = <?php echo json_encode($formVisible); ?>; // Visibilité du formulaire

            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }

            function updateTimer() {
                const timerElement = document.getElementById('timer');
                const alertSound = document.getElementById('alertSound'); // Élément audio pour le son d'alerte
                const endSound = document.getElementById('endSound'); // Élément audio pour le son de fin
                const success = document.getElementById('success'); // Élément audio pour la réussite

                if (isVirusDestroyed) {
                    timerElement.textContent = "Virus détruit !";
                    success.play();
                    timerElement.classList.add('success'); // Change la couleur en vert
                    // Masquer le formulaire si le virus est détruit
                    document.getElementById('formContainer').style.display = 'none';
                    document.getElementById('start').style.display = 'none';
                
                    // Appliquer les styles CSS lorsque le virus est détruit
                    document.documentElement.style.setProperty('background', 'linear-gradient(180deg, rgba(49,62,116,1) 0%, rgba(23,30,59,1) 100%)');
                    document.body.style.backgroundImage = 'url("icons/Group.svg")'; // Définir l'image en fond
                    document.body.style.backgroundPosition = '85%';
                    document.body.style.backgroundSize = '40%';
                
                    const link = document.createElement('a');
                    link.classList.add('link');
                    link.href = 'https://www.metz-numeric-school.fr/fr';
                    link.target = '_blank';
                    link.textContent = 'Félicitations ! Venez découvrir nos formations dans le numérique en cliquant ici !';
                    document.body.appendChild(link);
                    link.document.style.backgroundColor = '#1b1b1b';

                
                    return; // Arrêter le timer
                }
            
                // Code existant pour la gestion du temps
                if (timeLeft > 0) {
                    timerElement.textContent = formatTime(timeLeft);
                    setTimeout(() => {
                        timeLeft--;
                        elapsedTime++;
                    
                        // Jouer le son toutes les 5 minutes
                        if (elapsedTime % 300 === 0) {
                            alertSound.play();
                        }
                    
                        if (elapsedTime % 1799 === 0) {
                            endSound.play();
                        }
                    
                        // Faire une requête AJAX pour mettre à jour le serveur
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                timeLeft = response.timeLeft;
                            
                            
                                // Si le temps est écoulé, cacher le formulaire
                                if (timeLeft === 0) {
                                    document.getElementById('formContainer').style.display = 'none';
                                    document.getElementById('start').style.display = 'none';

                                    const fail = document.createElement('a');
                                    fail.classList.add('fail');
                                    fail.href = 'https://www.metz-numeric-school.fr/fr';
                                    fail.target = '_blank';
                                    fail.textContent = "Tu n'as pas réussi mais tu peux quand même venir découvrir nos formations dans le numérique en cliquant ici !";
                                    document.body.appendChild(fail);
                                    fail.document.style.backgroundColor = '#1b1b1b';

                                }
                            }
                        };
                        xhr.send("updateTimer=1");
                        updateTimer();
                    }, 1000);
                } else {
                    timerElement.textContent = "Temps écoulé !";
                    // Masquer le formulaire si le temps est écoulé
                    document.getElementById('formContainer').style.display = 'none';
                }
            }


            window.onload = function() {
                // Masquer le formulaire si l'utilisateur est connecté ou si le temps est écoulé
                if (formVisible) {
                    document.getElementById('formContainer').style.display = 'block';
                } else {
                    document.getElementById('formContainer').style.display = 'none';
                }
            
                updateTimer();
            };

        </script>

        <div id="formContainer">
            <form action="" method="post">
                <input type="text" name="nom" placeholder="nom.prenom (ex: gamory.théo)">
                <br />
                <input type="password" name="mdp" placeholder="Mot de passe" />
                <br />
                <br />
                <input type="submit" name="arreterVirus" value="Arrêter le virus" />
            </form>
        </div>

        <?php if (isset($message)) echo $message; ?>
    </div>

    <div class="start" id="start" >
        <p>Pour arrêter le virus, résolvez les énigmes, en cliquant sur le bouton ci-dessous, pour trouver le nom.prenom et le mot de passe 👀</p>
        <a class="start-button" href="quizz.html" target="_blank">Démarrer</a>
    </div>

    <div class="avertissement">
        <p>Ne pas fermer cette page, ceci mettra fin à l'escape game.</p>
    </div>
</body>
</html>

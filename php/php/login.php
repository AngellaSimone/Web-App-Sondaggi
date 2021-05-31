<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <style>
        body {
            font-family: 'Alegreya Sans', sans-serif;
            overflow: hidden;
            background-image: url(../../img/sfondo.png);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
        }
    </style>

<body>
    <div class="page">
        <div id="content">
            <span class="slide">
                <a href="#" onclick="openSlideMenu()">
                    <i class="fas fa-angle-double-right" id="arrow"></i>
                </a>
            </span>

            <div id="menu" class="nav">
                <a href="#" class="close" onclick="closeSlideMenu()">
                    <i class="fas fa-times" id="x"></i>
                </a>

                <?php

                if (!isset($_SESSION['user'])) {
                    echo "<a href=\"../../index.php\">Homepage</a>";
                    echo "<a href=\"#\" onclick=\"mostramessaggio();\" >Crea il tuo Sondaggio</a>";
                    echo "<a href=\"#\"onclick=\"mostramessaggio();\">Visualizza i tuoi sondaggi</a>";
                    echo "<a href=\"#\"onclick=\"mostramessaggio();\">Rispondi ai sondaggi</a>";
                    echo "<span id=\"messaggio\"></span>";
                } else {
                    $username = $_SESSION['user'];
                    echo "<a href=\"./index.php\">Homepage</a>";
                    echo "<a href=\"./php/php/creaSondaggio.php\">Crea il tuo Sondaggio</a>";
                    echo "<a href=\"./php/php/mieiSondaggi.php\">Visualizza i tuoi sondaggi</a>";
                    echo "<a href=\"./php/php/sondaggiInvitati.php\">Rispondi ai sondaggi</a>";

                    echo "<div class=\"logout\">";
                    echo "<i class=\"fas fa-user\" id=\"icona\"></i>";
                    echo "<div class=\"name\">";
                    echo "<p>Ciao, " . $username . "</p>";
                    echo "<a class=\"name\" href=\"./php/database/logout.php\">Logout</a>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

            </div>
        </div>
    </div>
    <div class="form">
        <form class="register-form" action="../database/registraUtente.php" method="POST" autocomplete="off">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="cognome" placeholder="Cognome" required>
            <input type="text" name="email" placeholder="Email" required onkeyup="controlloEmailLogin(this.value)">
            <span id="messEmail"></span>
            <input type="text" name="username" placeholder="Username" required onkeyup="controlloUsernameLogin(this.value)" />
            <span id="messUsername"></span>
            <input type="password" name="pwd" placeholder="Password" required />
            <button class="button" id="bottone">Registrati</button>
            <p class="message">Già registrato?<a href="#"> Accedi</a></p>
        </form>


        <form class="login-form" action="../database/controllologin.php" method="POST" autocomplete="off">
            <input type="text" placeholder="username" name="username" required />
            <input type="password" placeholder="password" name="pwd" required />
            <button class="button">Accedi</button>
            <p class="message">Non sei registrato? <a href="#"> Registrati</a></p>
        </form>
    </div>
    </div>

    <script src="../../js/script.js"></script>
</body>

</html>
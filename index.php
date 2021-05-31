<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Online Survey</title>
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <script src="./js/script.js"></script>
    <style>
        body {
            overflow: hidden;
            background-image: url(./img/sfondo.png);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
        }
    </style>

</head>

<body>
    <div id="title">
        <h1>Online Survey</h1>

    </div>
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
                    echo "<a href=\"./php/php/login.php\">Login</a>";
                    echo "<a href=\"#\" onclick=\"mostramessaggio();\" >Crea il tuo Sondaggio</a>";
                    echo "<a href=\"#\"onclick=\"mostramessaggio();\">Sondaggi creati</a>";
                    echo "<a href=\"#\"onclick=\"mostramessaggio();\">Sondaggi per te</a>";
                    echo "<span id=\"messaggio\"></span>";
                } else {
                    $username = $_SESSION['user'];
                    echo "<a href=\"./index.php\">Homepage</a>";
                    echo "<a href=\"./php/php/creaSondaggio.php\">Crea il tuo Sondaggio</a>";
                    echo "<a href=\"./php/php/mieiSondaggi.php\">Sondaggi creati</a>";
                    echo "<a href=\"./php/php/sondaggiInvitati.php\">Sondaggi per te</a>";

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



</html>
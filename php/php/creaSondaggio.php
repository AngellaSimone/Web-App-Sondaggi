<?php
include "../database/sessione.php";
$username = $_SESSION['user'];
?>
<!DOCTYPE html>

<html>

<head>

    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <meta charset="UTF-8">
    <title>Crea Sondaggio</title>
    <style>
        body {
            overflow: hidden;
            background-image: url(../../img/sfondo.png);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="form">
            <form class="form-register" name="form" action="../database/salvaSondaggio.php" method="POST">
                <label class="label">Nome sondaggio:</label>
                <input type="text" name="nomeS" required> <br>
                <label class="label">Il tuo sondaggio inizierà il:</label>
                <input id="dataInizio" type="date" name="dataInizio" min=<?php echo date('Y-m-d') ?> required><br>
                <label class="label">Il tuo sondaggio finirà il:</label>
                <input id="dataFine" type="date" name="dataFine" required><br>
                <span id="messDate"></span>
                <button class="button" onclick="return controlloDateCreazione()">Crea</button>

            </form>
        </div>
    </div>
    <a href="../../index.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>
    <script src="../../js/script.js"></script>
</body>

</html>
<?php
include "../database/sessione.php";
$idSondaggio  = $_POST['idSondaggio'];
$dataInizio = $_POST['dataInizio'];
$dataFine = $_POST['dataFine'];
$nomeSondaggio = $_POST['nomeSondaggio'];
?>
<!DOCTYPE html>

<html>

<head>

    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
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

    </div>
    </div>
    <div class="form">
        <form class="form-register" name="form" action="../database/aggiornaSondaggio.php" method="POST">
            <label class="label">Nome sondaggio:</label>
            <input type="text" name="nomeSondaggio" readonly value="<?php echo $nomeSondaggio ?>"> <br>

            <?php
            if ($dataInizio > date('Y-m-d'))  //SONDAGGIO NON INIZIATO
            {
                echo "Il tuo sondaggio inizierà il: ";

                echo "<input id=\"dataInizio\" type=\"date\" name=\"dataInizio\" value=\"$dataInizio\" min=" . date('Y-m-d') . " required><br>";
            } else {
                echo "Il sondaggio si è aperto il: ";
                echo "<input id=\"dataInizio\" type=\"date\" name=\"dataInizio\" value=\"$dataInizio\" disabled required><br>";
            }

            if ($dataFine > date('Y-m-d'))  //SONDAGGIO NON FINITO
            {
                echo "Il tuo sondaggio finirà il: ";

                echo "<input id=\"dataFine\" type=\"date\" name=\"dataFine\" value=\"$dataFine\" min=" . $dataFine . " required><br>";
            }

            echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
            ?>
            <span id="messDate"></span>
            <button class="button1" onclick="return controlloDateEdit()">Modifica</button>


        </form>
    </div>
    </div>
    <a href="./mieiSondaggi.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>

    <script src="../../js/script.js"></script>
</body>

</html>
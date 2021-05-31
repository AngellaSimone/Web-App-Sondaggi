<?php
include "../database/sessione.php";
$idSondaggio = $_POST['idSondaggio'];
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>

<head>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />

    <meta charset="UTF-8">
    <title>Crea Domanda</title>

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
            <form class="form-register" name="form" action="../database/salvaDomanda.php" method="POST">
                <label class="label">Inserisci il testo della domanda:</label>
                <input type="text" name="domanda" required>
                <button class="button1" onclick="return aggiungiRisp()">Aggiungi risposta</button>
                <div id="contenitoreRisposte">
                    <div id="1" class="position">
                        <input type="text" name="risposte[]"></input>
                        <span onclick="return rimuoviRisp(1)"><i class="fas fa-times" id="x"></i></span>
                    </div>

                    <div id="2" class="position">
                        <input type="text" name="risposte[]"></input>
                        <span onclick="return rimuoviRisp(2)"><i class="fas fa-times" id="x"></i></span>
                    </div>
                </div><br>
                <button class="button">Crea</button>
                <input type="hidden" name="idSondaggio" value="<?php echo $idSondaggio ?>">
            </form>
        </div>
    </div>
    <script src="../../js/script.js"></script>
</body>

</html>
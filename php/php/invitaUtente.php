<?php
include "../database/sessione.php";
$idSondaggio = $_POST['idSondaggio'];
?>
<!DOCTYPE html>

<html>

<head>

    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />

    <meta charset="UTF-8">
    <title>Invita</title>

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
            <form class="form-register" name="form" action="../database/salvaListaUtenti.php" method="POST">
                <label class="label">Inserisci utente da invitare: </label>
                <button class="button1" onclick="return aggiungiUt()">Aggiungi utente</button>
                <div id="contenitoreUtenti">
                    <div id="1" class="position">
                        <input type="email" name="utenti[]" onkeyup="controlloEmailUt(this.value,1,<?php echo $idSondaggio ?>)"></input>
                        <span onclick="return rimuoviUt(1)"><i class="fas fa-times" id="x1"></i></span>
                        <span id="messEmail1"></span>
                    </div>
                </div><br>
                <button class="button1" id="bottone">Inoltra Email</button>
                <input type="hidden" name="idSondaggio" value="<?php echo $idSondaggio ?>">
            </form>
        </div>
        <script src="../../js/script.js"></script>
</body>

</html>
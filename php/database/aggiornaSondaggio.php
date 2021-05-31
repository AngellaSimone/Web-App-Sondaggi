<?php
include "./connessione.php";
include "./sessione.php";
?>
<!DOCTYPE html>

<html>

<head>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Aggiorna Sondaggio</title>
</head>
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

<body>

    <?php

    $nomeSondaggio = $_POST['nomeSondaggio'];
    $dataInizio = date('Y-m-d', strtotime($_POST['dataInizio']));
    $dataFine = date('Y-m-d', strtotime($_POST['dataFine']));
    $idSondaggio = $_POST['idSondaggio'];
    $dataModifica = date('Y-m-d');

    $query = "UPDATE sondaggi SET data_inizio=\"$dataInizio\",  data_fine=\"$dataFine\", data_ultima_modifica=\"$dataModifica\" WHERE id = $idSondaggio";

    echo "<div class=\"page\"> <div class=\"form\">";
    if (!$connessione->query($query)) {

        echo "<h2 class=\"h2\">Abbiamo riscontrato un errore nell' aggiornamento del tuo sondaggio, ti invitiamo a riprovare.</h2>";
        echo "<form class=\"form-login\" name=\"form\" action=\"../php/modificaSondaggio.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
        echo "<input type=\"hidden\" name=\"dataInizio\" value=\"" . $dataInizio . "\">";
        echo "<input type=\"hidden\" name=\"dataFine\" value=\"" . $dataFine . "\">";
        echo "<input type=\"hidden\" name=\"nomeSondaggio\" value=\"" .  $nomeSondaggio . "\">";
        echo "<button class=\"button1\">Indietro</button>";
        echo "</form>";
    } else {
        header("Location: ../php/mieiSondaggi.php");
    }
    echo "</div></div>";
    $connessione->close();
    ?>
</body>

</html>
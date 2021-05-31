<?php
include "./connessione.php";
include "./sessione.php";

?>
<!DOCTYPE html>

<html>

<head>

    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />

    <meta charset="UTF-8">
    <title>Visualizza risposte</title>
    <style>
        body {
            background-color: #0b273d;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
        }
    </style>
    </style>

</head>

<body>
    <?php

    $idSondaggio = $_POST['idSondaggio'];

    $queryTendina = "SELECT DISTINCT(risposte_date.id_utente), utenti.Username, utenti.Id as id
        FROM risposte_date, utenti, opzioni_risposte, domande_sondaggi
        WHERE domande_sondaggi.id_sondaggio = $idSondaggio
        AND risposte_date.id_utente = utenti.Id
        AND opzioni_risposte.id= risposte_date.id_opzione
        AND domande_sondaggi.id = opzioni_risposte.id_domanda";
    $resultTendina = $connessione->query($queryTendina);

    if ($resultTendina->num_rows == 0) {
        echo "<div class=\"page\"> <div class=\"form\">";
        echo "<h2 class=\"h2\">Nessun utente ha completato il sondaggio</h2>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class=\"page\"><div class=\"select\">  ";
        echo "<select id=\"utenti\" onchange=\"recuperaRisposte();\">";
        echo "<option selected disabled value=\"nessuno\">Scegli utente</option>";
        while ($row = $resultTendina->fetch_assoc()) {
            echo "<option value=\"" . $row['id'] . "-" . $idSondaggio . "\">" . $row['Username'] . "</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "</div>";
    }
    $connessione->close();
    ?>
    
    <div id="risposte"></div>

    <a href="../php/mieiSondaggi.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>

    <script src="../../js/script.js"></script>

</body>

</html>
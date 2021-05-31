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

</head>

<body>
    <?php

    $username = $_SESSION['user'];
    $idUtente = $_SESSION['idUtente'];
    $emailUtente = $_SESSION['Email'];
    $idSondaggio = $_POST['idSondaggio'];

    $query = "SELECT * FROM risposte_date, opzioni_risposte, domande_sondaggi
    WHERE opzioni_risposte.id_domanda = domande_sondaggi.id
    AND risposte_date.id_opzione = opzioni_risposte.id
    AND risposte_date.id_utente = $idUtente
    AND domande_sondaggi.id_sondaggio = $idSondaggio";

    $result = $connessione->query($query);

    if ($result->num_rows == 0) {
        echo "<h2>Errore nel caricamento delle tue risposte</h2>";
        header("Refresh:5; ../../index.php");
    } else {

        echo "<form action=\"../php/sondaggiInvitati.php\" method=\"POST\">";
        while ($row = $result->fetch_assoc()) {
            $testoDomanda = $row['testo_domanda'];
            echo "<h1 class=\"testoDomanda\">" . $testoDomanda . "</h1>";
            $risposta = $row['opzione'];
            echo "<h1 class=\"testoRisposta\">- " . $risposta . "</h1>";
        }
        echo "</form>";
    }
    $connessione->close();


    ?>
    <a href="../php/sondaggiInvitati.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>
</body>

</html>
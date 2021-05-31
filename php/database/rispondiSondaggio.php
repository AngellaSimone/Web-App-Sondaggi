<?php
include "./connessione.php";
include "./sessione.php";

?>
<!DOCTYPE html>

<html>

<head>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <meta charset="UTF-8">
    <title>Rispondi al sondaggio</title>
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

    $query = "SELECT domande_sondaggi.id as idDomanda, domande_sondaggi.testo_domanda, opzioni_risposte.id as idOpzione, opzioni_risposte.opzione
                    FROM domande_sondaggi, opzioni_risposte
                    WHERE domande_sondaggi.id = opzioni_risposte.id_domanda
                    AND domande_sondaggi.id_sondaggio = $idSondaggio";

    $result = $connessione->query($query);
    $idPrecedente = -1;
    $primaRisposta = 0;
    if ($result->num_rows == 0) {
        echo "<div class=\"page\"> <div class=\"form\">";
        echo "<h2 class=\"h2\">L'autore del sondaggio non ha ancora caricato le domande, riprova più tardi</h2>";
        echo "</div>";
        echo "<a href=\"../../index.php\" id=\"indietroButton\"><i class=\"fas fa-angle-left\" id=\"back\"></i></a>";
        echo "</div>";
    } else {
        echo "<form action=\"./salvaRisposte.php\" method=\"POST\" style=\"text-align:center;\">";

        while ($row = $result->fetch_assoc()) {
            $idDomanda = $row['idDomanda'];
            if ($idPrecedente != $idDomanda) {
                $testoDomanda = $row['testo_domanda'];
                echo "<h1 class=\"testoDomanda\">" . $testoDomanda . "</h1>";
                $idPrecedente = $idDomanda;
                $primaRisposta = 1;
            }
            if ($idPrecedente == $idDomanda) {
                $opzione = $row['opzione'];
                $idOpzione = $row['idOpzione'];
                if ($primaRisposta == 1) {
                    echo "<input type=\"radio\" value=\"$idOpzione\" name=\"$idDomanda\" checked>";
                    $primaRisposta = 0;
                } else {
                    echo "<input type=\"radio\" value=\"$idOpzione\" name=\"$idDomanda\">";
                }
                echo "<label id=\"option\">" . $opzione . "</label><br><br>";
                $idPrecedente = $idDomanda;
            }
        }
        echo "<br>";
        echo "<button class=\"button2\">Invia risposte</button>";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"$idSondaggio\">";
        echo "</form>";
    }

    $connessione->close();
    ?>
    <a href="../../index.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>
</body>

</html>
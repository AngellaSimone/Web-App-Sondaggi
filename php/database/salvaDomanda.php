<?php
include "./connessione.php";
include "./sessione.php";
?>
<!DOCTYPE html>

<html>

<head>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <title>Salva Domanda</title>

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

    <?php

    $idSondaggio = $_POST['idSondaggio'];
    $testo_domanda = $_POST['domanda'];
    $risposte = $_POST['risposte'];

    $username = $_SESSION['user'];

    $query = "INSERT INTO domande_sondaggi(testo_domanda,id_sondaggio)
          VALUES(\"$testo_domanda\",$idSondaggio)";

    echo "<div class=\"page\"> <div class=\"form\">";
    if (!$connessione->query($query)) {
        echo "<h2 class=\"h2\">Abbiamo riscontrato un problema nel salvataggio della domanda, ti invitiamo a riprovare.</h2>";
        echo "<form class=\"form-register\" name=\"form\" action=\"../php/creaDomanda.php\" method=\"POST\">";
        echo "<button class=\"button\" >Indietro</button>";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
        echo "</form>";
    } else {

        $query = "Select max(id) as id from domande_sondaggi where id_sondaggio = $idSondaggio";
        $result = $connessione->query($query);

        while ($row = $result->fetch_assoc()) {
            $idDomanda =  $row['id'];
        }
        $result->free();
        foreach ($risposte as $opzione) {
            $query = "INSERT INTO opzioni_risposte(opzione,id_domanda)
                        VALUES(\"$opzione\",$idDomanda)";

            if (!$connessione->query($query)) {
                echo "<h2 class=\"h2\">Abbiamo riscontrato un problema nel salvataggio di una opzione di risposta.</h2>";
                echo "<h2 class=\"h2\">Ti invitiamo a ricreare la domanda.</h2>";
                echo "<form class=\"form-register\" name=\"form\" action=\"../php/creaDomanda.php\" method=\"POST\">";
                echo "<button class=\"button\">Indietro</button>";
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
                echo "</form>";
                break;
            }
        }


        echo "<h2 class=\"h2\">Domanda creata.</h2>";
        echo "<form class=\"form-register\" name=\"form\" action=\"../php/creaDomanda.php\" method=\"POST\">";
        echo "<button class=\"button1\">Inserisci nuova domanda</button>";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
        echo "</form>";

        echo "<form class=\"form-register\" name=\"form\" action=\"../php/invitaUtente.php\" method=\"POST\">";
        echo "<button class=\"button1\">Termina inserimento</button>";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
        echo "</form>";
    }

    echo "</div></div>";
    // chiusura della connessione
    $connessione->close();

    ?>
</body>

</html>
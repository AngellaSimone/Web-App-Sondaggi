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
</head>

<body>

    <?php

    $idSondaggio = $_POST['idSondaggio'];
    $idUtente = $_SESSION['idUtente'];
    $emailUtente = $_SESSION['Email'];
    $errore = 0;

    foreach ($_POST as $key => $val) {
        if ($key != 'idSondaggio') {
            $query = "INSERT INTO risposte_date (id_opzione, id_utente)
                        VALUES ($val, $idUtente)";

            if (!$connessione->query($query)) {
                $errore = 1;
            } else {
                $query = "UPDATE opzioni_risposte SET cont_risposte = cont_risposte + 1 WHERE id_domanda = $key AND id = $val";
                if (!$connessione->query($query)) {
                    echo "<div class=\"page\"> <div class=\"form\">";
                    echo "<h2>Abbiamo riscontrato un problema nel salvataggio delle risposte, ti invitiamo a riprovare.</h2>";
                    echo "<form class=\"form-register\" name=\"form\" action=\"./rispondiSondaggio.php\" method=\"POST\">";
                    echo "<button class=\"button1\">Indietro</button>";
                    echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    break;
                }
            }
        }
    }
    if ($errore != 1) {
        $query = "UPDATE invitati SET completato = 1 WHERE email_utente = \"$emailUtente\" AND id_sondaggio = $idSondaggio";
        if (!$connessione->query($query)) {
            $errore = 2;
        }
        if ($errore != 2) {

            header("Location: ../../index.php");
        } else {
            echo "<div class=\"page\"> <div class=\"form\">";
            echo "<h2>Abbiamo riscontrato un problema nel salvataggio delle risposte, ti invitiamo a riprovare.</h2>";
            echo "<form class=\"form-register\" name=\"form\" action=\"./rispondiSondaggio.php\" method=\"POST\">";
            echo "<button class=\"button1\">Indietro</button>";
            echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class=\"page\"> <div class=\"form\">";
        echo "<h2>Abbiamo riscontrato un problema nel salvataggio delle risposte, ti invitiamo a riprovare.</h2>";
        echo "<form class=\"form-register\" name=\"form\" action=\"./rispondiSondaggio.php\" method=\"POST\">";
        echo "<button>Indietro</button>";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }

    // chiusura della connessione
    $connessione->close();

    ?>
</body>

</html>
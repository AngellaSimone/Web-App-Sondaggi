<?php
include "../database/connessione.php";
include "../database/sessione.php";
?>
<!DOCTYPE html>

<html>

<head>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <meta charset="UTF-8">
    <title>Tabella inviti</title>
</head>

<body>

    <style>
        body {
            background-color: #0b273d;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
        }

        div {
            align-items: center;
            justify-content: center;
            display: flex;
        }

        table,
        th,
        td {
            border: 0px solid transparent;
            text-align: center;
            color: white;
            border-collapse: collapse;
            font-size: 2vh;

        }

        th {
            padding: 2vh;
        }

        td {
            padding: 1.5vh;
        }

        tr.borderBottom td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);

        }
    </style>
    <?php

    $username = $_SESSION['user'];
    $idUtente = $_SESSION['idUtente'];
    $emailUtente = $_SESSION['Email'];

    $query = "SELECT sondaggi.id,sondaggi.nome, utenti.username, sondaggi.data_inizio, sondaggi.data_fine, invitati.completato
                    FROM sondaggi 
                    LEFT JOIN utenti
                    ON sondaggi.autore_sondaggio = utenti.id
                    LEFT JOIN invitati
                    ON sondaggi.id = invitati.id_sondaggio  
                    WHERE invitati.email_utente = \"$emailUtente\"";

    $result = $connessione->query($query);
    if ($result->num_rows == 0) {
        echo "<div class=\"page\"> <div class=\"form\">";
        echo "<h2 class=\"h2\">Non sei stato invitato a nessun sondaggio</h2>";
        header("Refresh:10; ../../index.php");
        echo "</div>";
        echo "</div>";
    } else {

        echo "<div>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Nome del sondaggio</th><th>Autore del sondaggio</th><th>Data di apertura</th><th>Data di chiusura</th><th colspan=\"2\">Operazioni</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr class=\"borderBottom\">";
            $today = date("Y-m-d");
            $expire = $row['data_fine'];
            $start = $row['data_inizio'];
            $today_time = strtotime($today);
            $expire_time = strtotime($expire);
            $start_time = strtotime($start);

            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";

            $di = $row['data_inizio'];
            $data = date('d-m-Y', strtotime($di));
            echo "<td>" . $data . "</td>";

            $df = $row['data_fine'];
            $data = date('d-m-Y', strtotime($df));
            echo "<td>" . $data . "</td>";

            echo "<td style=\"color:green\">";
            if ($start_time <= $today_time  && $row['completato'] == 0) {
                echo "<form action=\"../database/rispondiSondaggio.php\" method=\"POST\">";
                echo "<button class=\"buttonInvisible\"><i class=\"fas fa-sign-in-alt\" id=\"operazioni\"></i></button>";;
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $row['id'] . "\">";
                echo "</form>";
            }
            if ($row['completato'] == 1) {
                echo "&#10003";
                echo "</td>";

                echo "<td>";
                echo "<form action=\"../database/risposteDate.php\" method=\"POST\">";
                echo "<button class=\"buttonInvisible\"><i class=\"fas fa-eye\" id=\"operazioni\"></i></button>";;
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $row['id'] . "\">";
                echo "</form>";
            } else {
                echo "<td></td>";
            }



            echo "</td>";

            echo "</tr>";
            echo "</div>";
        }
    }

    $connessione->close();


    ?>

    <a href="../../index.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>
</body>

</html>
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
    <title>Miei sondaggi</title>

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

        td{
            padding: 1.5vh;
        }

        tr.borderBottom td{
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);

        }

    </style>
</head>

<body>
    <?php

    $username = $_SESSION['user'];
    $idUtente = $_SESSION['idUtente'];

    $query = "Select sondaggi.id as idsondaggio,sondaggi.data_inizio,
              sondaggi.data_creazione,sondaggi.nome, 
              sondaggi.data_fine,COUNT(invitati.id) from sondaggi 
              LEFT JOIN invitati
              ON sondaggi.id = invitati.id_sondaggio
              where autore_sondaggio = $idUtente
              GROUP BY (sondaggi.id)";
    
    $result = $connessione->query($query);
    if ($result->num_rows == 0) {
        echo "<div class=\"page\"> <div class=\"form\">";
        echo "<h2>Non hai ancora creato nessun sondaggio</h2>";
        echo "</div>";
        echo "</div>";
        header("Refresh:3; url=../../index.php");

    } else {

        echo "<div>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Nome del sondaggio</th><th>Autore del sondaggio</th><th>Data di creazione</th><th>Data di apertura</th><th>Data di chiusura</th><th>Numero di invitati</th><th colspan=\"4\">Operazioni</th><th></th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr class=\"borderBottom\">";
            $today = date("Y-m-d");
            $expire = $row['data_fine']; 

            $today_time = strtotime($today);
            $expire_time = strtotime($expire);

            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $username . "</td>";
            $dc = $row['data_creazione'];
            $data = date('d-m-Y', strtotime($dc));
            echo "<td>" . $data . "</td>";

            $di = $row['data_inizio'];
            $data = date('d-m-Y', strtotime($di));
            echo "<td>" . $data . "</td>";

            $df = $row['data_fine'];
            $data = date('d-m-Y', strtotime($df));
            echo "<td>" . $data . "</td>";

            echo "<td>" . $row['COUNT(invitati.id)'] . "</td>";

            if ($expire_time >= $today_time) {
                echo "<td>";
                echo "<form id=\"formAdd\" action=\"./invitaUtente.php\" method=\"POST\">";
                echo "<button class=\"buttonInvisible\"><i class=\"fas fa-user-plus\" id=\"operazioni\"></i></button>";
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $row['idsondaggio'] . "\">";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form id=\"formEdit\" action=\"./modificaSondaggio.php\" method=\"POST\">";
                echo "<button class=\"buttonInvisible\"><i class=\"fas fa-pencil-alt\" id=\"operazioni\"></i></button>";
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $row['idsondaggio'] . "\">";
                echo "<input type=\"hidden\" name=\"dataInizio\" value=\"" . $row['data_inizio'] . "\">";
                echo "<input type=\"hidden\" name=\"dataFine\" value=\"" . $row['data_fine'] . "\">";
                echo "<input type=\"hidden\" name=\"nomeSondaggio\" value=\"" . $row['nome'] . "\">";
                echo "</form>";
                echo "</td>";
                
            }else{
                echo "<td></td>";
                echo "<td></td>";
            }
            

            echo "<td>";
                echo "<form action=\"../database/listaRisposte.php\" method=\"POST\">";
                echo "<button class=\"buttonInvisible\"><i class=\"fas fa-list-ol\" id=\"operazioni\"></i></button>";
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $row['idsondaggio'] . "\">";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form action=\"../php/grafici.php\" method=\"POST\">";
                echo "<button class=\"buttonInvisible\"><i class=\"fas fa-chart-pie\"id=\"operazioni\"></i></button>";
                echo "<input type=\"hidden\" name=\"totalePartecipanti\" value=\"" . $row['COUNT(invitati.id)'] . "\">";
                echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $row['idsondaggio'] . "\">";
                echo "<input type=\"hidden\" name=\"nomeSondaggio\" value=\"" .  $row['nome']. "\">";
                echo "</form>";
                echo "</td>";
            echo "</tr>";
            echo "</div>";
        }
    }

    $connessione->close();


    ?>

                <a href="../../index.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>

<script src="../../js/script.js"></script>
</body>

</html>
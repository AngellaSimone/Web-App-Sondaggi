<?php
include "./connessione.php";
include "./sessione.php";
$username = $_SESSION['user'];
?>
<!DOCTYPE html>

<html>

<head>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
    <meta charset="UTF-8">
    <title>Crea Sondaggio</title>
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
    <div class="page">
        <?php

        $nomeSondaggio = $_POST['nomeS'];
        $dataInizio = date('Y-m-d', strtotime($_POST['dataInizio']));
        $dataFine = date('Y-m-d', strtotime($_POST['dataFine']));
        $dataCreazione = date('Y-m-d');

        $username = $_SESSION['user'];

        $query = "Select * from utenti where Username = \"$username\"";
        $result = $connessione->query($query);

        while ($row = $result->fetch_assoc()) {
            $idUtente =  $row['Id'];
        }
        $result->free();


        $query = "INSERT INTO sondaggi(autore_sondaggio, data_creazione, data_inizio, data_fine, nome)
          VALUES($idUtente,\"$dataCreazione\",\"$dataInizio\",\"$dataFine\",\"$nomeSondaggio\")";

        echo  "<div class=\"form\">";
        if (!$connessione->query($query)) {

            echo "<h2 class=\"h2\">Abbiamo riscontrato un errore nella creazione del tuo sondaggio, ti invitiamo a riprovare.</h2>";
            echo "<form class=\"form-login\" name=\"form\" action=\"./creaSondaggio.php\" method=\"POST\">";
            echo "<button>Indietro</button>";
            echo "</form>";
        } else {
            $query = "Select max(id) as id from sondaggi where autore_sondaggio = $idUtente";
            $result = $connessione->query($query);

            while ($row = $result->fetch_assoc()) {
                $idSondaggio =  $row['id'];
            }
            $result->free();
            echo "<h2 class=\"h2\">Creazione completata.</h2>";
            echo "<h2 class=\"h2\">Personalizza il tuo sondaggio.</h2>";
            echo "<form class=\"form-login\" name=\"form\" action=\"../php/creaDomanda.php\" method=\"POST\">";
            echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
            echo "<button class=\"button\" >Crea Domanda</button>";
            echo "</form>";
        }

        $_SESSION['idSondaggio'] = $idSondaggio;
        echo "</div>";
        // chiusura della connessione
        $connessione->close();

        ?>
    </div>
    <script src="../../js/script.js"></script>
</body>

</html>
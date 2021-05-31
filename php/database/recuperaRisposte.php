<?php
include "connessione.php";

$idUtente = $_GET["idUtente"];
$idSondaggio = $_GET["idSondaggio"];

 $query = "SELECT * 
 FROM risposte_date, opzioni_risposte, domande_sondaggi
 WHERE opzioni_risposte.id_domanda = domande_sondaggi.id
 AND risposte_date.id_opzione = opzioni_risposte.id
 AND risposte_date.id_utente = $idUtente
 AND domande_sondaggi.id_sondaggio = $idSondaggio";

$result = $connessione->query($query);


if($result->num_rows > 0)
{
        echo "<form action=\"../php/sondaggiInvitati.php\" method=\"POST\">";
        while ($row = $result->fetch_assoc()) {
            $testoDomanda = $row['testo_domanda'];
            echo "<h1 class=\"testoDomanda\">" . $testoDomanda . "</h1>";
            $risposta = $row['opzione'];
                echo "<h1 class=\"testoRisposta\">- " . $risposta . "</h1>"; 
        }
        echo "</form>"; 
}


$result->free();
// chiusura della connessione
$connessione->close();

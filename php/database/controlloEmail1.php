<?php
include "./connessione.php";

$email = $_GET["email"];
$idSondaggio = $_GET["idSondaggio"];

$query = "Select * from invitati where email_utente = \"$email\" and id_sondaggio = \"$idSondaggio\"";               
$result = $connessione->query($query);

if($result->num_rows > 0)
{
    echo "Questo utente è già stato invitato";
}


$result->free();
// chiusura della connessione
$connessione->close();

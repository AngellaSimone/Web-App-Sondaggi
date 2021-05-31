<?php
include "connessione.php";

$parametro = $_GET["stringa"];

$query = "Select * from utenti where username = \"$parametro\"";               
$result = $connessione->query($query);

if($result->num_rows > 0)
{
    echo "Username già in uso";
}


$result->free();
// chiusura della connessione
$connessione->close();
?>

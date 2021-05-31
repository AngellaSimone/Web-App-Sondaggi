<?php
include "connessione.php";

$parametro = $_GET["stringa"];

$query = "Select * from utenti where Email = \"$parametro\"";               
$result = $connessione->query($query);

if($result->num_rows > 0)
{
    echo "Email già in uso";
}


$result->free();
$connessione->close();

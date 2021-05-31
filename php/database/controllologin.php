<?php
include "./connessione.php";

$username = $_POST['username'];
$password = $_POST['pwd'];

$query = "SELECT Password FROM utenti WHERE Username = '$username'";
$result = $connessione->query($query);
while ($row = $result->fetch_assoc()) {
    $passwordDB = $row['Password'];
}


if (password_verify($password, $passwordDB)) {
    session_start();
    $_SESSION['user'] = $username;    //se la variabile username è settata la sessione è attiva
    $_SESSION['login_time'] = $_SERVER['REQUEST_TIME'];

    $query = "Select Id, Email from utenti where Username = '$username'";
    $result = $connessione->query($query);
    while ($row = $result->fetch_assoc()) {
        $idUtente =  $row['Id'];
        $emailUtente = $row['Email'];
    }
    $result->free();

    $_SESSION['idUtente'] = $idUtente;
    $_SESSION['Email'] = $emailUtente;

    header("location:../../index.php");
} else {
    header("location:../php/login.php");
}

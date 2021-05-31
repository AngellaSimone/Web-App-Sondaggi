<?php
session_start();
if (!isset($_SESSION['user']))
{
    header("location:login.php");
}
else   //si controlla la durata della sessione
{
    if (isset($_SESSION['login_time']))
    {
        $time = $_SESSION['login_time'];
        $_SESSION['login_time'] = $_SERVER['REQUEST_TIME'];
        if (time() > ($time + 1200))
        { // Passati 20 minuti, distruggi la sessione.
            session_unset();
            session_destroy();
            header("Location:login.php");
        }
    }
}

<?php
include "connessione.php";
include "./sessione.php";
?>
<html>

<head>
  <meta charset="UTF-8">
  <title>Salva Lista Utenti</title>
  <link href="../../css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <?php
  $idSondaggio = $_POST['idSondaggio'];


  $listaUtenti = $_POST['utenti'];


  $query = "Select nome from sondaggi where id = $idSondaggio";
  $result = $connessione->query($query);

  while ($row = $result->fetch_assoc()) {
    $nomeSondaggio =  $row['nome'];
  }
  $result->free();


  $queryEmail = "Select email_utente from invitati where id_sondaggio = $idSondaggio";
  $resultEmail = $connessione->query($queryEmail);

  $arrayEmail = array();
  $indice = 0;
  while ($row = $resultEmail->fetch_assoc()) {
    echo $row['email_utente'];
    $arrayEmail[$indice] =  $row['email_utente'];
    $indice++;
  }
  $resultEmail->free();


  $utentiDaAggiungere = count($listaUtenti);
  $count = 0;
  foreach ($listaUtenti as $utente) {

    $trovato = 0;
    foreach ($arrayEmail as $email) {
      if ($email == $utente) {
        $trovato = 1;
        $utentiDaAggiungere--;
        break;
      }
    }

    if ($trovato == 0) {
      $query = "INSERT INTO invitati(email_utente, id_sondaggio)
              VALUES(\"$utente\",$idSondaggio)";

      if (!$connessione->query($query)) {

        echo "<div class=\"page\"> <div class=\"form\">";
        echo "<h2>Abbiamo riscontrato un problema nel salvataggio degli invitati.</h2>";
        echo "<h2>Ti invitiamo a inserire nuovamente gli indirizzi e-mail.</h2>";
        echo "<form class=\"form-register\" name=\"form\" action=\"../php/invitaUtente.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"idSondaggio\" value=\"" . $idSondaggio . "\">";
        echo "<button>Indietro</button>";
        echo "</form>";
        echo "</div></div>";
        break;
      } else {
        invioEmail($utente, $nomeSondaggio);
        $count++;
      }
    }
  }

  if ($count == $utentiDaAggiungere) {
    header("location:../../index.php");
  }

  $connessione->close();


  function invioEmail($emailInvitato, $nomeSondaggio)
  {
    $to = $emailInvitato;
    $subject = 'Invito Sondaggio';
    $message = '
                <html>
                <head>
                  <title>Invito Sondaggio</title>
                </head>
                <body>
                  <p>Sei stato invitato al sondaggio "' . $nomeSondaggio . '"</p>
                  <p>Per rispondere alle domande accedi al sito.</p>
                  <p>Clicca <a href="https://sondaggi.altervista.org/php/php/login.php">qui</a> per accedere</p>
                  <p>Se non sei registrato clicca sul seguente link di registrazione.</p>
                  <p><a href="https://sondaggi.altervista.org/php/php/login.php">Registrati</a></p>
                </body>
                </html>
                ';


    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'From: nomesito... <webmaster@nomesito.com>';




    mail($to, $subject, $message, implode("\r\n", $headers));
  }

  ?>
</body>

</html>
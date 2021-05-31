<html>

<head>
  <meta charset="UTF-8">
  <title>Registrazione Utente</title>
  <link href="../../css/style.css" rel="stylesheet" type="text/css">

  <style>
    body {
      background-color: #0b273d;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      margin: 0;
    }
  </style>

</head>

<body>
  <?php
  include "./connessione.php";


  $nome = $_POST['nome'];
  $cognome = $_POST['cognome'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['pwd'];
  $passcrypt = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO utenti(Nome,Cognome,Email,Username, Password)
          VALUES(\"$nome\",\"$cognome\",\"$email\",\"$username\",\"$passcrypt\")";


  if (!$connessione->query($query)) {
    echo "<div class=\"page\"> <div class=\"form\">";
    echo  "<form class=\"form-register\" name=\"form\" action=\"../php/login.php\" method=\"POST\">";
    echo "<h2 class=\"h2\">Registrazione effettuata con successo. Riceverai a breve una email di conferma</h2>";
    echo "<button class=\"button\" id=\"bottone\">Riprova</button>";
    echo "</div>";
    echo "</div>";


    echo "<h2>Abbiamo riscontrato un errore nella tua registrazione, ti invitiamo a riprovare.</h2>";
    echo "Clicca <a href=\"../php/login.php\" qui <a/> per riprovare la registrazione";


  } else {
    echo "<div class=\"page\"> <div class=\"form\">";
    invioEmail($email, $nome);
    echo  "<form class=\"form-register\" name=\"form\" action=\"../php/login.php\" method=\"POST\">";
    echo "<h2 class=\"h2\">Registrazione effettuata con successo. Riceverai a breve una email di conferma</h2>";
    echo "<button class=\"button\" id=\"bottone\">Accedi</button>";
    echo "</div>";
    echo "</div>";
  }


  // chiusura della connessione
  $connessione->close();


  function invioEmail($email, $nome)
  {
    $to = $email;

    // Subject
    $subject = 'Conferma Registrazione';

    // Message
    $message = '
                <html>
                <head>
                  <title>Conferma Registrazione</title>
                </head>
                <body>
                  <p>Conferma Registrazione al sito ...</p>
                  <p>Ti sei registrato correttamente al sito.</p>
                  <p>Ora potrai creare, personalizzare e rispondere ai sondaggi.</p>
                  <p>Benvenuto ' . $nome . '</p>.
                  <p>Clicca <a href="https://sondaggi.altervista.org/php/php/login.php">qui</a> per accedere</p>
                </body>
                </html>
                ';

    // To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'From: nomesito... <webmaster@nomesito.com>';



    // Mail it
    mail($to, $subject, $message, implode("\r\n", $headers));
  }

  ?>
</body>

</html>
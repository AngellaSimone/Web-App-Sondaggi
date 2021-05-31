<?php
include "../database/connessione.php";
include "../database/sessione.php";
$idSondaggio = $_POST['idSondaggio'];
$nomeSondaggio = $_POST['nomeSondaggio'];
$totalePartecipanti = $_POST['totalePartecipanti'];
$query = "SELECT COUNT(*) as completati FROM `invitati` WHERE id_sondaggio = $idSondaggio AND completato = 1";
$votanti = 0;
$result = $connessione->query($query);
while ($row = $result->fetch_assoc()) {
  $votanti = $row['completati'];
}

$nonVotanti = $totalePartecipanti - $votanti;

$queryDomande = "SELECT * FROM `domande_sondaggi` WHERE id_sondaggio=$idSondaggio";

?>


<html>

<head>
  <link href="../../css/style.css" rel="stylesheet" type="text/css">
  <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <style>
    body {
      background-color: #0b273d;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      margin: 0;
    }
  </style>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <script type="text/javascript">
    colori = new Array();
    colori[0] = "red";
    colori[1] = "#28c1e0";
    colori[2] = "#1ad306";
    colori[3] = "#e0a80f";

    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Tipo', 'dato'],
        ['Votanti', <?php echo $votanti ?>],
        ['Non votanti', <?php echo $nonVotanti ?>]
      ]);

      var options = {
        title: 'Percentuale votanti/invitati\n Numero partecipanti: <?php echo $totalePartecipanti ?>',
        colors: colori,
        titleTextStyle: {
          color: '#27D7C9',
        },
        backgroundColor: '#0b273d',
        legend: {
          position: 'labeled',
          textStyle: {
            color: 'white',
            fontSize: 16
          }

        },
        sliceVisibilityThreshold: 0,


      };

      var chart = new google.visualization.PieChart(document.getElementById('piechartTot'));
      chart.draw(data, options);

      <?php
      $resultDomande = $connessione->query($queryDomande);
      while ($rowDomande = $resultDomande->fetch_assoc()) {
        $queryRisposte = "SELECT * FROM opzioni_risposte WHERE id_domanda=" . $rowDomande['id'] . "";
        $resultRisposte = $connessione->query($queryRisposte);
        $i =  0;

      ?>
        var data = google.visualization.arrayToDataTable([
          ['Risposta', 'Numero voti', {
            role: 'style'
          }],
          <?php
          while ($rowRisposte = $resultRisposte->fetch_assoc()) {
          ?>['<?php echo $rowRisposte['opzione'] ?>', <?php echo $rowRisposte['cont_risposte'] ?>, colori[<?php echo $i; ?>]],
          <?php
            $i++;
          } ?>
        ]);

        var options_pie = {
          colors: colori,
          legend: {
            position: 'right',
            display: 'none',
            textStyle: {
              color: 'white',
              fontSize: 16
            }

          },
          sliceVisibilityThreshold: 0,
          backgroundColor: '#0b273d',


        };

        var options_bar = {
          legend: {
            position: 'none'
          },
          sliceVisibilityThreshold: 0,
          backgroundColor: '#0b273d',
          hAxis: {
            textStyle: {
              color: "#FFFFFF"
            }
          },
          vAxis: {
            textStyle: {
              color: "#FFFFFF"
            }
          }

        };



        var divTorta = document.createElement("div");
        divTorta.setAttribute("id", <?php echo "\"Torta_" . $rowDomande['id'] . "\"" ?>);
        divTorta.setAttribute("style", "float: left; display: block; width: 50%; height: 30vh; margin-bottom: 25vh;");
        var testoDomanda = document.createElement("h1");
        testoDomanda.setAttribute("class", "titDomanda");
        testoDomanda.innerHTML = "<?php echo $rowDomande['testo_domanda'] ?>";
        document.getElementById("contGrafici").appendChild(testoDomanda);
        document.getElementById("contGrafici").appendChild(divTorta);

        var chart = new google.visualization.PieChart(document.getElementById(<?php echo "\"Torta_" . $rowDomande['id'] . "\"" ?>));
        chart.draw(data, options_pie);

        var divBar = document.createElement("div");
        divBar.setAttribute("id", <?php echo "\"Bar_" . $rowDomande['id'] . "\"" ?>);
        divBar.setAttribute("style", "float: left; display: block; width: 50%; height: 30vh; margin-bottom: 25vh;");
        document.getElementById("contGrafici").appendChild(divBar);

        var chart = new google.visualization.ColumnChart(document.getElementById(<?php echo "\"Bar_" . $rowDomande['id'] . "\"" ?>));
        chart.draw(data, options_bar);

      <?php
      }
      ?>

    }
  </script>
</head>

<body>
  <h1 id="titGrafico"><?php echo $nomeSondaggio ?></h1>
  <div id="contGrafici">
    <div id="piechartTot" style="width: 900px; height: 500px; margin: 0 auto; margin-bottom:150px;"></div>
  </div>


  </div>
  <a href="../../index.php" id="indietroButton"><i class="fas fa-angle-left" id="back"></i></a>
  <script src="../../js/script.js"></script>
</body>

</html>
function openSlideMenu() {
    document.getElementById('arrow').style.display = 'none';
    document.getElementById('menu').style.transform = "translateX(0)";

}

function closeSlideMenu() {
    document.getElementById('menu').style.transform = "translateX(-100%)";

    setTimeout(() => {
        document.getElementById('arrow').style.display = 'block';
    }, 700);

}

$('.message a').click(function() {
    $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
});


function mostramessaggio() {
    document.getElementById("messaggio").innerHTML = "Effettua il login per utilizzare le funzioni del sito";
    setTimeout(() => {
        document.getElementById("messaggio").innerHTML = "";
    }, 3000);

    return;
}

function rimuoviRisp(id) {
    console.log(id);
    var numInput = document.getElementById('contenitoreRisposte').getElementsByTagName('input').length;
    console.log(numInput);
    if (numInput <= 2) {
        return false;
    }
    var div = document.getElementById(id);
    div.parentNode.removeChild(div);
    return false;
}

function controlloDateCreazione() {
    var dataInizio = document.form.dataInizio.value;
    var dataFine = document.form.dataFine.value;

    var inizio = new Date(dataInizio);
    var fine = new Date(dataFine);


    if (inizio > fine) {
        document.getElementById("messDate").innerHTML = "La data di fine deve essere maggiore o uguale alla data di inizio";
        return false;
    }

    return true;

}


function controlloEmailUt(str, num_elemento, idSondaggio) {
    var idelemento = "messEmail".concat(num_elemento);
    if (str.length == 0) {
        document.getElementById(idelemento).innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.length > 0) {
                    document.getElementById(idelemento).innerHTML = this.responseText;
                    document.getElementById("bottone").disabled = true;
                } else {
                    document.getElementById(idelemento).innerHTML = "";
                    document.getElementById("bottone").disabled = false;
                }
            }
        };
        xmlhttp.open("GET", "../database/controlloEmail1.php?email=" + str + "&idSondaggio=" + idSondaggio, true);
        xmlhttp.send();
    }

}

function rimuoviUt(idUt) {
    var numInput = document.getElementById('contenitoreUtenti').getElementsByTagName('input').length;
    if (numInput > 1) {
        var div = document.getElementById(idUt);
        div.parentNode.removeChild(div);
    }
    return false;
}

var idcount = 1;

function aggiungiUt() {
    var numInput = document.getElementById('contenitoreUtenti').getElementsByTagName('input').length;

    idcount++;
    var div = document.createElement("div");
    div.setAttribute("id", idcount);
    div.classList.add("position");
    var input = document.createElement("input");
    input.setAttribute("type", "email");
    input.setAttribute("name", "utenti[]");
    input.setAttribute("onkeyup", "controlloEmail(this.value,idcount)");
    var span = document.createElement("span");
    var i = document.createElement("i");
    i.classList.add("fas");
    i.classList.add("fa-times");
    i.setAttribute("id", "x")
    var rimuovi = "rimuoviUt(".concat(idcount).concat(")");
    span.setAttribute("onclick", rimuovi);
    var span1 = document.createElement("span");
    span1.setAttribute("id", "messEmail".concat(idcount));
    span.appendChild(i)
    div.appendChild(input);
    div.appendChild(span);
    div.appendChild(span1);
    document.getElementById("contenitoreUtenti").appendChild(div);

    return false;
}

var idcount = 2;

function aggiungiRisp() {
    var numInput = document.getElementById('contenitoreRisposte').getElementsByTagName('input').length;

    if (numInput == 4) {
        return false;
    }
    idcount++;
    console.log(idcount);
    var div = document.createElement("div");
    div.setAttribute("id", idcount);
    div.classList.add("position");
    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name", "risposte[]");
    var button = document.createElement("button");
    var span = document.createElement("span");
    var i = document.createElement("i");
    i.classList.add("fas");
    i.classList.add("fa-times");
    i.setAttribute("id", "x")
    var rimuovi = "return rimuoviRisp(" + idcount + ")";
    console.log(rimuovi);
    span.setAttribute("onclick", rimuovi);
    span.appendChild(i)
    div.appendChild(input);
    div.appendChild(span);
    document.getElementById("contenitoreRisposte").appendChild(div);

    return false;
}

function controlloEmailLogin(str) {
    if (str.length == 0) {
        document.getElementById("messEmail").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.length > 0) {
                    document.getElementById("messEmail").innerHTML = this.responseText;
                    document.getElementById("bottone").disabled = true;
                } else {
                    document.getElementById("messEmail").innerHTML = "";
                    document.getElementById("bottone").disabled = false;
                }
            }
        };
        xmlhttp.open("GET", "../database/controlloEmail.php?stringa=" + str, true);
        xmlhttp.send();
    }

}

function controlloUsernameLogin(str) {

    if (str.length == 0) {
        document.getElementById("messUsername").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.length > 0) {
                    document.getElementById("messUsername").innerHTML = this.responseText;
                    document.getElementById("bottone").disabled = true;
                } else {
                    document.getElementById("messUsername").innerHTML = "";
                    document.getElementById("bottone").disabled = false;
                }
            }
        };
        xmlhttp.open("GET", "../database/controlloUsername.php?stringa=" + str, true);
        xmlhttp.send();
    }

}

function controlloDateEdit() {
    var dataInizio = document.form.dataInizio.value;
    var dataFine = document.form.dataFine.value;

    var inizio = new Date(dataInizio);
    var fine = new Date(dataFine);


    if (inizio > fine) {

        document.getElementById("messDate").innerHTML = "La data di fine deve essere maggiore o uguale alla data di inizio";
        return false;
    }

    return true;

}


function recuperaRisposte() {
    var valore_selezionato = document.getElementById("utenti").value;
    if (valore_selezionato == "nessuno") {
        document.getElementById("risposte").innerHTML = "";

    } else {
        var arrayparametri = valore_selezionato.split("-");
        var idUtente = arrayparametri[0];
        var idSondaggio = arrayparametri[1];

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.length > 0) {
                    document.getElementById("risposte").innerHTML = this.responseText;
                } else {
                    document.getElementById("risposte").innerHTML = "";
                }
            }
        };
        xmlhttp.open("GET", "../database/recuperaRisposte.php?idUtente=" + idUtente + "&idSondaggio=" + idSondaggio, true);
        xmlhttp.send();

    }

}

function disegnaTorta() {
    //var valore_selezionato = document.getElementById("domande").value;
    var valore_selezionato = 2;
    if (valore_selezionato == "nessuno") {
        document.getElementById("grafico").innerHTML = "";

    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.length > 0) {
                    document.getElementById("grafico").innerHTML = this.responseText;
                } else {
                    document.getElementById("grafico").innerHTML = "";
                }
            }
        };
        xmlhttp.open("GET", "../database/recuperaTorta.php?idDomanda=" + valore_selezionato, true);
        xmlhttp.send();

    }

}
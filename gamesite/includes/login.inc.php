<?php

//Login include som bliver brugt når vi trykker på sumbit (login)
if (isset($_POST["submit"])) {

    //POST er en super variable. Bruges til at hente vores brugernavn og kode og vidergive til en variable.
    $brugernavn = $_POST["uid"];
    $pwd = $_POST["pwd"];

    //Bruger vores andre include files.
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Her siger vi hvis vores function emptyInputLogin ikke er false at den skal give fejl meddelelse.
    if (emptyInputLogin($brugernavn, $pwd) !== false){
        header ("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $brugernavn, $pwd);
}
else {
    header ("location: ../profil.php");
    exit();
}

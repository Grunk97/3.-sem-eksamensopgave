<?php

//Kunne ikke finde fejlen i min kode så fandt de næste to linjers kode på nettet som kunne udskrive mine fejl.
ini_set("display_errors", "1");
error_reporting(E_ALL);

    //Sørger for at man kun kan komme ind på opret.inc.php siden ved at trykke på opret knappen og ikke skriver noget ind i browseren
    if (isset($_POST["submit"])) {
        
        //Kobler inputfelterne sammen med en varibale
        $brugernavn = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdGentag = $_POST["pwdgentag"];
        $name = $_POST["name"];
        $email = $_POST["email"];

        //Kobler vores inc filer sammen
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        //Tjekker om vores inputs er sande eller falske via en funtion som står i functions.inc.php
        if (emptyInputSignup($brugernavn, $pwd, $pwdGentag, $name, $email) !== false){
            header ("location: ../opret.php?error=emptyinput");
            exit();
        }
        if (invalidUid($brugernavn) !== false){
            header ("location: ../opret.php?error=invaliduid");
            exit();
        }
        if (invalidEmail($email) !== false){
            header ("location: ../opret.php?error=invalidemail");
            exit();
        }
        if (passwordMatch($pwd, $pwdGentag) !== false){
            header ("location: ../opret.php?error=passwordsdontmatch");
            exit();
        }
        if (uidExists($conn, $brugernavn, $email) !== false){
            header ("location: ../opret.php?error=usernametaken");
            exit();
        }

        createUser($conn, $brugernavn, $pwd, $name, $email);

    }
    else {
        header ("location: ../index.php");
        exit();
    }
?>
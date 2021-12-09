<?php
// Vi connecter her til vores database. Har sat den i en includes folder så vi kan bruge den på alle sider uden at skulle skrive det igen.
    $servername = "simonsendesign.dk.mysql";
    $username = "simonsendesign_dkgamesite";
    $password = "gamesite";
    $db = "simonsendesign_dkgamesite";

    $conn = mysqli_connect($servername, $username, $password, $db);

//Hvis vi ikke har connection skal den "dø" og udskrive hvad fejlen er til det.
    if(!$conn)
    {
        die("Connection failed : " . mysqli_connect_error());
    }
?>
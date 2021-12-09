<?php
    
//logger brugeren ud
session_start();
session_unset();
session_destroy();

//Sender os tilbage til login siden.
header ("location: ../index.php");
exit();
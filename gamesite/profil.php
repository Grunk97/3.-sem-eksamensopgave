<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="main">
<div class="container-fluid">
            <div class="row input1">
                <div class="col-12">
                    <h1 class="overskrift">PROFIL</h1>
                </div>
                <div class="col-12">
                        <h3>DIN PROFIL</h3>
                        <img class="profilbillede" src="img/profile.jpg" alt="profilbillede">
                        <section>
                                <?php

                                    // Her henter vi highscore
                                    //$sql = "SELECT * FROM usersscore WHERE userId = " . "'test123'" . " ORDER BY userScore DESC LIMIT 1";
                                    $sql = "SELECT * FROM usersscore WHERE userId = '" . $_SESSION["useruid"] . "' ORDER BY userScore DESC LIMIT 1";
                                    $conn = new mysqli("simonsendesign.dk.mysql", "simonsendesign_dkgamesite", "gamesite", "simonsendesign_dkgamesite");
                                    $myresult = $conn -> query($sql);
                                    
                                    while($row = $myresult -> fetch_assoc())
                                    {
                                        $_SESSION["score"] = $row["userScore"];
                                        //$_SESSION["score"] = "5";  
                                    }
                
                                    if (isset($_SESSION["useruid"])) {
                                        echo "<p> BRUGERNAVN: " . $_SESSION["useruid"] . "</p>";
                                        echo "<p> USER ID: " . $_SESSION["userid"] . "</p>";
                                        echo "<p> DIN HIGHSCORE: " . $_SESSION["score"] . "</p>";
                                        echo "</br>";
                                        echo "<a class='opretknap' href='gamesite.php'>SPIL</a>";
                                        echo "</br>";
                                        echo "<a class='opretknap' href='kontakt.php'>KONTAKT</a>";
                                        echo "</br>";
                                        echo "<a class='opretknap' href='includes/logout.inc.php'>LOG UD</a>";
                                    }
                                    else {
                                        echo "Du er ikke logget ind.";
                                        echo "</br>";
                                        echo "<a class='opretknap' href='index.php'>LOG IND</a>";
                                    }
                                ?>
                        </section>
                </div>
            </div>
            <div class="col-12">
                <div class="wrapper">
                    <div class="firkant">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
</div>
</body>
</html>
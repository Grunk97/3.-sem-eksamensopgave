<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
</head>
<body class="main">
    <div class="container-fluid">
        <div class="row">
            <section class="opret-form">

                <div class="col-12">
                    <h1 class="overskrift">OPRET PROFIL</h1>
                </div>

                <form action="includes/opret.inc.php" method="post">

                    <div class="row input">
                        <div class="col-12">
                            <input class="inputfelt" type="text" name="uid" placeholder="BRUGERNAVN">
                        </div>
                    </div>

                    <div class="row input">
                        <div class="col-12">
                            <input class="inputfelt" type="password" name="pwd" placeholder="PASSWORD">
                        </div>
                    </div>

                    <div class="row input">
                        <div class="col-12">
                            <input class="inputfelt" type="password" name="pwdgentag" placeholder="GENTAG PASSWORD">
                        </div>
                    </div>

                    <div class="row input">
                        <div class="col-12">
                            <input class="inputfelt" type="text" name="name" placeholder="FULDE NAVN">
                        </div>
                    </div>

                    <div class="row input">
                        <div class="col-12">
                            <input class="inputfelt" type="text" name="email" placeholder="EMAIL">
                        </div>
                    </div>

                    <?php
                //POST metoden kan man se i url og GET metoden kan man ikke se i url
                //Vi tjekker hvilken fejlkode vi får og derfra kan vi echo nogle tilbage meldinger ud fra hvilke fejl vi får
                if (isset($_GET["error"])){
                    if ($_GET["error"] == "emptyinput") {
                        echo "<p class='validering'>Fyld alle felterne ud!</p>";
                    }
                    else if ($_GET["error"] == "invaliduid") {
                        echo "<p class='validering'>Brug et rigtigt brugernavn!</p>";
                    }
                    else if ($_GET["error"] == "invalidemail") {
                        echo "<p class='validering'>Brug en rigtig Email!</p>";
                    }
                    else if ($_GET["error"] == "passworddontmatch") {
                        echo "<p class='validering'>Passwords er ikke ens!</p>";
                    }
                    else if ($_GET["error"] == "usernametaken") {
                        echo "<p class='validering'>Brugernavnet er allerede taget!</p>";
                    }
                    else if ($_GET["error"] == "none") {
                        echo "<p class='validering1'>Du har nu oprettet en bruger! Gå til login.</p>";
                    }
                }
                ?>

                    <div class="row input">
                        <div class="col-12">
                            <button class="opretknap" type="submit" name="submit">OPRET PROFIL</button>
                            <br>
                            <a class='opretknap' href='index.php'>LOGIN</a>
                        </div>
                    </div>
                </form>
            </section>
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
    </div>
</body>
</html>
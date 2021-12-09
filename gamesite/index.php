<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="main">
    <div class="continer-fluid">
        <div class="row input1">
            <div class="col-12">
                <section class="login-form">
                    <h1 class="overskrift">LOGIN</h1>
                </section>    
            </div>

            <form action="includes/login.inc.php" method="post">
            <div class="col-12">
                <input class="inputfelt" type="text" name="uid" placeholder="BRUGERNAVN/EMAIL">
            </div>

            <div class="col-12">
                <input class="inputfelt" type="password" name="pwd" placeholder="PASSWORD">
            </div>

            <div class="col-12">
            <?php
                    //POST metoden kan man se i url og GET metoden kan man ikke se i url
                    //Vi tjekker hvilken fejlkode vi får og derfra kan vi echo nogle tilbage meldinger ud fra hvilke fejl vi får
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyinput") {
                            echo "<p class='validering'>Fyld alle felterne ud</p>";
                        }
                        else if ($_GET["error"] == "wronglogin") {
                            echo "<p class='validering'>Dette er ikke en profil!</p>";
                        }
                    }
                ?>
            </div>

            <div class="col-12">
                <button class="opretknap1" type="submit" name="submit">LOGIN</button> 
            </div>
            </form>  
            
            <div class="col-12">
                <a class="opretknap" href="opret.php">OPRET PROFIL</a>
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

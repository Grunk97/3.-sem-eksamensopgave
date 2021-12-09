<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spil</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/script6.js"defer></script>
</head>
<body class="spil">
    <div class="container-fluid">
        <div class="row input1">
            <div class="col-lg-3 col-md-12 col-sm-12">

            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <h1 class="overskriftspil">Diamonds 'n' Monsters</h1>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 profilhjørne">
                <a class="profilhjørneknap" href="profil.php">
                <div>
                    <img class="profilbilledespil" src="img/profile.jpg" alt="profil billede">
                </div>
                <div>
                    <section>
                        <?php
                            if (isset($_SESSION["useruid"])) {
                                echo "<p class='brugernavnspil'>" . $_SESSION["useruid"] . "</p>";
                            }
                            else {
                                echo "Du er ikke logget ind.";
                                echo "</br>";
                                echo "<a class='opretknap' href='index.php'>LOG IND</a>";
                            }
                        ?>
                    </section>
                </a>
                </div>
            </div>
        </div>


        <div class="row input1">
            <div class="col-lg-3 col-md-12 col-sm-12 omrids">
            <h3 class="overskriftspil2">HIGHSCORE</h3>
                    <?php
                    $sql = "SELECT * FROM usersscore, users WHERE users.userId = usersscore.userId ORDER BY userScore DESC LIMIT 10";
                    $conn = new mysqli("simonsendesign.dk.mysql", "simonsendesign_dkgamesite", "gamesite", "simonsendesign_dkgamesite");
                    $myresult = $conn -> query($sql);
                    echo "<table>"; 
                    echo "<tr>";
                    echo "<th>PLADS</th>";
                    echo "<th>BRUGERNAVN</th>";
                    echo "<th>POINT</th>"; 
                    echo "</tr>";
                    
                    $plads = 0;

                    while($row = $myresult -> fetch_assoc())
                    {
                        $plads = $plads +1;
                        echo "<tr>";
                        echo "<th>" . $plads . "</th>"; 
                        echo "<th>" . $row["userUid"] . "</th>";
                        echo "<th>" . $row["userScore"] . "</th>"; 
                        echo "</tr>";
                    }

                    echo "</table>";
                    ?>
                
                <div class="box">
                    <a class="opretknap2" href="#popup2">INDLÆS SCORE</a>
                </div>
                <div id="popup2" class="overlay">
                    <div class="popup">
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <form action="spil.php" method="post">
                                <h3 class="overskriftspil1">SCORE</h3>
                                <?php
                                    //connect til database
                                    $conn = new mysqli("simonsendesign.dk.mysql", "simonsendesign_dkgamesite", "gamesite", "simonsendesign_dkgamesite");
                                ?>

                                <?php
                                    if($_SERVER['REQUEST_METHOD'] === 'POST')
                                    {
                                        //create
                                        //Er knappen trykket på
                                        if($_REQUEST['knap'] == "INDLÆS SCORE")
                                        {
                                            //Henter de 4 fælter
                                            //$id = $_REQUEST['id'];
                                            $userScore = $_REQUEST['userScore'];
                                            $userId = $_REQUEST['userId'];
                                            if(is_numeric($userScore))
                                            {
                                                $sql = $conn->prepare("insert into usersscore (userScore, userId) values (?, ?)");
                                                $sql->bind_param("ii", $userScore, $userId);
                                                $sql->execute();
                                            }
                                        }
                                    }
                                ?>
                                <?php
                                    $conn->close();
                                ?>
                                    <input class="inputfelt" placeholder="SCORE" type="text" name="userScore" value="<?php echo isset($userScore) ? $userScore :'' ?>">
                                    <br>
                                    <input class="inputfelt" placeholder="USER ID" type="text" name="userId" value="<?php echo isset($userId) ? $userId :'' ?>">
                                    <br>
                                    <input class="opretknap1" type="submit" name="knap" value="INDLÆS SCORE">
                            </form>
                            <?php
                            if (isset($_SESSION["useruid"])) {
                            echo "<p> USER ID: " . $_SESSION["userid"] . "</p>";
                            }
                            else {
                            echo "Du er ikke logget ind.";
                            echo "</br>";
                            echo "<a class='opretknap' href='index.php'>LOG IND</a>";
                            }
                    ?>     
                        </div>
                    </div>
                </div>
                                
                <div class="box">
                    <a class="opretknap2" href="#popup1">REGLER</a>
                </div>
                <div id="popup1" class="overlay">
                    <div class="popup">
                        <a class="close" href="#">&times;</a>
                        <div class="content">
                            <h3 class="overskriftspil1">REGLER</h3>
                            <p class="tekst">Find alle diamanterne så hurtigt som muligt.</p>
                            <p class="tekst">Når du har fundet alle diamanterne skal du skynde dig i mål.</p>
                            <p class="tekst">Hvis du går ind i et monster mister du et 33.3 HP og bliver rykket tilbage til start.</p>
                            <p class="tekst">Hvis du går ind i en void mister du et 100 HP og taber spillet.</p>
                            <p class="tekst">Du har 100 HP.</p>
                            <p class="tekst">Hvis du mister alt dit HP starter du forfra.</p>
                        </div>
                    </div>
                </div>
        </div>

                <div class="col-lg-5 col-md-12 col-xs-12">
                    <audio src="sound/background.mp3"></audio>
                    <canvas id="gameover" id="win" width="1000" height="1000"></canvas>
                <div class="col-12 tid">
                    <label id="minutes">00</label>:<label id="seconds">00</label>
                </div>
                <div>
                    <p>Din score: <span id="score"></span></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
            </div>
        </div>
        <div class="row input1">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <p>HP <progress id="health" value="30" max="30"></progress> <progress id="point" value="0" max="100"></progress> XP </p>
                <input class="opretknapspil" id="reset" type="reset" value="RESTART">
            </div>
        </div>
    </div>
</body>
</html> 
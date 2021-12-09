<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamesite</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="main">
    <div class="container-fluid">

        <div class="row input1">
            <div class="col-lg-12">
                <h1 class="overskriftspil">GAMES</h1>
            </div>
        </div>

        <div class="row input1">
            <div class="col-lg-4 ml-auto">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/game1.JPG" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">DIAMONDS N MONSTES</h5>
                      <p class="card-text">Saml diamander og undgå de mange monster og kræfthuller.</p>
                      <a class="knap" href="spil.php" class="btn btn-primary">SPIL</a>
                    </div>
                  </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/comingsoon.JPG" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">FLYING SCOUTS</h5>
                      <p class="card-text">Spillet er ved at blive færdiggjort. Slå din rekord i MONSTERS N DIAMONDS.</p>
                      <a class="knap" href="#" class="btn btn-primary" onClick='alert("Spillet er endnu ikke lavet!")'>SPIL</a>
                    </div>
                  </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="img/comingsoon.JPG" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">BRAIN PUZZLE</h5>
                      <p class="card-text">Spillet er ved at blive færdiggjort. Slå din rekord i MONSTERS N DIAMONDS. </p>
                      <a class="knap" href="#" class="btn btn-primary" onClick='alert("Spillet er endnu ikke lavet!")'>SPIL</a>
                    </div>
                  </div>
            </div>
            <div class="col-12">
                <br>
                <a class="opretknap" href="profil.php">PROFIL</a>
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
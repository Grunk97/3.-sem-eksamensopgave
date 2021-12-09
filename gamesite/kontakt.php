<?php
    //Hvis vi trykker på submit knappe skal følgende ske.
    if(isset($_POST['submit'])) {
       $name = $_POST['name'];
       $subject = $_POST['subject'];
       $email = $_POST['email'];
       $message = $_POST['message'];

       if(empty($name) || empty($subject) || empty($email) || empty($message)) {
           header("Location: kontakt.php?error");
       }
       else {
        //Laver en variabel som indeholder min mail.
            $mailTo = "matthimand@gmail.com";

            //Laver en variabel som har en variabel og en string i.
            $headers = "Fra: " .$email;

            //Laver en variable som har en string og to variable i \n\n sender os to linjer ned.
            $txt = "Du har modtaget en email fra " .$name.".\n\n".$message;

            if(email($mailTo, $subject, $txt, $headers)){
                header("Location: kontakt.php?succes");
            }
        }
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="main">
    <div class="container-fluid">
        <div class="row input1">
            <div class="col-12">
                <h1 class="overskrift">KONTAKT</h1>
            </div>

            <div class="col-12">
                <?php
                    $besked = "";
                    if(isset($_GET['error'])) {
                        $besked = " Udfyld alle felterne";
                        echo "<div class='validering'>".$besked."</div>";
                    }
                    if(isset($_GET['succes'])) {
                        $besked = " Din besked er blevet sendt ";
                        echo "<div class='validering'>".$besked."</div>";
                    }
                ?>
            </div>

            <form action="kontakt.php" method="POST">
                <div class="col-12">
                    <input class="inputfelt" type="text" name="name" placeholder="FULDE NAVN">
                </div>
                <div class="col-12">
                    <input class="inputfelt" type="text" name="email" placeholder="EMAIL">
                </div>
                <div class="col-12">
                    <input class="inputfelt" type="text" name="subject" placeholder="EMNE">
                </div>
                <div class="col-12">
                    <textarea class="inputfelt" name="message" placeholder="BESKED"></textarea>
                </div>
                <div class="col-12">
                    <button class="opretknap" type="sumbit" name="submit">SEND</button>
                </div>
                <div class="col-12">
                        <a class='opretknap' href='profil.php'>PROFIL</a>
                </div>
            </form>        
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
<?php
//Laver en function som siger hvis der er en af vores felter der er tomme.
function emptyInputSignup($brugernavn, $pwd, $pwdGentag, $name, $email) {
    //Result bliver sat som en variable udenfor så vi ikke skal genskrive koden flere gange
    $result;
    //Empty er inbygget i php som tjekker om der er data eller ikke data, hvis vi har data i alle felter returner den false ellers returne den true hvis vi ikke har noget i alle felterne true.
    if (empty($brugernavn) || empty($pwd) ||  empty($pwdGentag) || empty($name) || empty($email)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//Laver en function som tjekker om vores brugernavn er skrevet korrekt.
function invalidUid($brugernavn) {
    $result;
    //Tjekker om der er specefikke eller ikke specefikke charaters i feltet også kaldt search algorytme. Hvis ikke der er fejl i sætter vi result til false og hvis der er fejl i sætter vi den til true.
    if (!preg_match("/^[a-zA-Z0-9]*$/", $brugernavn)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//Laver en function som tjekker om vi har indskrevet en email.
function invalidEmail($email) {
    $result;
    //filter_var er en indbygget function der tjekker om emailen er korrekt. I vores parameter indsætter vi email da vi gerne vil tjekke den, så denne metode går ind og tjekker om vores første parameter er true eller false.
    //Hvis det er en email sender vi false til result og true hvis det ikke er en email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//Laver en function der tjekker om vores passwords matcher hinanden.
function passwordMatch($pwd, $pwdGentag) {
    $result;
    //Tjekker om de to indskrevet passwords er ens.
    //Hvis de er ens sender den false ud og hvis de ikke er ens sender den true ud.
    if ($pwd !== $pwdGentag) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//Laver en function der tjekker om der er et allerede existerende brugernavn eller email i vores database.
function uidExists($conn, $brugernavn, $email) {
    //Laver er prepare statement så der ikke bliver skrevet kode ind i felterne.
    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header ("location: ../opret.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $brugernavn, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    //Hvis der er data i databasen med dette brugernavn vil jeg tage fat i dataen med denne brugernavn. Denne function bruges også når vi skal login, så hvis den er true skal vi bruge den når vi logger ind og hvis den er false skal vi bruge den til at oprette en bruger.
    //Udover dette laver vi en variable som hedder row som får denne data.
    //Hvis der er en bruge med denne data bliver den brugt til login siden.
    //På denne måde kan vi bruge samme function til på opret og login siden.
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//Laver en function der opretter vores bruger i databasen, hvis der ikke er en fejl.
function createUser($conn, $brugernavn, $pwd, $name, $email) {
    //Laver er prepare statement så der ikke bliver skrevet dårlig kode ind i felterne.
    $sql = "INSERT INTO users (userUid, userPwd, userName, userEmail) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header ("location: ../opret.php?error=stmtfailed");
        exit();
    }

    //Bruger en metode som hasher vores kode så man har svære ved at få fat i koden som hacker.
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $brugernavn, $hashedPwd, $name, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header ("location: ../opret.php?error=none");
    exit();
}

//Laver en function som tjekker om der er nogle af input felterne der er tomme til login siden.
function emptyInputLogin($brugernavn, $pwd) {
    $result;
    //empty er inbygget i php som tjekker om der er data eller ikke data, hvis vi har data i alle felter returner den false ellers true.
    if (empty($brugernavn) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//Laver en function som tjekker om der bliver skrevet en email eller brugernavn ind samt kode
function loginUser($conn, $brugernavn, $pwd) {
    //Vi tjekker om der er skrevet en email eller en brugernavn ind ved brug af tidligere function
    $uidExists = uidExists($conn, $brugernavn, $brugernavn);

    //Hvis brugeren ikke findes giver den os fejl
    if ($uidExists === false) {
        header ("location: ../index.php?error=wronglogin");
        exit();
    }

    //Her går vi ind og tager et password fra den column som har userPwd i sig og sætter den lig med pwdHashed og nu kan vi bruge det i resten af koden
    $pwdHashed = $uidExists["userPwd"];
    //Her tjekker vi om password som bruger har givet os er den samme fra databasen.
    $checkPwd = password_verify($pwd, $pwdHashed);

    //Hvis checkPwd kommer tilbage som false matcher de ikke hinaden på databasen og vi får så en fejl.
    if ($checkPwd === false) {
        header ("location: ../index.php?error=wronglogin");
        exit();
    }
    //Hvis alt stemmer over ens, smider den os ind på vores profil side.
    else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["userId"];
        $_SESSION["useruid"] = $uidExists["userUid"];
        header ("location: ../profil.php");
        exit();
    }
}
<?php
if(isset($_POST['register'])) {
    if(!empty($_POST)) {


        $user = new User();




        // $gebruikersnaam = $_POST['username'];
        // $email = $_POST['email'];
        // $wachtwoord = $_POST['password'];
        // var_dump($_POST);

    }
} else {
    $error="vul alle velden in aub";
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body class="bodyy">
    <a class="back" href="firstScreen.php"><img src="img/back.png" alt=""></a>
    <div class="logoLogin"><img src="img/logo3.png" alt="foto"></div>
    <div class="boxLogin">
        <div class="inputBoxLogin">
            <h2>registreren</h2>
        </div>
        <div class="registerForm">
            <form action="" method="post">
                <p>gebruikersnaam</p>
                <input type="text" name="username" id="username" placeholder="gebruikersnaam">
                <p class="registerEmail">emailadres</p>
                <input type="text" name="email" id="email" placeholder="emailadres">
                <p class="pswd">wachtwoord</p>
                <input type="password" name="password" id="password" placeholder="wachtwoord">

                </div>
                <div class="formBtn2">
                    <input class="registerBtn" type="submit" value="registreren" name="register" id=""></input>
                </div>
                <div class="lastLinkRegister">
                    <a href="registreer.php">Al een account? log hier in</a>
                </div>

            </form>


        
    </div>
</body>
</html>
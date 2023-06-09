<?php
include_once(__DIR__ . "/bootstrap.php");

if (isset($_POST['login'])) {

    if (!empty($_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User();

        if ($user->canLogin($username, $password)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['id'] = $user->getIdByUsername($username);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $_SESSION['id'];

            header('Location: index.php');
        } else {
            $loginError = "Gebruikersnaam of wachtwoord is onjuist";
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
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <a class="back" href="firstScreen.php"><img src="img/back.png" alt=""></a>
    <div class="logo">
        <div id="logo_zwart"></div>
    </div>

    <div class="log">
        <div class="boxLogin">
            <div class="loginForm">
            <h2>inloggen</h2>
                <form action="" method="post">
                    <p>gebruikersnaam</p>
                    <input type="text" name="username" id="username" placeholder="gebruikersnaam">
                    <p class="pswd">wachtwoord</p>
                    <input type="password" name="password" id="password" placeholder="wachtwoord">
                    <?php if (isset($loginError)) : ?>
                        <p><?php echo $loginError; ?></p>
                    <?php endif; ?>


                    <div class="btns">
                        <!-- <a class="inlogBtn" href="login.php"><p>inloggen</p></a> -->
                        <input class="inlogBtn" type="submit" value="inloggen" name="login" id=""></input>
                    </div>
                    <div class="lastLink">
                        <a href="registreer.php">nog geen account? registreer hier</a>
                    </div>

                </form>

            </div>


        </div>
    </div>
</body>

</html>
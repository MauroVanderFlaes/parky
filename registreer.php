<?php

include_once(__DIR__ . "/bootstrap.php");



if (isset($_POST['register'])) {
    if (!empty($_POST)) {
        try {
            $user = new User();
            try {
                $user->setUsername($_POST['username']);
            } catch (\Throwable $th) {
                $usernameError = $th->getMessage();
            }
            try {
                $user->setEmail($_POST['email']);
            } catch (\Throwable $th) {
                $emailError = $th->getMessage();
            }
            try {
                $user->setPassword($_POST['password']);
            } catch (\Throwable $th) {
                $passwordError = $th->getMessage();
            }


            $user->save();
            // var_dump($user);
            header('Location: index.php');
        } catch (\Throwable $th) {
            $error = $th->getMessage();
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

<body class="bodyy">
    <a class="back" href="firstScreen.php"><img src="img/back.png" alt=""></a>
    <div class="logo">
        <div id="logo_zwart"></div>
    </div>
    <div class="log">
        <div class="boxLogin">
            <div class="loginForm">
                <h2>registreren</h2>
                <form action="" method="post">
                    <p>gebruikersnaam</p>
                    <input type="text" name="username" id="username" placeholder="gebruikersnaam">
                    <?php if (isset($usernameError)) : ?>
                        <p><?php echo $usernameError; ?></p>
                    <?php endif; ?>
                    <p class="registerEmail">emailadres</p>
                    <input type="text" name="email" id="email" placeholder="emailadres">
                    <?php if (isset($emailError)) : ?>
                        <p><?php echo $emailError; ?></p>
                    <?php endif; ?>
                    <p class="pswd">wachtwoord</p>
                    <input type="password" name="password" id="password" placeholder="wachtwoord">
                    <?php if (isset($passwordError)) : ?>
                        <p><?php echo $passwordError; ?></p>
                    <?php endif; ?>
                    <div class="btns">
                        <input class="inlogBtn" type="submit" value="registreren" name="register" id=""></input>
                    </div>
                    <div class="lastLink">
                        <a href="login.php">Al een account? log hier in</a>
                    </div>

                </form>



            </div>
        </div>

</body>

</html>
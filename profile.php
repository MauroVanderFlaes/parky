<?php 

include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");

// get info from user whos logged in
// $user = new User();
// $gegevens = $user->getUserInfo($user_id);

// var_dump($gegevens['locations_count']);


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>

<body>
   
    <?php $gegevens = User::getUserInfo($user_id) ?>
    <!-- <?php var_dump($gegevens['locations_count']) ?> -->
    <div class="logo">
        <div id="logo_zwart"></div>
    </div>
    <div class="plaats">
        <div class="flex flex-col justify-center items-center mt-5">
            <h1>account</h1>
            <div class="rounded">
                <img src="img/profileicon.png" alt="foto" class="rounded-full w-40 h-40 object-cover">
                <span class="circle"></span>
            </div>
        </div>
        <div class="accBox">
            <div class="gegevens">
                <h2>account gegevens</h2>
                <img src="img/edit.png" alt="">
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="links">
                        <h3>naam</h3>
                        <p><?php echo $_SESSION['username'] ?></p>
                    </div>
                    <!-- <div class="rechts">
                        <h3>Achternaam</h3>
                        <p>Van der Flaes</p>
                    </div> -->
                    <div class="links">
                        <h3>Email</h3>
                        <p><?php echo $_SESSION['email'];  ?></p>
                    </div>
                </div>
                <div class="box">
                    <!-- <div class="links">
                        <h3>Telefoonnummer</h3>
                        <p>0478 12 34 56</p>
                    </div> -->
                    <!-- <div class="rechts">
                        <h3>Wachtwoord</h3>
                        <p type="password">dsfds</p>
                        
                    </div> -->
                </div>
                <div class="box">
                    
                </div>
            </div>
        </div>

        <div class="payBox">
            <div class="gegevens">
                <h2>betaal gegevens</h2>
                <img src="img/edit.png" alt="">
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="links">
                        <h3>bankrekeningnummer</h3>
                        <p>000 000 000 000 </p>
                    </div>
                    <div class="rechts">
                        <h3>Bank</h3>
                        <p>Argenta</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="parkBox">
            <div class="gegevens">
                <h2>parkeer gegevens</h2>
            </div>
            <div class="box-container">
                <div class="box">
                    <div class="links">
                        <h3>aantal parkeersessies</h3>
                        <p>000</p>

                        <h3>aantal toegevoegde locaties</h3>
                            <p><?php echo $gegevens['locations_count'] ?></p>

                    </div>
                    <div class="rechts">
                        <h3>totale tijd</h3>
                        <p>00u 00m 00s</p>
                    </div>

                </div>

            </div>
        </div>

        <div class="setBtn">
            <a class="btn" href="instellingen.php">instellingen</a>
        </div>

        <div class="logBtn">
            <a href="index.html" class="logbtn">Uitloggen</a>
        </div>
    </div>

    <?php include_once('nav.php'); ?>
</body>

</html>
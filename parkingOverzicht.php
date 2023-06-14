<?php

include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");

$user = new User();
$info = $user->getInfo($user_id);
// var_dump($info);



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="logo">
    <div id="logo_zwart"></div>
    </div>
    <a class="back2" href="parking.php"><img src="img/back.png" alt=""></a>
    <div class="options">
        <a href="traveller.php" class="option">traveller</a>
        <a href="parking.php" class="option-active">parker</a>
    </div>
    <div class="title">
        <h1>mijn parking</h1>
    </div>



    <div class="backgroundParking">
        <div class="overzichtBox">
            <h1>Oprit</h1>
            <div  class="imgOverzicht">
                <a href=""><img src="img/edit.png" alt=""></a>

            </div>
            
        </div>
        
        <div class="opritLijn">
            <img src="img/opritLijn.png" alt="">
        </div>
    </div>


    <div class="textBox">
        <div class="boxAdres">
            <h2>adres</h2>
            <p><?php echo $info['location']; ?></p>
        </div>

        <div class="boxNummer">
            <h2>postcode</h2>
            <p><?php echo $info['postcode']; ?></p>

        </div>
    </div>

        <div class="textBox2">

            <div class="">
                <h2>status</h2>
                <p>open, bezet, gereserveerd</p>
            </div>
    
            <div class="boxNummer2">
                <h2>prijs</h2>
                <p><?php echo $info['prijs']; ?></p>
    
            </div>
        </div>

        <div class="btnOverzicht">
            <a href="">gereserveerde parkeersessies bekijken</a>
            
        </div>

       <div class="btnOverzicht2">
            <a href="">oprit nu beschikbaar maken</a>
            
        </div> 

        <div class="remove">
            <a href="removeOprit.php" >parkeerplaats weghalen</a>
        </div>

        <?php include 'nav.php'; ?>

</body>
</html>
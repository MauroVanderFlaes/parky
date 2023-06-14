<?php

include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Parky - Parking</title>
</head>

<body>

    <div class="logo">
        <div id="logo_zwart"></div>
    </div>
    <a class="back2" href="traveller_filled.php"><img src="img/back.png" alt=""></a>
    <div class="options">
        <a href="traveller.php" class="option-active">traveller</a>
        <a href="parking.php" class="option">parker</a>
    </div>

    <div class="archief">
            <h1>archief</h1>
        </div>

    <div class="plaats">
        <div class="sessie">
            <div class="sessie-content">
                <img src="img/parkeersessie_gestart.png" alt="" style="width: 90%; padding: 10% 0%">
            </div>
            <div class="info">
                <p>douaneplein, mechelen</p>
                <p>duur: 02:00</p>
            </div>

        </div>
        <div class="sessie">
            <div class="sessie-content">
            <img src="img/parkeersessie_gestart.png" alt="" style="width: 90%; padding: 10% 0%; transform: rotate(180deg);">
            </div>
            <div class="info">
                <p>oprit, antwerpen</p>
                <p>duur: 02:00</p>
            </div>

        </div>
        <div class="sessie-end">
            <div class="sessie-content">
            <img src="img/parkeersessie_gestart.png" alt="" style="width: 90%; padding: 10% 0%;">
            </div>
            <div class="info">
                <p>oprit, antwerpen</p>
                <p>duur: 02:00</p>
            </div>

        </div>

    </div>




    <?php include_once('nav.php'); ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
<?php 

include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");


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
<div class="logo">
    <div id="logo_zwart"></div>
    </div>
    <a class="back2" href="parking.php"><img src="img/back.png" alt=""></a>
    <div class="options">
        <a href="traveller.php" class="option">traveller</a>
        <a href="parking.php" class="option-active">parker</a>
    </div>
    <div class="title">
        <h1>parking toevoegen</h1>
    </div>
    <div class="oprit2">
        <img src="img/bedrijfsparking.png" alt="foto">
        <h1>bedrijfsparking</h1>
        <p>Ben je een onderneming dat momenteel de parking niet gebruikt, dan is de bedrijfsparking voor u de beste optie. Hier stel je de bedrijfsparking beschikbaar voor meerdere travellers. </p>
    </div>
    <div class="menu">
        <a href="spotChoose.php"><img src="img/arrowL.png" alt="l"></a>
        <div class="active"><a href=""></a></div>
        <div class="inactive"><a href=""></a></div>
        
    </div>
    
    <!-- <div class="boxBtn">
        <a class="btn" href="">bedrijfsparking kiezen</a>
        
    </div> -->

    <div class="boxBtnChoose">
        <a class="btn" href="bedrijfsparkingInfo.php">bedrijfsparking kiezen</a>
        
    </div>


    <?php include 'nav.php'; ?>

</body>
<script src="script.js"></script>

</html>
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
    <div class="oprit">
        <img src="img/parkingOprit.png" alt="foto">
        <h1>oprit</h1>
        <p>Je eigen oprit beschikbaar stellen voor travellers.</p>
    </div>
    <div class="menu">
        
        <div class="active"><a href=""></a></div>
        <div class="inactive"><a href="spotChoose2.php"></a></div>
        <a href="spotChoose2.php"><img src="img/arrowR.png" alt="r"></a>
    </div>
    
    <div class="boxBtnChoose">
        <a class="btn" href="opritInfo.php">oprit kiezen</a>
        
    </div>


    <?php include 'nav.php'; ?>

</body>
<script src="script.js"></script>

</html>
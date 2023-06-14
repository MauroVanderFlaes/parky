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
    <div class="options">
        <a href="traveller.php" class="option-active">traveller</a>
        <a href="parking.php" class="option">parker</a>
    </div>

    <div class="plaats">
    <div class="sessie">
        <h1>actieve parkeersessie</h1>
        <div class="sessie-content">
            <a href="index.php" class="add-spot">&plus;</a>
            <h2 class="noposts">je hebt nog geen actieve parkeersessie</h2>
        </div>

    </div>
    <div class="sessie">
        <h1>actieve reservatie</h1>
        <div class="sessie-content">
            <a href="index.php" class="add-spot">&plus;</a>
            <h2 class="noposts">je hebt nog geen actieve reservatie</h2>
        </div>

    </div>
    <div class="sessie-end">
        <h1>archief</h1>
        <div class="sessie-content">
            <a href="archief_empty.php" class="add-spot">&plus;</a>
            <h2 class="noposts">je hebt nog niet geparkeerd. Er is geen archief</h2>
        </div>

    </div>
    <a href="traveller_filled.php">traveller filled</a>
    </div>

    


    <?php include_once('nav.php'); ?>
    <!-- <script src="script.js"></script> -->
</body>

</html>
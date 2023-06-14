<?php 


include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");

$user = new User();
$getLocation = $user->getLocationInfo();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <a class="back2" href="index.php"><img src="img/back.png" alt=""></a>

        <?php foreach($getLocation as $location): ?>
        <div>
            <?php echo $location['location']; ?>
            <h1><?php $location['location']; ?></h1>
        </div>
        <?php endforeach; ?>

        <div class="pictures">
            <img src="img/parking1.png" alt="">
        </div>


    </div>
</body>
</html>
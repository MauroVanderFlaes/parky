<?php


include_once(__DIR__ . "/bootstrap.php");
include_once(__DIR__ . "/LoginCheck.php");

if (!empty($_POST)) {

    $user = new User();
    $location = $_POST['location'];
    $postcode = $_POST['locationCode'];
    $city = $_POST['city'];
    $user_Id = $_SESSION['user_id'];

    //geocoding using nominatim
    $address = $location . " " . $postcode . " " . $city;
    $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&addressdetails=1&limit=1&polygon_svg=1";

    $options = [
        'http' => [
            'header' => 'User-Agent: PHP'
        ]
    ];


    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    if (!empty($response)) {
        $latitude = round((float) $response[0]['lat'], 6);
        $longitude = round((float) $response[0]['lon'], 6);

        $user->setLocation($user_Id, $location, $postcode, $city, $latitude, $longitude);
    } else {
        echo "adress doesnt exist";
    }
}

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
        <h1>oprit informatie</h1>
    </div>
    <div class="oprit3">
        <img src="img/parkingOprit.png" alt="foto">

    </div>

    <div class="boxInfo">
        <form action="" method="post">
            <div class="adres">
                <p>Straat en nummer</p>
                <input type="text" name="location" id="adres" placeholder="straat, nummer">
                <p>Postcode</p>
                <input type="text" name="locationCode" id="adres" placeholder="postcode">
                <p>City</p>
                <input type="text" name="city" id="adres" placeholder="city">
            </div>
            <div class="boxBtn">
                <!-- <a class="btn" id="addOprit" href="opritInfo.php">oprit toevoegen</a> -->
                <input class="btn" type="submit" value="oprit toevoegen">
            </div>
        </form>
    </div>









    <?php include 'nav.php'; ?>

</body>
<script src="script.js"></script>

</html>
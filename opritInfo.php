<?php

include_once(__DIR__ . "/bootstrap.php");


if(!empty($_POST)) {

    $user = new User();
    $location = $_POST['location'];
    $postcode = $_POST['locationCode'];
    $city = $_POST['city'];
    $user_Id = $_SESSION['user_id'];

    //geocoding using nominatim
    $address = $location . " " . $postcode . " " . $city;
    $url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&addressdetails=1&limit=1&polygon_svg=1";

    $options =[
        'http'=>[
            'header'=>'User-Agent: PHP'
        ]
        ];
    

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    if(!empty($response)){
        $latitude = round((float) $response[0]['lat'], 6);
        $longitude = round((float) $response[0]['lon'], 6);

        $user->setLocation($user_Id, $location, $postcode, $city, $latitude, $longitude);
    } else {
        echo "adress doesnt exist";
    }


}

// $user->getCoordinates();


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
    <div id="logo_zwart"></div>
    <a class="back2" href="spotChoose.php"><img src="img/back.png" alt=""></a>
    <div class="options">
        <a href="">traveller</a>
        <a href="">parker</a>
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


<!-- <script>
    document.querySelector('#addOprit').addEventListener('click', function(e) {
        e.preventDefault();
        // Get the address from the form
        var address = document.querySelector('#adres').value;
        
        // Make a request to the geocoding service (Mapbox API in this example)
        fetch('https://api.mapbox.com/geocoding/v5/mapbox.places/' + encodeURIComponent(address) + '.json?access_token=pk.eyJ1IjoicjA4NzgxODIiLCJhIjoiY2xoNTdjd3d1MDZwbTNsbXlvM21kcHRzcSJ9.MlMqlEGm5dnjyqSUqMlbfw')
        .then(response => response.json())
        .then(data => {
        // Extract the coordinates from the response
        var coordinates = data.features[0].center;

        // Create a marker with the obtained coordinates
        var marker = L.marker(coordinates, { icon: markerIcon }).addTo(map);
        marker.bindPopup("<h1>" + address + "</h1><br><a>Reserveer nu</a>");

        // Pan the map to the marker's location
        map.panTo(coordinates);
        })
        .catch(error => {
        console.error('Error geocoding address:', error);
        });


    });
</script> -->

</html>
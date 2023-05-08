<?php 




?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parky</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <link rel="stylesheet" href="https://stamen-tiles.a.ssl.fastly.net/toner-lite/toner-lite.css">
</head>
<body>
    <div id="map"></div>
    <a id="filter" href=""></a>
    <a class="search"></a>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button type="submit">Go</button>
      </div>
    <div id="logo"></div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.AnimatedMarker/2.1.0/AnimatedMarker.js"></script>
    <script src="script.js"></script>

    <?php include 'nav.php';?>
    
</body>
</html>
    
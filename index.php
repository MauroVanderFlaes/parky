<?php

include_once(__DIR__ . "/bootstrap.php");
// load logincheck
include_once(__DIR__ . "/LoginCheck.php");


$user = new User();



//foute manier
// $getLocation = User::getCoordinates();

//juiste manier
$getLocation = $user->getLocationInfo();




// var_dump($getLocation);
// var_dump($latitude);
// var_dump($longitude);


// $info = $user->getLocationInfo();
// var_dump($info);





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parky</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <link rel="stylesheet" href="https://stamen-tiles.a.ssl.fastly.net/toner-lite/toner-lite.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div id="normalNav">

    <div id="logo"><img src="img/logo.png" alt=""></div>

    <div id="boxSearch">
      <a href=""><img src="img/search.png" alt=""></a>
    </div>

    <div id="boxFilter">
      <a href=""><img src="img/filterNieuw.png" alt=""></a>
    </div>

    <div id="centerIcon">
      <a href=""><img src="img/centerIcon.png" alt=""></a>
    </div>

    <div class="feedback">
      <div class="feedbackFilter">

        <div id="noSteps">
          <h2>Selecteer een parkeerplaats</h2>
        </div>

        <div id="filterNav">
          <div class="firstDivFilter">
            <a href="">reset</a>
            <h2>filters</h2>
            <a id="doneStyle" href="">done</a>

          </div>
          <div class="secondDivFilter">
            <p>oprit</p>
            <p>bedrijfsparking</p>
          </div>
          <div class="priceDiv">
            <p>price:</p>
          </div>

          <div class="thirdDivFilter">
            <div class="range">
              <div class="sliderValue">
                <span>5</span>
              </div>
              <div class="field">
                <div class="value left">€0</div>
                <input type="range" min="0" max="10" value="5" steps="1">
                <div class="value right">€10</div>
              </div>
            </div>

          </div>

          <div class="greenBtn">
            <a href="">pas filter(s) toe</a>
          </div>
        </div>
      </div>


      <div class="parking">
        <div class="balk"><img src="img/balk.png" alt=""></div>
        <div class="boxImgParking">
          <img src="img/parking1.png" alt="">
        </div>
        <p class="adresParking">adress straat</p>
        <div class="boxBtnParking">
          <a href="parkeersesssieStart.php">parkeersessie nu starten</a>
        </div>

        <div class="boxBtnParking2">
          <a href="">reserveren</a>
        </div>

      </div>




    </div>
  </div>




  <div id="searchNav">

    <div id="logoSearch"><img src="img/logo.png" alt=""></div>


    <div>
      <form id="searchInputBox" method="get">
        <input class="searchInput" type="text" name="search_query">
      </form>
    </div>

    <div id="boxSearch-bar">
      <a href=""><img src="img/search.png" alt=""></a>
    </div>


    <div id="closeSearch-bar">
      <a href=""><img src="img/kruisje.png" alt=""></a>
    </div>

    <div class="feedback">
      <div id="noSteps">
        <h2>Selecteer een parkeerplaats</h2>
      </div>

      <div id="filter">
        <a href="">reset</a>
        <h2>filters</h2>
        <a id="doneStyle" href="">done</a>
      </div>
    </div>


  </div>



  <div id="map"></div>


  <?php include_once('nav.php'); ?>

  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.AnimatedMarker/2.1.0/AnimatedMarker.js"></script>
  <script src="script.js"></script>

  <script>
    //map setup: coordinates and zoom level 
    let map = L.map('map').setView([51.0270892, 4.480158], 15);
    // get the zoom control
    const zoomControl = map.zoomControl;

    // remove the zoom control from the map
    map.removeControl(zoomControl);

    L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v10/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      maxZoom: 20,
      minZoom: 9,
      id: 'mapbox.dark',
      accessToken: 'pk.eyJ1IjoicjA4NzgxODIiLCJhIjoiY2xoNTdjd3d1MDZwbTNsbXlvM21kcHRzcSJ9.MlMqlEGm5dnjyqSUqMlbfw'
    }).addTo(map);

    //logo
    var logo = document.getElementById('logo');

    //car icon on the map
    var icon = document.getElementById('icon');


    //marker setup
    var markerIcon = new L.Icon({
      iconUrl: './img/marker.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });



    //make foreach loop to get all the coordinates from the database and make a marker for each coordinate
    <?php foreach ($getLocation as $location) : ?>
  var marker = L.marker([<?php echo $location['latitude']; ?>, <?php echo $location['longitude']; ?>], {
    icon: markerIcon
  }).addTo(map);

  marker.addEventListener('click', function(){
    // Get the info from the database based on the clicked marker
    var locationData = <?php echo json_encode($location); ?>;
    var address = locationData['location']; // Update this with the correct field name from your database

    // Update the HTML with the retrieved data
    document.querySelector(".adresParking").innerHTML = address;

    document.querySelector(".feedback").style.bottom = "80px";
    document.querySelector(".feedback").style.height = "400px";
    document.querySelector("#filterNav").style.display = "flex";
    document.querySelector("#noSteps").style.display = "none";
    document.querySelector("#filter").style.display = "none";
    document.querySelector(".parking").style.display = "block";
    document.querySelector(".feedbackFilter").style.display = "none";


    //on another click on this same marker, the feedback will disappear
    document.querySelector(".balk").addEventListener('click', function(){
      document.querySelector(".feedback").style.bottom = "80px";
      document.querySelector(".feedback").style.height = "80px";
      document.querySelector("#filterNav").style.display = "none";
      document.querySelector("#noSteps").style.display = "block";
      document.querySelector(".parking").style.display = "none";
      document.querySelector(".feedbackFilter").style.display = "block";
    });
    
  });
<?php endforeach; ?>




      // marker.on('click', function(e) {

      //   console.log("test");
      //   document.querySelector(".feedback").style.bottom = "80px";
      //   document.querySelector(".feedback").style.height = "306px";
      //   document.querySelector("#filterNav").style.display = "flex";
      //   document.querySelector("#noSteps").style.display = "none";
      //   document.querySelector("#filter").style.display = "none";
      //   document.querySelector(".parking").style.display = "block";
      //   document.querySelector(".feedbackFilter").style.display = "none";

      //   //on another click on this same marker, the feedback will disappear
      //   marker.on('click', function(e) {
      //     document.querySelector(".feedback").style.bottom = "80px";
      //     document.querySelector(".feedback").style.height = "80px";
      //     document.querySelector("#filterNav").style.display = "none";
      //     document.querySelector("#noSteps").style.display = "block";
      //     document.querySelector(".parking").style.display = "none";
      //     document.querySelector(".feedbackFilter").style.display = "none";
      //   });


      // });
  





    // make evertime the latitute and longitude changes




    // check if the Geolocation API is available
    if ("geolocation" in navigator) {
      // create a new marker with a custom icon for the user's location
      var userIcon = new L.Icon({
        iconUrl: './img/car.png',
        iconSize: [50, 50],
        iconAnchor: [12, 41],
      });

      var userMarker = L.marker([0, 0], {
        icon: userIcon
      }).addTo(map);

      const options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
      };

      // use the Geolocation API to get the user's location and update the marker every 2 seconds
      function updateLocation() {
        navigator.geolocation.getCurrentPosition(
          function(position) {
            // update the marker's position
            userMarker.setLatLng([position.coords.latitude, position.coords.longitude]);

            // center the map on the user's location
            map.panTo([position.coords.latitude, position.coords.longitude]);
          },
          function(error) {
            console.error('Error getting location:', error);
          }, options);
      }

      // check if the user has granted permission to access their location
      navigator.permissions.query({
        name: 'geolocation'
      }).then(function(result) {
        if (result.state === 'granted') {
          // start updating the user's location
          updateLocation();
          setInterval(() => {
            navigator.geolocation.getCurrentPosition(position => {
              const {
                latitude,
                longitude
              } = position.coords;
              userMarker.setLatLng([latitude, longitude]);
            });
          }, 2000);
        } else if (result.state === 'prompt') {
          // display a message to the user asking for permission to access their location
          var message = document.createElement('div');
          message.innerHTML = 'This app needs access to your location to show you nearby parking spots.';
          message.style = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 1em;';
          document.body.appendChild(message);

          // request permission when the user clicks the message
          message.addEventListener('click', function() {
            navigator.geolocation.getCurrentPosition(
              function(position) {
                message.remove();
                updateLocation();
                setInterval(() => {
                  navigator.geolocation.getCurrentPosition(position => {
                    const {
                      latitude,
                      longitude
                    } = position.coords;
                    userMarker.setLatLng([latitude, longitude]);
                  });
                }, 2000);
              },
              function(error) {
                console.error('Error getting location:', error);
              }
            );
          });
        }
      });
    } else {
      console.error('Geolocation API not available');
    }

    document.querySelector("#filterNav").style.display = "none";

    document.querySelector("#boxSearch").addEventListener("click", function(e) {
      e.preventDefault();

      //after click on search icon, the search bar will appear
      document.querySelector("#normalNav").style.display = "none";
      document.querySelector("#searchNav").style.display = "block";

      //after another click on close icon, the search bar will disappear
      document.querySelector("#closeSearch-bar").addEventListener("click", function(e) {
        e.preventDefault();
        document.querySelector("#searchNav").style.display = "none";
        document.querySelector("#normalNav").style.display = "block";
      });


      //after another click on search icon, nothing will happen
      document.querySelector("#boxSearch-bar").addEventListener("click", function(e) {
        e.preventDefault();
      });


    });
    let active = 0;

    document.querySelector("#boxFilter").addEventListener("click", function(e) {
      e.preventDefault();

      if (active == 0) {
        active++;

        // Making the feedback bigger
        document.querySelector(".feedback").style.bottom = "80px";
        document.querySelector(".feedback").style.height = "306px";



        //changing text from feedback
        document.querySelector("#filterNav").style.display = "flex";
        document.querySelector("#noSteps").style.display = "none";
        document.querySelector("#filter").style.display = "none";







      } else if (active == 1) {
        active = 0;

        // When clicking again on filter, making feedback smaller
        document.querySelector(".feedback").style.bottom = "80px";
        document.querySelector(".feedback").style.height = "80px";

        //changing text from feedback
        document.querySelector("#filterNav").style.display = "none";
        document.querySelector("#noSteps").style.display = "block";

      }
    });




    // slider
    let slideValue = document.querySelector(".sliderValue span");
    let inputSlider = document.querySelector(".range input");
    inputSlider.oninput = (() => {
      let value = inputSlider.value;
      slideValue.textContent = value;
      slideValue.style.left = (value * 10) + "%";
      slideValue.classList.add("show");
    });

    inputSlider.onblur = (() => {
      slideValue.classList.remove("show");
    });











    //update live location of user after clicking on center icon
    document.querySelector("#centerIcon").addEventListener("click", function(e) {
      e.preventDefault();
      updateLocation();
    });
  </script>
</body>

</html>
    //map setup: coordinates and zoom level 
    let map = L.map('map').setView([51.0270892, 4.480158], 15);
    // get the zoom control
const zoomControl = map.zoomControl;

// remove the zoom control from the map
map.removeControl(zoomControl);

    L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/dark-v10/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    maxZoom: 20,
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

//markers on the map
let marker = L.marker([51.0255892, 4.492858], {icon: markerIcon}).addTo(map);
marker.bindPopup("<h1>Bedrijfsparking: Douaneplein</h1><br><a>Reserveer nu</a>");

let marker2 = L.marker([51.0270892, 4.480158], {icon: markerIcon}).addTo(map);
marker2.bindPopup("<h1>Oprit: Geitenstraat</h1><br><a>Reserveer nu</a><a>Parkeer nu</a>");

// check if the Geolocation API is available
if ("geolocation" in navigator) {
  // create a new marker with a custom icon for the user's location
  var userIcon = new L.Icon({
    iconUrl: './img/car.png',
    iconSize: [50, 50],
    iconAnchor: [12, 41],
  });

  var userMarker = L.marker([0, 0], { icon: userIcon }).addTo(map);

  const options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

  // use the Geolocation API to get the user's location and update the marker every 2 seconds
  function updateLocation() {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        // update the marker's position
        userMarker.setLatLng([position.coords.latitude, position.coords.longitude]);

        // center the map on the user's location
        map.panTo([position.coords.latitude, position.coords.longitude]);
      },
      function (error) {
        console.error('Error getting location:', error);
      }
    , options);
  }

  // check if the user has granted permission to access their location
  navigator.permissions.query({ name: 'geolocation' }).then(function (result) {
    if (result.state === 'granted') {
      // start updating the user's location
      updateLocation();
      setInterval(() => {
  navigator.geolocation.getCurrentPosition(position => {
    const { latitude, longitude } = position.coords;
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
      message.addEventListener('click', function () {
        navigator.geolocation.getCurrentPosition(
          function (position) {
            message.remove();
            updateLocation();
            setInterval(() => {
  navigator.geolocation.getCurrentPosition(position => {
    const { latitude, longitude } = position.coords;
    userMarker.setLatLng([latitude, longitude]);
  });
}, 2000);
          },
          function (error) {
            console.error('Error getting location:', error);
          }
        );
      });
    }
  });
} else {
  console.error('Geolocation API not available');
}

const searchIcon = document.querySelector('.search');
const searchBar = document.querySelector('.search-bar');

searchIcon.addEventListener('click', function() {
  searchBar.classList.toggle('active');
});
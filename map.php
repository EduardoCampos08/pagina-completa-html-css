<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="media/logo.png" type="image/x-icon">

    <title>Seguimiento en Tiempo Real</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #mapa {
      height: 400px;
    }
  </style>
</head>
<body>
    <header>
    <div class="container">
            <img src="media/logo.png" alt="" class="logo">
            <nav>
                <a href="index.php">Inicio</a>
                
                <a href="#nuestros-programas">Configuracion</a>
            </nav>
        </div>

        <div id="mapa"></div>

       </header>






       <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
       <script>


// Coordenadas aproximadas de Nueva York
var coordenadasNY = [20.528629008651382, -100.81197895565101];

var map = L.map('mapa').setView(coordenadasNY, 12);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Función para obtener y mostrar la ubicación del usuario
function mostrarMiUbicacion() {
  if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(function (position) {
      var latitud = position.coords.latitude;
      var longitud = position.coords.longitude;

      // Crea un marcador en la ubicación del usuario
      var marker = L.marker([latitud, longitud]).addTo(map)
        .bindPopup('¡Estás aquí!').openPopup();

      // Centra el mapa en la ubicación del usuario
      map.setView([latitud, longitud], 15);
    }, function (error) {
      console.error('Error al obtener la ubicación:', error.message);
    });
  } else {
    console.error('La geolocalización no está disponible en este navegador.');
  }
}

// Llama a la función para mostrar la ubicación del usuario
mostrarMiUbicacion();


    // Objeto para almacenar las ubicaciones de los dispositivos
    var devices = {};

    function updateLocation(deviceId, latitude, longitude) {
      if (!(deviceId in devices)) {
        // Si el dispositivo no está en el mapa, agrégalo
        devices[deviceId] = L.marker([latitude, longitude]).addTo(map)
          .bindPopup('Device ID: ' + deviceId);
      } else {
        // Si el dispositivo ya está en el mapa, actualiza su posición
        devices[deviceId].setLatLng([latitude, longitude]);
      }
    }

    // Simulación de actualización de ubicación en tiempo real
    setInterval(function () {
      // Simulación de datos de ubicación para dos dispositivos
      var deviceUser = {
      };
      var device1 = {
        id: 'Device1',
        latitude: 20.528629008651382, 
        longitude: -100.85231938046309
      };

      var device2 = {
        id: 'Device2',
        latitude: 20.54190121158643,
        longitude:  -100.81328787373259
      };

      // Actualiza las ubicaciones en el mapa
      updateLocation(device1.id, device1.latitude, device1.longitude);
      updateLocation(device2.id, device2.latitude, device2.longitude);

    }, 5000); // Actualiza cada 5 segundos (ajusta según tus necesidades)
  </script>
</body>
</html>
<?php
$latitude = 28.6059101;
$longitude = 77.5932821;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Maps</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script>
        function initMap() {
            // Latitude and longitude of the location you want to show
            var latlng = {lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?>};

            // Creating a new map object
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8, // Zoom level for the map
                center: latlng // Centering the map on the given location
            });

            // Creating a marker for the given location
            var marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
        }
    </script>
</head>
<body onload="initMap()">
    <div id="map" style="height: 400px;"></div>
</body>

</html>

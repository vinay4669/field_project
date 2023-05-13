<!DOCTYPE html>
<html>
<head>
    <title>Search Blood Camps</title>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            searchBloodCamps(lat, lng);
            console.log(lat, lng);
        }

        function searchBloodCamps(lat, lng) {
            var xmlhttp = new XMLHttpRequest();
            var url = "search.php?lat=" + lat + "&lng=" + lng;
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("search-results").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <h1>Search Blood Camps</h1>
    <button onclick="getLocation()">Get Location</button>
    <div id="search-results"></div>
</body>
</html>


<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo "selected";
}

?>

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    // console.log("location working")

function showPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    searchBloodCamps(lat, lng);
    // console.log(lat, lng);
}

function searchBloodCamps(lat, lng) {
    var xmlhttp = new XMLHttpRequest();
    var url = "search.php?lat=" + lat + "&lng=" + lng;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("search-results").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
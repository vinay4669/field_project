<?php

$lat = $_GET['lat'];
$lng = $_GET['lng'];
// session_id('location');
session_start();
$_SESSION['lat'] = $lat;
$_SESSION['lng'] = $lng;
// Query the database
// $query = "SELECT * FROM blood_camps WHERE ST_Distance_Sphere(location, POINT($lat, $lng)) > 10000";
// // $result = $db->query($query);

// $result = $db->query($query);

// // Create an array to store the nearby blood camps
// $nearby_camps = array();

// // Loop through each search result
// while ($row = mysqli_fetch_assoc($result)) {
//   $nearby_camps[] = $row;
// }

// // If there are no nearby blood camps, display a message to the user
// if (empty($nearby_camps)) {
//   echo 'No blood camps found within 10 kilometers.';
// } else {
//   // Display a form with a drop-down list of the nearby blood camps
//   echo '<form method="post" action="">';
//   echo '<label for="camp_id">Select a blood camp:</label>';
//   echo '<select name="camp_id" id="camp_id">';
//   foreach ($nearby_camps as $camp) {
//     echo '<option value="' . $camp['id'] . '">' . $camp['name'] . '</option>';
//   }
//   echo '</select>';
//   echo 'AFDafsfgjroeijgn';
//   echo '<input type="submit" value="Select">';
//   echo '</form>';
// }
?>
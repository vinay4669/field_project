<?php

include("conn.php");
session_start();
$user = $_SESSION["user"];
// $user = "vin6819";
$sql = "SELECT * FROM user_data WHERE user = '$user'";
$data = $conn->query($sql)->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>

    <header>
        <div class="heading">LITTLE HELP BLOOD DONATION MANAGEMENT SYSTEM</div> 
    </header>

    <main>
        <div class="sidebar">
            <div class="sidebar-links">
                <button id="profile-button">&#x2022; My Profile</button>
                <button id="donate-button">&#x2022; Donate</button>
                <button id="request-button">&#x2022; Request</button>
                <button id="history-button">&#x2022; My History</button>
                <button id="edit-button">&#x2022; Edit Profile</button>
                <button id="logout-button">&#x2022; Logout</button>
            </div>
        </div>
        <div class="content">   
            <div class="profile" id="profile" style="display:none">
                <div><h1>PROFILE</h1></div>
                <div class="table">
                    <table>
                        <tr><td class="right">Name : </td><td><?php echo $data["name"]; ?></td></tr>
                        <tr><td class="right">E-mail ID : </td><td><?php echo $data["mail"]; ?></td></tr>
                        <tr><td class="right">Phone No. : </td><td><?php echo $data["phone"]; ?></td></tr>
                        <tr><td class="right">City : </td><td><?php echo $data["city"]; ?></td></tr>
                        <tr><td class="right">Blood Group : </td><td><?php echo $data["bg"]; ?></td></tr>
                        <tr><td class="right">Blood Donations done : </td><td><?php echo $data["donate"]; ?></td></tr>
                        <tr><td class="right">Blood Requests done : </td><td><?php echo $data["request"]; ?></td></tr>
                    </table>
                </div>
            </div>
            <div class="donate" id="donate" style="display:none">
                <!-- <h2>You can donate</h2> -->
                <div class="message">Please fill up the necessary details</div>
            </div>
            <div class="request" id="request" style="display:none">
                <h2>Request for blood</h2>
            </div>
            <div class="history" id="history" style="display:none">
                <h2>History of all the donations and requests made</h2>
            </div>
            <div class="edit" id="edit" style="display:none">
                <h2>Edit your profile</h2>
            </div>
            <div class="logout" id="logout" style="display:none">
                <div class="message">Are You Sure?</div>
                <div class="button"><a href="index.php"><button>YES</button></a></div>
            </div>
        </div>
    </main>
    
</body>
<script src="js/dynamic.js"></script>
</html>
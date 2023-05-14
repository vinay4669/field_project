<?php

$servername = "localhost";
$username = "root";
$password = "HR-6819!m";

$conn = new mysqli($servername, $username, $password);

$sql = "SHOW DATABASES LIKE 'blood'";
if($conn->query($sql)->num_rows != 0){
    $conn->select_db('blood');
}
?>
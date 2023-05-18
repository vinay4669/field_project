<?php

$servername = "localhost";
$username = "root";
$password = "HR-6819!m";

$conn = new mysqli($servername, $username, $password);

$sql = "SHOW DATABASES LIKE 'blood'";
if($conn->query($sql)->num_rows != 0){
    $conn->select_db('blood');
}
else{
    $sql = "CREATE DATABASE blood";
    $conn->query($sql);
    $conn->select_db('blood');
    $sql = "CREATE TABLE admin_data(id varchar(255), pass varchar(255))";
    $conn->query($sql);
    $sql = "CREATE TABLE ";
}
?>
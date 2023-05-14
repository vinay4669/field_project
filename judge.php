<?php

include('conn.php');

$type = $_GET['type'];
$res = $_GET['res'];
$dt = $_GET['dt'];

if($type=='donate'){
    $sql = "UPDATE donate SET status=$res WHERE date_time='$dt'";
    $conn->query($sql);
    if($res=='1'){
        $sql = "SELECT user_id, camp_id FROM donate WHERE date_time='$dt'";
        $res = $conn->query($sql)->fetch_all();
        $user_id = $res[0][0];
        $camp_id = $res[0][1];
        $sql = "SELECT bg FROM user_data WHERE user='$user_id'";
        $res = $conn->query($sql)->fetch_all();
        $bg = $res[0][0];
        $sql = "UPDATE user_data SET donate=donate+1 WHERE user='$user_id'";
        $conn->query($sql);
        $sql = "UPDATE blood_data SET $bg=$bg+1 WHERE camp_id='$camp_id'";
        $conn->query($sql);
    }
    header('Location: a_dashboard.php');
    exit();
}
else if($type=='request'){
    $array = explode('|', $dt);
    $dt = $array[0];
    $sql = "UPDATE request SET status=$res WHERE date_time='$dt'";
    $conn->query($sql);
    if($res=='1'){
        $amt = intval($array[1]);
        $sql = "SELECT user_id, camp_id, bg FROM request WHERE date_time='$dt'";
        $res = $conn->query($sql)->fetch_all();
        $user_id = $res[0][0];
        $camp_id = $res[0][1];
        $bg = $res[0][2];
        $sql = "UPDATE user_data SET request=request+$amt WHERE user='$user_id'";
        $conn->query($sql);
        $sql = "UPDATE blood_data SET $bg=$bg-$amt WHERE camp_id='$camp_id'";
        $conn->query($sql);
    }
    header('Location: a_dashboard.php');
    exit();
}


?>
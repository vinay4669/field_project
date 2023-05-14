<?php
include("conn.php");
?>

<!-- donate -->

<?php
$sql = "SELECT user_id FROM donate WHERE status=0";
$users = $conn->query($sql)->fetch_all();
$sql = "SELECT camp_id FROM donate WHERE status=0";
$camps = $conn->query($sql)->fetch_all();
$sql = "SELECT date_time FROM donate WHERE status=0";
$sql = "SELECT DATE_FORMAT(date_time, '%Y-%m-%d %H:%i:%s') FROM donate WHERE status=0";
$dt = $conn->query($sql)->fetch_all();
$d_info = array();
$bg = array('ap'=>'A+', 'an'=>'A-', 'bp'=>'B+', 'bn'=>'B-', 'abp'=>'AB+', 'abn'=>'AB-', 'op'=>'O+', 'one'=>'O-');
$l = count($camps);
for($i = 0;$i<$l;$i++){
    $k = $users[$i];
    $sql = "SELECT name, phone, bg FROM user_data WHERE user='$k[0]'";
    $temp = $conn->query($sql)->fetch_assoc();
    $k = $camps[$i];
    $sql = "SELECT name FROM blood_camps WHERE id='$k[0]'";
    $temp2 = $conn->query($sql)->fetch_assoc();
    $k = $dt[$i][0];
    // $k = '1';
    $d_info[] = array('name'=>$temp['name'], 'phone'=>$temp['phone'], 'bc'=>$temp2['name'], 'bg'=>$bg[$temp['bg']], 'dt'=>"$k");
}
?>

<!-- request -->

<?php
$sql = "SELECT * FROM request WHERE status=0";
$res = $conn->query($sql);
$r_info = array();
while($row = $res->fetch_assoc()){
    $sql = "SELECT name, phone FROM user_data WHERE user='$row[user_id]'";
    $temp = $conn->query($sql)->fetch_assoc();
    $sql = "SELECT name FROM blood_camps WHERE id='$row[camp_id]'";
    $temp2 = $conn->query($sql)->fetch_assoc();
    $r_info[] = array('name'=>$temp['name'], 'phone'=>$temp['phone'], 'bc'=>$temp2['name'], 'bg'=>$bg[$row['bg']], 'dt'=>$row['date_time'], 'amt'=>$row['amt']);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/a_dashboard.css">
</head>
<body>
    
    <header>
        <div class="heading">LITTLE HELP BLOOD DONATION MANAGEMENT SYSTEM (ADMIN)</div> 
    </header>

    <main>
        <div class="sidebar">
            <div class="sidebar-links">
                <button class="sidebar-button" data-content-target="donate">&#x2022; Donation Requests</button>
                <button class="sidebar-button" data-content-target="request">&#x2022; Blood Requests</button>
                <button class="sidebar-button" data-content-target="camps">&#x2022; Blood Camps</button>
                <button class="sidebar-button" data-content-target="add-camps">&#x2022; Add Blood Camps</button>
                <button class="sidebar-button" data-content-target="add-admin">&#x2022; Add Admin</button>
                <button class="sidebar-button" data-content-target="logout">&#x2022; Logout</button>
            </div>
        </div>

        <div class="content">
            <div class="donate content-item" id="donate" style="display: none">
                <table class="donate-table">
                    <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Blood Camp</th>
                        <th>Blood Group</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        $k = 1;
                        foreach($d_info as $i){
                            ?>
                            <tr>
                                <td><?php echo $k; ?></td>
                                <td><?php echo $i['name']; ?></td>
                                <td><?php echo $i['phone']; ?></td>
                                <td><?php echo $i['bc']; ?></td>
                                <td><?php echo $i['bg']; ?></td>
                                <td><button class="judge approve dapp" value="<?php echo $i['dt']; ?>">Approve</button></td>
                                <td><button class="judge reject drej" value="<?php echo $i['dt']; ?>">Reject</button></td>
                            </tr>
                        <?php
                        $k++;    
                    }
                    if(empty($d_info)){
                        echo "<tr><td colspan=7>No pending requests!</td></tr>";
                    }
                    ?>
                </table>
            </div>

            <div class="request content-item" id="request"style="display: none">
            <table class="request-table">
                    <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Blood Camp</th>
                        <th>Blood Group</th>
                        <th>Amount</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        $k = 1;
                        foreach($r_info as $i){
                            ?>
                            <tr>
                                <td><?php echo $k; ?></td>
                                <td><?php echo $i['name']; ?></td>
                                <td><?php echo $i['phone']; ?></td>
                                <td><?php echo $i['bc']; ?></td>
                                <td><?php echo $i['bg']; ?></td>
                                <td><?php echo $i['amt']; ?></td>
                                <td><button class="judge approve rapp" value="<?php echo $i['dt'].'|'.$i['amt']; ?>">Approve</button></td>
                                <td><button class="judge reject rrej" value="<?php echo $i['dt']; ?>">Reject</button></td>
                            </tr>
                        <?php
                        $k++;    
                    }
                    if(empty($r_info)){
                        echo "<tr><td colspan=7>No pending requests!</td></tr>";
                    }
                    ?>
                </table>
            </div>

            <div class="camps content-item" id="camps"style="display: none">
                camps
            </div>

            <div class="add-camps content-item" id="add-camps"style="display: none">
                add-camps
            </div>

            <div class="add-admin content-item" id="add-admin"style="display: none">
                add-admin
            </div>

            <div class="logout content-item" id="logout"style="display: none">
                logout
            </div>
        </div>
    </main>

</body>
<script>
    const dapp = document.querySelectorAll('.dapp')
    const drej = document.querySelectorAll('.drej')
    const rapp = document.querySelectorAll('.rapp')
    const rrej = document.querySelectorAll('.rrej')

    dapp.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=donate&res=1&dt="+a
        })
    })

    drej.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=donate&res=-1&dt="+a
        })
    })

    rapp.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=request&res=1&dt="+a
        })
    })

    rrej.forEach(function(button){
        button.addEventListener('click', ()=>{
            var a = button.value
            window.location.href="judge.php?type=request&res=-1&dt="+a
        })
    })

</script>
<script src="js/dynamic.js"></script>
</html>
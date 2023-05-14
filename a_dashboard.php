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

<!-- camps -->

<?php
$sql = "SELECT name, address, phone, mail FROM blood_camps";
$res = $conn->query($sql);
$c_info = array();
while($row = $res->fetch_assoc()){
    $c_info[] = array('name'=>$row['name'], 'address'=>$row['address'], 'phone'=>$row['phone'], 'mail'=>$row['mail']);
}
?>

<!-- add-camps -->

<?php
if(isset($_POST['submit1'])){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $sql = "INSERT INTO blood_camps(name, address, phone, mail, location) VALUES('$name', '$address', '$phone', '$mail', ST_GeomFromText('POINT($lat $lng)'))";
    $conn->query($sql);
    $sql = "SELECT * FROM blood_camps ORDER BY id DESC LIMIT 1";
    $row = $conn->query($sql)->fetch_assoc();
    $camp_id = $row['id'];
    $sql = "INSERT INTO blood_data(camp_id, ap, an, bp, bn, abp, abn, op, one) VALUES('$camp_id', 0, 0, 0, 0, 0, 0, 0, 0)";
    $conn->query($sql);
    echo "<script>alert('Blood Camp Added')</script>";
}
?>

<!-- add-admin -->

<?php
if(isset($_POST['submit2'])){
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $sql = "INSERT INTO admin_data(id, pass) VALUES('$id', '$pass')";
    $conn->query($sql);
    echo "<script>alert('New Admin profile created')</script>";
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
                <button class="sidebar-button" data-open-modal>&#x2022; Logout</button>
            </div>
        </div>

        <div class="content">
            <div class="donate content-item" id="donate" style="display: none">
                <table class="donate-table">
                    <tr>
                        <th>S.No.</th>
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
                        <th>S.No.</th>
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
                        echo "<tr><td colspan=8>No pending requests!</td></tr>";
                    }
                    ?>
                </table>
            </div>

            <div class="camps content-item" id="camps"style="display: none">
                <table class="camps-table">
                    <tr>
                        <th>S.No.</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>E-Mail</th>
                    </tr>
                    <?php
                        $k = 1;
                        foreach($c_info as $i){
                            ?>
                            <tr>
                                <td><?php echo $k; ?></td>
                                <td><?php echo $i['name']; ?></td>
                                <td><?php echo $i['address']; ?></td>
                                <td><?php echo $i['phone']; ?></td>
                                <td><?php echo $i['mail']; ?></td>
                            </tr>
                        <?php
                        $k++;    
                    }
                    ?>
                </table>
            </div>

            <div class="add-camps content-item" id="add-camps"style="display: none">
                <div class="heading-text">
                    Enter blood camp details
                </div>
                <div class="camp-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address: </label>
                            <input type="text" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone: </label>
                            <input type="text" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="mail">E-Mail: </label>
                            <input type="text" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="lat">Latitude: </label>
                            <input type="text" name="lat" required>
                        </div>
                        <div class="form-group">
                            <label for="lng">Longitude: </label>
                            <input type="text" name="lng" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit1">
                        </div>
                    </form>
                </div>
            </div>

            <div class="add-admin content-item" id="add-admin"style="display: none">
            <div class="heading-text">
                    Create new admin profile
                </div>
                <div class="admin-form">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="id">Admin ID: </label>
                            <input type="text" name="id" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password: </label>
                            <input type="text" name="pass" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit2">
                        </div>
                    </form>
                </div>
            </div>

            <div class="logout content-item" id="logout"style="display: none">

            </div>
        </div>
    </main>

    <dialog data-modal>
        <div class="modal-content">
            <div class="modal-heading">
                ARE YOU SURE?
            </div>
            <div class="buttons">
                <a href="index.php"><button id="yes">YES</button></a>
                <button data-close-modal id="no">NO</button>
            </div>
            
        </div>
    </dialog>

</body>

<script>
    const modal =document.querySelector("[data-modal]")
    const openbutton =document.querySelector("[data-open-modal]")
    const closebutton =document.querySelector("[data-close-modal]")
    
    openbutton.addEventListener('click', ()=>{
        modal.showModal()
    })
    closebutton.addEventListener('click',() =>{
        modal.close()
    })
</script>

<script src="js/a_response.js"></script>
<script src="js/dynamic.js"></script>
</html>
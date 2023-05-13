<?php
include("conn.php");
$user = $_GET["user"];
// echo $user;
$lat = $_GET['lat'];
$lng = $_GET['lng'];
// echo $lat;
$sql = "SELECT * FROM user_data WHERE user = '$user'";
$data = $conn->query($sql)->fetch_assoc();

if(isset($_POST["submit1"])){
    // echo $_POST['blood_camp'];
    $camp_id = $_POST['blood_camp'];
    $sql = "INSERT INTO donate(user_id, camp_id, date_time, status) VALUES('$user', '$camp_id', NOW(), 0)";
    $result = $conn->query($sql);
    if($result){
        echo "<script>alert('Your response has been recorded. We thank you for your generosity!')</script>";
    }
}

if(isset($_POST["submit2"])){
    $bg = $_POST['bg'];
    $amt = $_POST['amt'];
    $sql = "SELECT camp_id FROM blood_data WHERE $bg>=$amt";
    $res = ($conn->query($sql)->fetch_all());
    $camps_avail = array();
    foreach($res as $i){
        $camps_avail[] = $i[0];
    }
    $sql = "SELECT id, ST_Distance_Sphere(location, POINT($lat, $lng)) as distance FROM blood_camps";
    $res = $conn->query($sql);
    $distances = array();
    while($row = $res->fetch_assoc()){
        if(in_array($row['id'], $camps_avail)){
            $distances[] = array('id'=>$row['id'], 'distance'=>$row['distance']);
        }
    }
    usort($distances, function($a, $b) {
        return $a['distance'] - $b['distance'];
    });
    $camps2 = array();
    $id;
    foreach($distances as $i){
        $id = $i['id'];
        $sql = "SELECT * FROM blood_camps WHERE id=$id";
        $camps2[] = $conn->query($sql)->fetch_assoc();
        break;
    }
    $sql = "INSERT INTO request(user_id, camp_id, bg, amt, date_time, status) VALUES('$user', '$id', '$bg', $amt, NOW(), 0)";
    $conn->query($sql);
    ?>
        <dialog data-modal>
            <div class="modal-content">
                <?php 
                if(!empty($camps2)){ ?>
                <div class="modal-heading">
                    Nearest blood camp which can fulfill your requirements: 
                </div>
                <div class="camps-table">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>E-mail</th>
                        </tr>
                        <?php
                            foreach($camps2 as $camp){
                                echo "<tr><td>".$camp['name']."</td><td>".$camp['address']."</td><td>".$camp['phone']."</td><td>".$camp['mail']."</td></tr>";
                            }
                        ?>
                    </table>
                </div>
                <?php 
                }
                else{
                    ?>
                    <div class="modal-heading">
                        We are really sorry as blood is not available in our blood banks.
                    </div>
                    <?php 
                }
                    ?>
            </div>
            <button data-close-modal>Confirm</button>
        </dialog>

        <script>
            // console.log("in script")
            const closebutton =document.querySelector("[data-close-modal]")
            const modal =document.querySelector("[data-modal]")
            modal.showModal()
            closebutton.addEventListener("click", ()=>{
                modal.close()
            })
        </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
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
                <button class="sidebar-button" data-content-target="profile">&#x2022; My Profile</button>
                <button class="sidebar-button" data-content-target="donate">&#x2022; Donate</button>
                <button class="sidebar-button" data-content-target="request">&#x2022; Request</button>
                <button class="sidebar-button" data-content-target="history">&#x2022; My History</button>
                <button class="sidebar-button" data-content-target="edit">&#x2022; Edit Profile</button>
                <button class="sidebar-button" data-content-target="logout">&#x2022; Logout</button>
            </div>
        </div>


        <div class="content">   
            <div class="profile content-item" id="profile" style="display:none">
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


            <div class="donate content-item" id="donate" style="display:none">
                <!-- <h2>You can donate</h2> -->
                <!-- <button name="location" onclick="getLocation()">Search Blood Camps</button> -->
                <div>
                    <h1>Please select one of the following blood camps :</h1>
                </div>
                <div class="donate-form-section">
                <?php
                    $sql = "SELECT * FROM blood_camps WHERE ST_Distance_Sphere(location, POINT($lat, $lng)) < 10000";
                    $result = $conn->query($sql);
                    $camps = array();
                    while($row = mysqli_fetch_assoc(($result))){
                        $camps[] = $row;
                    }
                    if(empty($camps)){
                         echo "No blood camps found near you!";
                    }
                    else{
                        ?>
                        <form action="dashboard.php?user=<?php echo $user;?>&lat=<?php echo $lat ?>&lng=<?php echo $lng ?>" method="post" class="donate-form">
                            <?php foreach($camps as $camp){ ?>
                                <input type="radio" name="blood_camp" value="<?php echo $camp['id'] ?>" required>
                                <?php echo $camp['name'].'  -  '.$camp['address'].'  -  '.$camp['phone'].'  -  '.$camp['mail'].'<br>'; ?>
                            <?php } ?><br><br>
                            <input type="submit" name="submit1" class="submit">
                        </form>
                        <?php
                    }
                ?>
                </div>
            </div>


            <div class="request content-item" id="request" style="display:none">
                <div class="heading-text">
                    Request for blood form
                </div>
                <div class="request-form-section">
                    <form action="dashboard.php?user=<?php echo $user;?>&lat=<?php echo $lat ?>&lng=<?php echo $lng ?>" method="post" class="request-form">
                        <div class="blood-type-input">
                        <h2>Blood type required : </h2>
                        <select name="bg" id="bg" required>
                            <option value="ap">A+</option>
                            <option value="an">A-</option>
                            <option value="bp">B+</option>
                            <option value="bn">B-</option>
                            <option value="abp">AB+</option>
                            <option value="abn">AB-</option>
                            <option value="op">O+</option>
                            <option value="one">O-</option>
                        </select>
                        </div>
                        <div class="blood-amt-input">
                            <h2>Amount of blood required (in pints) : </h2>
                            <input type="number" name="amt" id="amt" required>
                        </div>
                        <input type="submit" name="submit2" class="submit">
                    </form>
                </div>
            </div>


            <div class="history content-item" id="history" style="display:none">
                <h2>History of all the donations and requests made</h2>
            </div>


            <div class="edit content-item" id="edit" style="display:none">
                <h2>Edit your profile</h2>
            </div>

            
            <div class="logout content-item" id="logout" style="display:none">
                <div class="message">Are You Sure?</div>
                <div class="button"><a href="index.php"><button>YES</button></a></div>
            </div>
        </div>
    </main>
    
</body>
<script src="js/dynamic.js"></script>
</html>
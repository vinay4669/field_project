<?php
include("header.php");
include("conn.php");
if(isset($_POST["user"])){
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $bg = $_POST["bg"];
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $user = $_POST["user"];
    $b = TRUE;
    $sql = "SELECT user FROM user_data";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($user==$row["user"]){
                echo "<script>
            if(confirm('$user is already taken. Please choose another username')) {
              window.location.href = 'register.php';
            }
          </script>";
          $b = FALSE;
            }
        }
    }
    
    $sql = "INSERT INTO user_data(name, mail, phone, city, bg, user, pass, donate, request) VALUES('$name', '$mail', '$phone', '$city', '$bg', '$user', '$pass', 0, 0)";
    if($b && $conn->query($sql)===TRUE){
        session_start();
        $_SESSION["user"] = $user;
        echo "<script>
        if(confirm('Congrats! You are registered. Press OK to continue.')) {
          window.location.href = 'dashboard.php';
        }
      </script>";     
    }
}

?>

<style>
    .footer{
        height: 100px;
    }
</style>

<body style="
background-image: url('../images/bguc.png');
        background-repeat: repeat;
        background-size: cover;
">
    

<main class="register width">
        <div class="heading">
            START SAVING LIVES
        </div>
        <div >
            <form method="post" class="form">
                <div class="name-input">
                    <div class="name-label">Name</div>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="mail-input">
                    <div class="mail-label">E-mail</div>
                    <input type="email" name="mail" id="mail" required>
                </div>
                <div class="phone-input">
                    <div class="phone-label">Phone</div>
                    <input type="number" name="phone" id="phone" required>
                </div>
                <div class="city-input">
                    <div class="city-label">City</div>
                    <input type="text" name="city" id="city" required>
                </div>
                <div class="blood-group-input">
                    <div class="blood-group-label">Blood Group</div>
                    <select name="bg" id="bg" required>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
                <div class="user-input">
                    <div class="user-label">User Name</div>
                    <input type="text" name="user" id="user" required>
                </div>
                <div class="pass-input">
                    <div class="pass-label">Password</div>
                    <input type="password" name="pass" id="pass" required>
                </div>
                <div class="submit-button">
                    <input type="submit" class="submit">
                </div>
            </form>
        </div>
    </main>
    <footer class="footer">

    </footer>

    </body>
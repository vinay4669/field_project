<script src="js/location.js"></script>

<?php
include("header.php");
include("conn.php");
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $sql = "SELECT id, pass FROM admin_data";
    $result = $conn->query($sql);
    $b = TRUE;
    while($row = $result->fetch_assoc()){
        if($row["id"] == $user){
            if($row["pass"] == $pass){
                header("Location: a_dashboard.php");
            }
            else{
                echo "<script>
            if(confirm('Wrong Password. Please try again.')) {
              window.location.href = 'a_login.php';
            }
          </script>";
            }
            $b = FALSE;
        }
    }
    if($b){
        echo "<script>
            if(confirm('$user username does not exists. Please try again.')) {
              window.location.href = 'a_login.php';
            }
          </script>";
    }
}

?>
<link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/login.css">
<body style="
background-image: url('../images/bguc.png');
        background-repeat: repeat;
        background-size: cover;
">
    

    <main class="register">
        <div class="heading">
            Enter your login credentials (ADMIN)
        </div>
        <div >
            <form method="post" class="form login-form">
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
    </body>
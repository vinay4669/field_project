<?php
include("header.php");
include("conn.php");
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $sql = "SELECT user, pass FROM user_data";
    $result = $conn->query($sql);
    $b = TRUE;
    while($row = $result->fetch_assoc()){
        if($row["user"] == $user){
            if($row["pass"] == $pass){
                session_start();
                $_SESSION["user"] = $user;
                header("Location: dashboard.php");
            }
            else{
                echo "<script>
            if(confirm('Wrong Password. Please try again.')) {
              window.location.href = 'login.php';
            }
          </script>";
            }
            $b = FALSE;
        }
    }
    if($b){
        echo "<script>
            if(confirm('$user username does not exists. Please try again.')) {
              window.location.href = 'login.php';
            }
          </script>";
    }
}

?>

<body style="
background-image: url('../images/bguc.png');
        background-repeat: repeat;
        background-size: cover;
">
    

    <main class="register">
        <div class="heading">
            Enter your login credentials
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
<?php

include("header.php");
include("conn.php");
$sql = "SELECT name, bg from user_data";
$res = $conn->query($sql)->fetch_all();
$bg = array('ap'=>'A+', 'an'=>'A-', 'bp'=>'B+', 'bn'=>'B-', 'abp'=>'AB+', 'abn'=>'AB-', 'op'=>'O+', 'one'=>'O-');

?>

<main class="mvps">
    <div class="heading">Our SuperHeroes - Blood Donors</div>
    <div class="content">
        <table class="mvps-table">
            <tr>
                <th>Name</th>
                <th>Blood Group</th>
            </tr>
            <?php
                foreach($res as $i){
                    ?>
                    <tr>
                        <td><?php echo $i[0]; ?></td>
                        <td><?php echo $bg[$i[1]]; ?></td>
                    </tr>
                <?php   
            }
            ?>
        </table>
    </div>
</main>

<footer class="footer">
    <div class="heading">
        JOIN OUR CAUSE
    </div>
    <div class="content">
        Donating blood or platelets can be intimidating and even scary. 
        Time to put those hesitations and fears aside. Learn from Little Blood  
        how simple and easy it is to roll up a sleeve and help save lives.
    </div>
    <!-- <div class="links">

    </div> -->
    <div class="foot">
        2023 &copy; All rights reserved.
    </div>
    
</footer>
<?php
//include config file
require_once "config.php";

//Get the session stored data
$user_id = $_SESSION['user_id'];
$sql="select * from users where user_id='$user_id'";
$results=mysqli_query($link,$sql);
$alldata=mysqli_fetch_assoc($results);

?>
<div class="container">
    <div class="jumbotron jumbotron-fluid m-0" style="background-color: darkseagreen">
        <div class="container">
            <h1 class=" display-3 english text-white text-center">Welcome <?php echo $alldata['username']; ?></h1>
        </div>
    </div>
</div>
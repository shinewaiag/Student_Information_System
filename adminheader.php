<?php
//Include config file
require_once "config.php";

//Get the session data
$admin_id = $_SESSION['admin_id'];

//To retrieve the admin name
$sql="select username from admin where admin_id='$admin_id'";
$results=mysqli_query($link,$sql);
$alldata=mysqli_fetch_assoc($results);

?>


<div class="container">
    <header class="jumbotron jumbotron-fluid m-0" style="background-color: darkseagreen">
        <h1 class="english text-center display-3 text-white">Welcome <?php echo $alldata['username']; ?></h1>
    </header>
</div>



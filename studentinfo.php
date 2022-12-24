<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}
//Include config file and navadmin file
require_once "config.php";
include_once "navadmin.php";
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<?php
//Check if data exists
if(isset($_GET['user_id'])){

    //Get the data to variable
    $user_id=$_GET['user_id'];
    $query="select * from student where user_id='$user_id'";
    $ans=mysqli_query($link,$query);
    $data=mysqli_fetch_assoc($ans);
?>
<div class="container">
    <div class="jumbotron-fluid m-0" style="background-color: lightskyblue">
        <h4 class="text-center">Info Details</h4>
        <table class="table table-primary">
    <thead>
    <tr> <?php
        $image=$data['image'];
        $image_src="upload/".$image;
        ?>
        <th></th>
        <th><img src='<?php echo $image_src;  ?>'  width="200px" height="200px" ></th>
    </tr>
    <tr>
        <th>Name</th>
        <th><?php echo $data['stdname']; ?></th>
    </tr>
    <tr>
        <th>Gender</th>
        <th><?php echo $data['gender']; ?></th>
    </tr>
    <tr>
        <th>Mail</th>
        <th><?php echo $data['mail']; ?></th>
    </tr>
    <tr>
        <th>NRC</th>
        <th><?php echo $data['nrc']; ?></th>
    </tr>
    <tr>
        <th>Phone</th>
        <th><?php echo $data['phone']; ?></th>
    </tr>
    <tr>
        <th>Address</th>
        <th><?php echo $data['address']; ?></th>
    </tr>
    </thead>
</table>
        <?php } ?>
        <input type="button" value="Go back" class="btn btn-primary float-right" onclick="history.back()">
    </div>
</div>
<?php
//Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//Get the stored session data
$user_id=$_SESSION['user_id'];
?>
<?php
//Include config and nav file
require_once "config.php";
include_once "nav.php";

?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark m-0">
        <?php
        $sql="select * from student where user_id='$user_id'";
        $results=mysqli_query($link,$sql);
        $count=mysqli_num_rows($results);
        if($count==1){ ?>
            <a href="addinfo.php" class="btn btn-lg disabled  english btn-outline-info mx-2" role="button" aria-pressed="true">Add Info</a>
       <?php }else{ ?>
            <a href="addinfo.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">Add Info</a>
       <?php }
       ?>
        <a href="viewinfo.php" class="btn btn-lg english btn-outline-info" role="button" aria-pressed="true">View Info</a>
        <div class="container">
            <h4 class="display-5 text-center text-white">My Information</h4>
            <table class="table table-dark">
                <thead>
                <?php
                $query = "SELECT * FROM student where user_id='$user_id'";
                $result = mysqli_query ($link, $query);
                $user_id = 0;
                while ($alldata = mysqli_fetch_assoc($result)) {
                $user_id++;
                ?>
                <tr>
                    <?php
                    $image=$alldata['image'];
                    $image_src="upload/".$image;
                    ?><th></th>
                    <th><img src='<?php echo $image_src;  ?>'  width="200px" height="200px"></th>
                </tr>
                <tr>
                    <th scope="col">Name</th>
                    <th><?php echo $alldata['stdname']; ?></th>
                </tr>
                <tr>
                    <th scope="col">Gender</th>
                    <th><?php echo $alldata['gender']; ?></th>
                </tr>
                <tr>
                    <th scope="col">Mail</th>
                    <th><?php echo $alldata['mail']; ?></th>
                </tr>
                 <tr>
                     <th scope="col">NRC</th>
                     <th><?php echo $alldata['nrc']; ?></th>
                 </tr>
                <tr>
                    <th scope="col">Phone</th>
                    <th><?php echo $alldata['phone']; ?></th>
                </tr>
                <tr>
                    <th scope="col">Address</th>
                    <th><?php echo $alldata['address']; ?></th>
                </tr>
                </thead>
            </table>
                <a class="btn btn-warning bdex float-right" href="updateinfo.php?user_id=<?php echo $alldata['user_id']; ?>">Edit</a>
                <?php } ?>
        </div>
    </div>
</div>
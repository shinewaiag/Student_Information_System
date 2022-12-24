<?php
//Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//Get the session stored data
$user_id=$_SESSION['user_id'];
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<?php
//include config file and nav file
require_once "config.php";
include_once "nav.php";
?>
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark m-0">
        <a href="mycourse.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">View Lists</a>
        <a href="confirmedliststudent.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">Confirmed Lists</a>
        <div class="container">
            <h4 class="text-center text-white">My Course Lists</h4>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Description</th>
                    <th scope="col">Enrolled date</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $query = "SELECT course_name,course_desc,enroll_date,course_id FROM course_student where user_id='$user_id' and status=0";
                $result = mysqli_query ($link, $query);
                $user_id = 0;
                while ($alldata = mysqli_fetch_assoc($result)) {
                    $user_id++;
                ?>
                <tr>
                    <td><?php echo $alldata['course_name'] ?></td>
                    <td><?php echo $alldata['course_desc'] ?></td>
                    <td><?php echo $alldata['enroll_date'] ?></td>
                        <td><a href="declinecourse.php?course_id=<?php echo $alldata['course_id'];?>" onclick="return confirm('Are you sure to decline course?');" class="btn english btn-outline-danger" role="button" aria-pressed="true">Decline</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
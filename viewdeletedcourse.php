<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}

//Include config and navadmin file
require_once "config.php";
include_once "navadmin.php";
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark m-0">
        <a href="addcourse.php" class="btn btn-lg  english btn-outline-info mx-2 bdex1" role="button" aria-pressed="true">Add Course</a>
        <a href="viewcourse.php" class="btn btn-lg english btn-outline-info bdex1" role="button" aria-pressed="true">View Course</a>
        <a href="viewdeletedcourse.php" class="btn btn-lg english btn-outline-info bdex1 float-right mx-2" role="button" aria-pressed="true">Deleted Course</a>
        <div class="container">
            <h4 class="display-5 text-center text-white">Deleted Course Lists</h4>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">Course_ID</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT * FROM course where status=0 order by course_name";
                $result = mysqli_query ($link, $query);
                $course_id = 0;
                while ($alldata = mysqli_fetch_assoc($result)) {
                $course_id++;
                ?>

                <tr>
                    <th scope="row"><?php echo $course_id; ?></th>
                    <td><?php echo $alldata['course_name']; ?></td>
                    <td><?php echo $alldata['course_desc']; ?></td>
                    <?php

                    $cid=$alldata['course_id'];

                    ?>
                    <td>
                        <a href="apply.php?course_id=<?php echo $cid?>" class="btn btn-outline-warning bdex my-3" role="button" aria-pressed="true">Apply</a>
                        <a class="btn btn-outline-success bdex" href="details.php?course_id=<?php echo $alldata['course_id']; ?>">Details</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

//Include config file and navadmin file
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
                <h4 class="display-5 text-center text-white">Course Lists</h4>
                <div class="message">
                    <?php
                    //Check if session data exists
                    if (isset($_SESSION['message'])) {

                        //echo session message
                        echo $_SESSION['message'];

                        //Destroy session variable
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $query = "SELECT * FROM course where status=1 order by course_name";
                    $result = mysqli_query ($link, $query);
                    $course_id = 0;
                    while ($alldata = mysqli_fetch_assoc($result)) {
                    $course_id++;
                    ?>

                    <tr>
                        <th scope="row"><?php echo $course_id; ?></th>
                        <td><?php echo $alldata['course_name']; ?></td>
                        <td><?php echo $alldata['course_desc']; ?></td>
                        <td>
                            <a class="btn btn-outline-warning bdex" href="updatecourse.php?course_id=<?php echo $alldata['course_id']; ?>">Edit</a>
                            <a class="btn btn-outline-danger my-3 bdex" href="deletecourse.php?course_id=<?php echo $alldata['course_id']; ?>"onclick="return confirm('Are you sure to delete course?');">Delete</a>
                            <a class="btn btn-outline-success bdex" href="details.php?course_id=<?php echo $alldata['course_id']; ?>">Details</a>
                        </td>
                    </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
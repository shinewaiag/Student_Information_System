<?php
//Initialize the session to get session data
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//Get session data
$user_id=$_SESSION['user_id'];
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<?php
//Include config file and nav file
require_once "config.php";
include_once "nav.php";
?>
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark m-0">
        <a href="mycourse.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">View Lists</a>
        <a href="confirmedliststudent.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">Confirmed Lists</a>
        <div class="container">
            <h4 class="text-center text-white">My Course Lists</h4>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Description</th>
                    <th scope="col">Enrolled date</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //Select the data required
                $query = "SELECT course_student.course_name,course_student.course_desc,course_student.enroll_date,course_student.course_id,course.status FROM course_student inner join course on course_student.course_id=course.course_id where course_student.user_id='$user_id' and course_student.status=1";
                $result = mysqli_query ($link, $query);
                $user_id = 0;
                while ($alldata = mysqli_fetch_assoc($result)) {
                    $user_id++;
                    //Show retrieve data
                    ?>
                    <tr>
                        <td><?php echo $alldata['course_name'] ?></td>
                        <td><?php echo $alldata['course_desc'] ?></td>
                        <td><?php echo $alldata['enroll_date'] ?></td>
                        <?php
                        $status=$alldata['status'];
                        //Check the status condition
                        if($status==0) {
                            $un="<p class='text-danger'>Unavailabe</p>";
                            //Show unavailable if course still exists in course lists
                            ?>
                            <td><?php echo $un; ?></td>
                            <?php
                        }else{
                            $ava="<p class='text-success'>Available</p>";
                            //Show available if course doesn't exist in course list
                          ?>
                           <td><?php echo $ava; ?></td>
                        <?php
                        }
                        ?>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
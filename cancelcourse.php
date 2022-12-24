<?php
//Include config file
include 'config.php';

//Check if data exist
if (isset($_GET['course_id'],$_GET['user_id'])) {

    //Get the data
    $course_id    = $_GET['course_id'];
    $user_id      = $_GET['user_id'];

    //Delete data which equals to user id
    $query = "DELETE FROM course_student WHERE course_id = '$course_id' and user_id='$user_id'";
    $result= mysqli_query($link, $query);
    if ($result) {

        //Display a message which is deleted
        $_SESSION['message'] = "<div class='text-warning english'>Cancelled course successfully.</div>";

        //Include navadmin file and viewstudent file
        include_once "navadmin.php";
        include_once "viewstudent.php";
    }
}
?>

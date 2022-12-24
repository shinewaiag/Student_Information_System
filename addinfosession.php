<?php
require_once "config.php";

//To get the course id passed from other page
if(isset($_GET['course_id'])){
    $course_id=$_GET['course_id'];

    //Start a session
    session_start();

    //Store data in session variables
    $_SESSION['course_id']=$course_id;

    //Direct to other page
    echo "<script>location='addinfo.php'</script>";
}
?>
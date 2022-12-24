<?php
//Include config file
include 'config.php';

//Check if data exist
if (isset($_GET['course_id'],$_GET['user_id'])) {

    //Get the data
    $course_id = $_GET['course_id'];
    $user_id   =$_GET['user_id'];

    //Update the data which is equal to course id and user id
    $query = "UPDATE course_student SET status=1 WHERE course_id = '$course_id' and user_id='$user_id'";
    $result = mysqli_query($link, $query);
    if ($result) {

        //Display a confirmed message
        $success="Confirmed Successfully";
        echo '<script type="text/javascript">alert("' . $success . '");</script>';

        //Redirect to details.php
        echo "<script>location='details.php?course_id=$course_id'</script>";
    }
}
?>
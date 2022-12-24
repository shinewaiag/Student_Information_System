<?php
//Include config file
include 'config.php';

//Check if data exists
if (isset($_GET['course_id'])) {

    //Get the data
    $course_id = $_GET['course_id'];

    //Delete data which equals to course id
    $query = "DELETE FROM course_student WHERE course_id = '$course_id' and status=0";
    $result= mysqli_query($link, $query);
    if ($result) {
        //Redirect to mycourse.php
        echo "<script>location='mycourse.php'</script>";
    }
}

?>

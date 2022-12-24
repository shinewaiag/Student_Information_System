<?php
//Include config file
include_once 'config.php';

//Check if data exist
if (isset($_GET['user_id'])) {

    //Store data to variable
    $user_id    = $_GET['user_id'];

    //Start delete query
    $query = "DELETE FROM student WHERE user_id = '$user_id'";
    $result= mysqli_query($link, $query);
    if ($result) {
        //Redirect to viewinfo file
        echo "<script>location='viewinfo.php'</script>";
    }
}
?>

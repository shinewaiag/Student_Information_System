<?php
include_once "config.php";
if(isset($_GET['course_id'])){
    $course_id=$_GET['course_id'];
    $query="update course set status=1 where course_id='$course_id'";
    $result=mysqli_query($link,$query);
    if($result){
        echo "<script>location='viewcourse.php'</script>";
    }
}
?>
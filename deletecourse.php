<?php
//Initialize session

?>
<?php
//include config file
include_once 'config.php';

//Check if data exist
if (isset($_GET['course_id'])) {

    //Get the data
    $course_id = $_GET['course_id'];

    //Select data which equals to course id
    $sql="select * from course where course_id='$course_id'";
    $ans=mysqli_query($link,$sql);
    $data=mysqli_fetch_assoc($ans);

    //Store data to variables
    $cname=$data['course_name'];
    $status=$data['status'];

    /*Select data which equals to course id to get count
    To check there are students who enrolled*/
    $qqq="select * from course_student where course_id='$course_id'";
    $ddd=mysqli_query($link,$qqq);
    $count=mysqli_num_rows($ddd);

    /*Check if count is greater than zero, update only status to zero
    Because there are students who enrolled*/
    if($count>0){

        $sqy="update course set status=0 where course_id='$course_id'";
        $aaa=mysqli_query($link,$sqy);
        //Display message successfully deleted
        $_SESSION['message'] = "<div class='text-warning english'>Successfully deleted course.View in deleted course.</div>";

        //Include navadmin file and viewcourse file
        include_once "navadmin.php";
        include_once "viewcourse.php";
    }else{
        /*If count is less than zero,there are no students who enrolled
        just delete query*/
        $query = "DELETE FROM course WHERE course_id = '$course_id'";
        $result = mysqli_query($link, $query);

        //Display message
        $_SESSION['message'] = "<div class='text-warning english'>Deleted course Successfully.</div>";

        //Include navadmin file and viewcourse file
        include_once "navadmin.php";
        include_once "viewcourse.php";
    }


}
?>
 
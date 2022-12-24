<?php
//Initialize session
session_start();

//Include config file
require_once "config.php";
?>
<?php
//Get the stored session data
$user_id=$_SESSION['user_id'];

//Get the data from other page
if (isset($_GET['course_id'])) {

    //Store the data to variable
    $cou_id = $_GET['course_id'];

    $sql = "select * from course where course_id='$cou_id'";
    $results = mysqli_query($link, $sql);

    //fetches a result row as an associative array
    $data = mysqli_fetch_assoc($results);
    $course_id = $data['course_id'];
    $course_name = $data['course_name'];
    $course_desc = $data['course_desc'];


    $qry="select * from course_student where course_id='$course_id' and user_id='$user_id'";
    $datas=mysqli_query($link,$qry);
    $ans=mysqli_fetch_assoc($datas);
    $uid=$ans['user_id'];
    $cid=$ans['course_id'];
    $cname=$ans['course_name'];
    if ($user_id==$uid && $cou_id==$cid){
        $_SESSION['message'] = "<div class='text-warning english'>$cname already enrolled.</div>";
        include_once "nav.php";
        include_once "header.php";
        include_once "listgroup.php";

    }else{

        $query = "insert into course_student (user_id,course_id,course_name,course_desc,enroll_date)
       values('$user_id','$course_id','$course_name','$course_desc',now())";
        if ($link->query($query)) {
            echo "<script>location='mycourse.php'</script>";
        }else{
            echo "Error:".$query."
        ".$link->error;
        }
        $link->close();

    }


}
?>

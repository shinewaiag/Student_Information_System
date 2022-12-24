<?php
//Initialize session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}

//Get the stored session data
$a=$_SESSION['a'];
$cname=$_SESSION['course_name'];
$desc=$_SESSION['course_desc'];
$name=$_SESSION['name'];
$descerr=$_SESSION['descerr'];
require_once "config.php";
include_once "navadmin.php";
?>
<?php

//Processing form data when form is submitted
$course_id  = filter_input(INPUT_POST,'course_id');
$coursename = filter_input(INPUT_POST,'coursename');
$course_desc= filter_input(INPUT_POST,'course_desc');
$vflag=true;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['a']=1;
    if(empty($coursename)){
        $vflag=false;
        $_SESSION['name']="Please enter course name";
        $_SESSION['course_name']=$coursename;
        echo "<script>location='updatecourse.php?course_id=$course_id'</script>";
    }elseif (!preg_match('/^[#+a-zA-Z ]*$/', $coursename)){
        $vflag=false;
        $_SESSION['name']="Only letters and white space allowed";
        $_SESSION['course_name']=$coursename;
        echo "<script>location='updatecourse.php?course_id=$course_id'</script>";
    }
    else{
        $coursename=$_POST['coursename'];
        $_SESSION['course_name']=$coursename;
    }
    if(empty($course_desc)){
        $vflag=false;
        $_SESSION['descerr']="Please enter course description";
        $_SESSION['course_desc']=$course_desc;
        echo "<script>location='updatecourse.php?course_id=$course_id'</script>";
    }else{
        $course_desc=$_POST['course_desc'];
        $_SESSION['course_desc']=$course_desc;
    }
    if($vflag==true){
        $sql = "update course set course_name='$coursename',course_desc='$course_desc' where course_id='$course_id'";
        if ($link->query($sql)) {
            echo "<script>location='viewcourse.php'</script>";;
        }
        $link->close();
    }

}
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark m-0">
        <a href="addcourse.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">Add Course</a>
        <a href="viewcourse.php" class="btn btn-lg english btn-outline-info" role="button" aria-pressed="true">View Course</a>
        <a href="viewdeletedcourse.php" class="btn btn-lg english btn-outline-info bdex1 float-right mx-2" role="button" aria-pressed="true">Deleted Course</a>
        <div class="container">
            <h4><p class="display-5 english text-center text-white">Fill up information to update course</p></h4>
            <?php
            if (isset($_GET['course_id'])) {
                $course_id   = $_GET['course_id'];
                $query = "SELECT * FROM course WHERE course_id= '$course_id'";
                $result= mysqli_query($link, $query);
                $_SESSION['a']=0;
                $alldata  = mysqli_fetch_assoc($result);
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="course_id" value="<?php echo $alldata['course_id']; ?>">
                    <div class="form-group row">
                        <label for="coursename" class="col-sm-2 col-form-label text-white english">Course name</label>
                        <div class="col-sm-10">
                            <input type="text" name="coursename" class="form-control" value="<?php if($a==0){echo $alldata['course_name']; }else{echo $cname;} ?>" id="coursename">
                            <span class="help-block english text-white my-md-0"><?php echo $name ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="course_desc" class="col-sm-2 col-form-label text-white english">Description</label>
                        <div class="col-sm-10">
                            <textarea name="course_desc" class="form-control" id="course_desc"><?php if($a==0){echo $alldata['course_desc'];}else{echo $desc;} ?></textarea>
                            <span class="help-block english text-white my-md-0"><?php echo $descerr ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-outline-success float-right"  value="Submit">
                        <a href="viewcourse.php" class="btn btn-outline-danger float-right mx-2">Cancel</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

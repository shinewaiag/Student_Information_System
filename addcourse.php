
<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}

//include config file and navadmin file
require_once "config.php";
include_once "navadmin.php";
?>
<?php
//Define variables and initialize with empty values
$nameErr='';
$descErr='';

//Processing form data when form is submitted
$course_id  = filter_input(INPUT_POST,'course_id');
$coursename = filter_input(INPUT_POST,'coursename');
$desc       = filter_input(INPUT_POST,'desc');

$vflag=true;

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    //Check if course name is empty
    if(empty($coursename)){
        $vflag=false;

        //Display an error message if course name doesn't exist
        $nameErr="Please enter course name";

        //Check if course name contains numbers
    }elseif (!preg_match('/^[#+a-zA-Z ]*$/', $coursename)){
        $vflag=false;

        //Display an error message if course name contains numbers
        $nameErr="Only letters and white space allowed";
    }else{
        $coursename=$_POST['coursename'];
    }

    //Check if course description is empty
    if(empty($desc)){
        $vflag=false;

        //Display an error message if course description is empty
        $descErr="Please enter course description";
    }else{
        $desc=$_POST['desc'];
    }

    //If above all conditions are true, inserting data into database
    if($vflag==true){
        $sql = "insert into course (course_name,course_desc) values ('$coursename','$desc')";
        if ($link->query($sql)) {
            echo "<script>location='viewcourse.php'</script>";
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
        <a href="addcourse.php" class="btn btn-lg  english btn-outline-info mx-2 bdex1" role="button" aria-pressed="true">Add Course</a>
        <a href="viewcourse.php" class="btn btn-lg english btn-outline-info bdex1" role="button" aria-pressed="true">View Course</a>
        <a href="viewdeletedcourse.php" class="btn btn-lg english btn-outline-info bdex1 float-right mx-2" role="button" aria-pressed="true">Deleted Course</a>
        <div class="container">
            <h4><p class="display-5 english text-center text-white">Fill up information to create course</p></h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="course_id">
                <div class="form-group row">
                    <label for="coursename" class="col-sm-2 col-form-label text-white english">Course name</label>
                    <div class="col-sm-10">
                        <input type="text" name="coursename" class="form-control" id="coursename" value="<?php echo $coursename ?>">
                        <span class="help-block english text-white my-md-0"><?php echo $nameErr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desc" class="col-sm-2 col-form-label text-white english">Description</label>
                    <div class="col-sm-10">
                        <textarea name="desc" class="form-control" id="desc" ><?php echo $desc ?></textarea>
                        <span class="help-block english text-white my-md-0"><?php echo $descErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-outline-success float-right"  value="Submit">
                    <a href="viewcourse.php" class="btn btn-outline-danger float-right mx-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

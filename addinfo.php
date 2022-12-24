<?php
//To access the session data
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<?php
//Include config file and nav file
require_once "config.php";
?>

<?php
include_once "nav.php";
?>
<?php
//Define variables and initialize with empty values
$nameErr='';
$emailErr='';
$nrcErr='';
$phErr='';
$addressErr='';
$fileErr='';

//Get the session data from other page
$user_id = $_SESSION['user_id'];

//Processing form data when form is submitted
$stdname = filter_input(INPUT_POST, 'stdname');
$mail    = filter_input(INPUT_POST, 'email');
$gender  = filter_input(INPUT_POST, 'gridRadios');
$nrc     = filter_input(INPUT_POST, 'nrc');
$ph      = filter_input(INPUT_POST, 'ph');
$address = filter_input(INPUT_POST, 'address');


$vflag = true;

//Check the session whether the session data exists or not
if(isset($_SESSION['course_id'])) {

    //Get the session data
    $course_id=$_SESSION['course_id'];

    //Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Check if student name is empty
        if (empty($_POST["stdname"])) {
            $vflag = false;

            //Display an error message if student name is empty
            $nameErr = "Please enter student name.";

            //Check if student name contains only alphabets
        } elseif (!preg_match('/^[a-zA-Z ]*$/', $stdname)) {
            $vflag = false;

            //Display an error message if student name contains not only alphabets
            $nameErr = "Only letters and whitespace allowed";
        } else {
            $stdname = $_POST["stdname"];
        }

        //Check if email is empty
        if (empty($_POST["email"])) {
            $vflag = false;

            //Display an error message if email is empty
            $emailErr = "Please enter email.";

            //Check if email is valid
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $vflag = false;

            //Display an error message if email is invalid
            $emailErr = "invalid email format";
        } else {
            $mail = $_POST["email"];
        }

        //Check if nrc is empty
        if (empty($_POST["nrc"])) {
            $vflag = false;

            //Display an error message if nrc is empty
            $nrcErr = "Please enter nrc.";

            //Check if nrc contains as defined
        } elseif (!preg_match('/^[0-9]{1,2}+\/[a-zA-Z]{3}+\(+[a-zA-Z]{1}+\)[0-9]{6}$/', $nrc)) {
            $vflag = false;

            //Display an error message if nrc is invalid
            $nrcErr = "invalid nrc format";
        } else {
            $nrc = $_POST["nrc"];
        }

        //Check if phone number is empty
        if (empty($_POST["ph"])) {
            $vflag = false;

            //Display an error message if phone number is empty
            $phErr = "Please enter phone number.";

            //Check if phone number is same as defined
        } elseif (!preg_match('/^09\d{9}$/', $ph)) {
            $vflag = false;

            //Display an error message if phone number is invalid
            $phErr = "invalid phone format";
        } else {
            $ph = $_POST["ph"];
        }


        //Check if address is empty
        if (empty($_POST["address"])) {
            $vflag = false;

            //Display an error message if address is empty
            $addressErr = "Please enter address.";
        } else {
            $address = $_POST["address"];
        }

        //Get the file name when form is submitted
        $file_name=$_FILES['file']['name'];

        //Get the temporary filename of the file
        $tmp=$_FILES['file']['tmp_name'];

        //Get the file size
        $size=$_FILES['file']['size'];

        //Define folder to store image
        $target_dir="upload/";

        //To get the rightmost segment of the file path
        $target_file=$target_dir.basename($_FILES['file']['name']);

        //To get the array or string contains directory name, basename, extension
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //Allow file type
        $extensions_arr = array("jpg","jpeg","png","gif");

        //Check if temporary filename is empty
        if(empty($tmp)){
            $vflag = false;

            //Display an error message if temporary filename is empty
            $fileErr="Please choose photo.";

            //Check if file size is larger
        }elseif ($size>5242880){
            $vflag=false;

            //Display an error message if file size is large
            $fileErr="File size is too large";

            //Check the file type
        }elseif( in_array($imageFileType,$extensions_arr)){

            //If file type is valid,move file to directory defined
            move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$file_name);
        } else {
            $vflag = false;

            //Display an error message if file type is invalid
            $fileErr = "Invalid image format.JPG,JPEG,PNG,GIF are only allowed.";
        }

        //If above all conditions are true,
        if ($vflag == true) {

            //Get data to enroll the course
            $kkk = "select * from course where course_id='$course_id'";
            $aa = mysqli_query($link, $kkk);
            $data = mysqli_fetch_assoc($aa);
            $course_id = $data['course_id'];
            $course_name = $data['course_name'];
            $course_desc = $data['course_desc'];

            //To add student info to database
            $sql = "insert into student(user_id,stdname,gender,mail,nrc,phone,address,image) values ('$user_id','$stdname','$gender','$mail','$nrc','$ph','$address','$file_name')";
            $result = mysqli_query($link, $sql);
            if ($result) {

                //To enroll the course
                $query = "insert into course_student (user_id,course_id,course_name,course_desc,enroll_date)
                values('$user_id','$course_id','$course_name','$course_desc',now())";
                $aa = mysqli_query($link,$query);
                echo "<script>location='mycourse.php'</script>";

                //Destroy a single session variable
                unset($_SESSION['course_id']);
            }


        }
    }

    //Processing form data when form is submitted
}elseif($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["stdname"])) {
        $vflag = false;
        $nameErr = "Please enter student name.";
    } elseif (!preg_match('/^[a-zA-Z ]*$/', $stdname)) {
        $vflag = false;
        $nameErr = "Only letters and whitespace allowed";
    } else {
        $stdname = $_POST["stdname"];
    }

    if (empty($_POST["email"])) {
        $vflag = false;
        $emailErr = "Please enter email.";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $vflag = false;
        $emailErr = "invalid email format";
    } else {
        $mail = $_POST["email"];
    }

    if (empty($_POST["nrc"])) {
        $vflag = false;
        $nrcErr = "Please enter nrc.";
    } elseif (!preg_match('/^[0-9]{1,2}+\/[a-zA-Z]{3}+\(+[a-zA-Z]{1}+\)[0-9]{6}$/', $nrc)) {
        $vflag = false;
        $nrcErr = "invalid nrc format";
    } else {
        $nrc = $_POST["nrc"];
    }

    if (empty($_POST["ph"])) {
        $vflag = false;
        $phErr = "Please enter phone number.";
    } elseif (!preg_match('/^09\d{9}$/', $ph)) {
        $vflag = false;
        $phErr = "invalid phone format";
    } else {
        $ph = $_POST["ph"];
    }

    if (empty($_POST["address"])) {
        $vflag = false;
        $addressErr = "Please enter address.";
    } else {
        $address = $_POST["address"];
    }

    $file_name = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES['file']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");
    if (empty($tmp)) {
        $vflag = false;
        $fileErr = "Please choose photo.";
    } elseif ($size > 5242880) {
        $vflag = false;
        $fileErr = "File size is too large";
    } else {
        if (in_array($imageFileType, $extensions_arr)) {
            move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $file_name);
        } else {
            $vflag = false;
            $fileErr = "Invalid image format.JPG,JPEG,PNG,GIF are only allowed.";
        }
    }


    if ($vflag == true) {
        $sql = "insert into student(user_id,stdname,gender,mail,nrc,phone,address,image) values ('$user_id','$stdname','$gender','$mail','$nrc','$ph','$address','$file_name')";
        $result = mysqli_query($link, $sql);
        if ($result) {
            echo "<script>location='viewinfo.php'</script>";
        }
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
        <a href="addinfo.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">Add Info</a>
        <a href="viewinfo.php" class="btn btn-lg english btn-outline-info" role="button" aria-pressed="true">View Info</a>
        <div class="container">
            <p class="display-5 english text-center text-white">My Information</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label english text-white">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="stdname" class="form-control" id="name" value="<?php echo $stdname?>">
                        <span class="help-block english text-white my-md-0"><?php echo $nameErr; ?></span>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0 text-white english">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Male" checked>
                                <label class="form-check-label text-white english" for="gridRadios1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Female">
                                <label class="form-check-label text-white english" for="gridRadios2">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-white english">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $mail?>">
                        <span class="help-block english text-white my-md-0"><?php echo $emailErr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nrc" class="col-sm-2 col-form-label text-white english">NRC</label>
                    <div class="col-sm-10">
                        <input type="text" name="nrc" class="form-control" id="nrc"  value="<?php echo $nrc?>">
                        <span class="help-block english text-white my-md-0"><?php echo $nrcErr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ph" class="col-sm-2 col-form-label text-white english">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="number" name="ph" class="form-control" id="ph"  value="<?php echo $ph?>">
                        <span class="help-block english text-white my-md-0"><?php echo $phErr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label text-white english">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" id="address"><?php echo $address?></textarea>
                        <span class="help-block english text-white my-md-0"><?php echo $addressErr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-white english">Your Photo</label>
                    <div class="col-sm-10">
                        <input type='file' name='file' id="someId"/>
                        <span class="help-block english text-white my-md-0"><?php echo $fileErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-outline-success float-right"  value="Submit">
                    <input type="button" value="Cancel" class="btn btn-outline-danger float-right mx-2" onclick="history.back()">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var file = document.getElementById('someId');

    file.onchange = function(e) {
        var ext = this.value.match(/\.([^\.]+)$/)[1];
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                break;
            default:
                alert('jpg,jpeg,png,gif are only allowed');
                this.value = '';
        }
    };
</script>
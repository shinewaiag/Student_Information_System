<?php
//Initialize the session
session_start();

//Get the stored session data
$stdnameerr=$_SESSION['stdnameerr'];
$mailerr=$_SESSION['mailerr'];
$nrcerr=$_SESSION['nrcerr'];
$pherr=$_SESSION['pherr'];
$addressErr=$_SESSION['addrerr'];
$sname=$_SESSION['sname'];
$maill=$_SESSION['mail'];
$nrrc=$_SESSION['nrc'];
$phh=$_SESSION['ph'];
$addrr=$_SESSION['addr'];
$a=$_SESSION['a'];
$fileErr=$_SESSION['fileerr'];
?>
<?php
//Include config file and nav file
require_once "config.php";
include_once "nav.php";
?>
<?php
//Get the session stored data
$user_id = $_SESSION['user_id'];

//Processing form data when form is submitted
$stdname = filter_input(INPUT_POST, 'stdname');
$mail    = filter_input(INPUT_POST, 'email');
$gender  = filter_input(INPUT_POST, 'gridRadios');
$nrc     = filter_input(INPUT_POST, 'nrc');
$ph      = filter_input(INPUT_POST, 'ph');
$address = filter_input(INPUT_POST, 'address');



$vflag=true;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['a']=1;
    if (empty($_POST["stdname"])) {
        $vflag=false;
        $_SESSION['stdnameerr'] = "Please enter student name.";
        $_SESSION['sname']=$stdname;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } elseif (!preg_match('/^[a-zA-Z ]*$/', $stdname)) {
        $vflag=false;
        $_SESSION['stdnameerr']="Only letters and white space allowed";
        $_SESSION['sname']=$stdname;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } else {
        $stdname = $_POST["stdname"];
        $_SESSION['sname']=$stdname;
    }

    if (empty($_POST["email"])) {
        $vflag=false;
        $_SESSION['mailerr'] = "Please enter email.";
        $_SESSION['mail']=$mail;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $vflag=false;
        $_SESSION['mailerr']="Invalid email format";
        $_SESSION['mail']=$mail;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } else {
        $mail = $_POST["email"];
        $_SESSION['mail']=$mail;
    }

    if (empty($_POST["nrc"])) {
        $vflag=false;
        $_SESSION['nrcerr'] = "Please enter nrc.";
        $_SESSION['nrc']=$nrc;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } elseif (!preg_match('/^[0-9]{1,2}+\/[a-zA-Z]{3}+\(+[a-zA-Z]{1}+\)[0-9]{6}$/', $nrc)) {
        $vflag=false;
        $_SESSION['nrcerr']="Invalid nrc format";
        $_SESSION['nrc']=$nrc;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } else {
        $nrc = $_POST["nrc"];
        $_SESSION['nrc']=$nrc;
    }

    if (empty($_POST["ph"])) {
        $vflag=false;
        $_SESSION['pherr'] = "Please enter phone number.";
        $_SESSION['ph']=$ph;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } elseif (!preg_match('/^09\d{9}$/', $ph)) {
        $vflag=false;
        $_SESSION['pherr']="Invalid phone number";
        $_SESSION['ph']=$ph;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } else {
        $ph = $_POST["ph"];
        $_SESSION['ph']=$ph;
    }

    if (empty($_POST["address"])) {
        $vflag=false;
        $_SESSION['addrerr'] = "Please enter address.";
        $_SESSION['addr']=$address;
        echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
    } else {
        $address = $_POST["address"];
        $_SESSION['addr']=$address;
    }
    $filename=$_FILES['file']['name'];
    $tmp=$_FILES['file']['tmp_name'];
    $size=$_FILES['file']['size'];
    $_target_dir="upload/";
    $target_file=$_target_dir.basename($_FILES['file']['name']);
    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr=array("jpg","jpeg","png","gif");
    if(empty($tmp)){
        if($vflag==true){
            $sql = "update student set stdname='$stdname',gender='$gender',mail='$mail',nrc='$nrc',phone='$ph',address='$address'where user_id='$user_id'";
            if ($link->query($sql)) {
                echo "<script>location='viewinfo.php'</script>";
            }
        }
    }else{
        if(in_array($imageFileType, $extensions_arr)) {
            move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $filename);
            if($size<5242880) {
                if($vflag == true) {
                    $sql = "update student set stdname='$stdname',gender='$gender',mail='$mail',nrc='$nrc',phone='$ph',address='$address',image='$filename'  where user_id='$user_id'";
                    if ($link->query($sql)) {
                        echo "<script>location='viewinfo.php'</script>";
                    }
                }
            }else{
                $vflag = false;
                $_SESSION['fileerr'] = "File size is too large";
                echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
            }
        }else{
            $vflag = false;
            $_SESSION['fileerr'] = "Invalid image format.JPG,JPEG,PNG,GIF are only allowed.";
            echo "<script>location='updateinfo.php?user_id=$user_id'</script>";
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

        <?php
        $sql="select * from student where user_id='$user_id'";
        $results=mysqli_query($link,$sql);
        $count=mysqli_num_rows($results);
        if($count==1){ ?>
            <a href="addinfo.php" class="btn btn-lg disabled  english btn-outline-info mx-2" role="button" aria-pressed="true">Add Info</a>
        <?php }else{ ?>
            <a href="addinfo.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">Add Info</a>
        <?php }
        ?>

        <a href="viewinfo.php" class="btn btn-lg english btn-outline-info" role="button" aria-pressed="true">View Info</a>
        <div class="container">
            <p class="display-5 english text-center text-white">My Information</p>
            <?php
            if (isset($_GET['user_id'])) {
            $user_id   = $_GET['user_id'];
            $query = "SELECT * FROM student WHERE user_id= '$user_id'";
            $result= mysqli_query($link, $query);
            $alldata  = mysqli_fetch_assoc($result);
            $_SESSION['a']=0;
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label english text-white">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="stdname" value="<?php if($a==0){echo $alldata['stdname'];}else{echo $sname;} ?>" class="form-control" id="name">
                        <span class="help-block english text-white my-md-0"><?php echo $stdnameerr; ?></span>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0 text-white english">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Male" <?php if($alldata['gender']=="Male"){ echo "checked";}?>>
                                <label class="form-check-label text-white english" for="gridRadios1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio"  name="gridRadios" id="gridRadios2" value="Female"  <?php if($alldata['gender']=="Female"){ echo "checked";}?>>
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
                        <input type="email" name="email" value="<?php if($a==0){echo $alldata['mail'];}else{echo $maill;} ?>" class="form-control" id="inputEmail3">
                        <span class="help-block english text-white my-md-0"><?php echo $mailerr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nrc" class="col-sm-2 col-form-label text-white english">NRC</label>
                    <div class="col-sm-10">
                        <input type="text" name="nrc" value="<?php if($a==0){echo $alldata['nrc'];}else{echo $nrrc;} ?>" class="form-control" id="nrc">
                        <span class="help-block english text-white my-md-0"><?php echo $nrcerr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ph" class="col-sm-2 col-form-label text-white english">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="number" name="ph" value="<?php if($a==0){echo $alldata['phone'];}else{echo $phh;} ?>" class="form-control" id="ph">
                        <span class="help-block english text-white my-md-0"><?php echo $pherr; ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label text-white english">Address</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" id="address"><?php if($a==0){echo $alldata['address'];}else{echo $addrr;}?></textarea>
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
                    <input type="submit" class="btn btn-outline-success float-right"  value="Update">
                    <a href="viewinfo.php" class="btn btn-outline-danger float-right mx-2">Cancel</a>
                </div>
            </form>
            <?php } ?>
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
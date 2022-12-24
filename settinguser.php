<?php
//Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//Get the session data
$user_id=$_SESSION["user_id"];
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<?php
//Include config file and nav file
require_once "config.php";
include_once "nav.php";
?>
<?php
//Get the session data to variable
$conerr=$_SESSION['conerr'];
$pwerror=$_SESSION['pwerror'];
$password_err=$_SESSION['error'];

//Processing form data when form is submitted
$username = filter_input(INPUT_POST, 'username');
$oldpassword=filter_input(INPUT_POST,'oldpassword');
$password = filter_input(INPUT_POST, 'password');
$confirmpassword=filter_input(INPUT_POST,'confirmpassword');
$param_password = password_hash($password, PASSWORD_DEFAULT);

$sql="select password from users where user_id=$user_id";
$data=mysqli_query($link,$sql);
$datas=mysqli_fetch_assoc($data);
$pw=$datas['password'];

if (!empty($username)) {
    if (password_verify($oldpassword,$pw)) {
        if (strlen(trim($password)) > 5) {
            if ($password == $confirmpassword) {
                $query = "UPDATE users SET username='$username', password='$param_password' where user_id='$user_id' ";
                if ($link->query($query)) {
                    echo "<script>location='logoutsetting.php'</script>";
                }
                $_SESSION['conerr']="";
            } else{
                $_SESSION['conerr']="Password did not match";
                echo "<script>location='settinguser.php?user_id=$user_id'</script>";
            }
            $_SESSION['error']="";
        } else {
            $_SESSION['error'] = "Password must be at least 6 characters";
            echo "<script>location='settinguser.php?user_id=$user_id'</script>";
        }
        $_SESSION['pwerror'] = "";
    } else {
        $_SESSION['pwerror'] = "incorrect old password";
        echo "<script>location='settinguser.php?user_id=$user_id'</script>";
    }
    mysqli_close($link);
}




?>
<?php
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result= mysqli_query($link, $query);
$alldata  = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
</head>
<body style="background-color: #bdbdbd;background-image: url('legorobot.jpg');background-size: cover">
<div class="main2">
    <h2 class="english text-center sign" style="margin-top: -80px">Setting</h2>
    <p class="english text-center">Please fill this form to update an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="admin_id" value="<?php echo $alldata['user_id']; ?>">
        <div class="form-group">
            <input type="text" name="username" class="un" required value="<?php echo $alldata['username']; ?>">
        </div>
        <div class="form-group">
            <input type="password" name="oldpassword" placeholder="old password" class="un" required>
            <span style="margin-left: 160px" class="english help-block text-center my-md-0"><?php echo $pwerror; ?></span>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="new password" class="un" required>
            <span style="margin-left: 120px" class="english help-block text-center my-md-0"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="password" name="confirmpassword" placeholder="confirm password" class="un" required>
            <span style="margin-left: 150px" class="english help-block text-center my-md-0"><?php echo $conerr; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="submit" value="Update">
        </div>
    </form>
</div>
</body>
</html>
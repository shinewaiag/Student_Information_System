<?php
//Initialize the session variable with empty value
$_SESSION['stdnameerr']='';
$_SESSION['mailerr']='';
$_SESSION['nrcerr']='';
$_SESSION['pherr']='';
$_SESSION['addrerr']='';
$_SESSION['nameerr']='';
$_SESSION['sname']='';
$_SESSION['mail']='';
$_SESSION['nrc']='';
$_SESSION['ph']='';
$_SESSION['addr']='';
$_SESSION['a']='';
$_SESSION['fileerr']='';
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1f3f41">
    <a class="navbar-brand text-white english">Student Information System</a>
    <div class="container-fluid" id="navbarSupportedContent">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-white english" href="welcome.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="viewinfo.php">MyInfo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="mycourse.php">My Course</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="settinguser.php">Setting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
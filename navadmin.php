<?php
//Initialize the session variable with empty value
$_SESSION['a']='';
$_SESSION['course_name']='';
$_SESSION['course_desc']='';
$_SESSION['name']='';
$_SESSION['descerr']='';
require_once "config.php"
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1f3f41">
    <a class="navbar-brand text-white english">Student Information System</a>
    <div class="container-fluid id="navbarSupportedContent">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link text-white english" href="welcomeadmin.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="viewcourse.php">Course</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="viewstudent.php">Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="setting.php">Setting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white english" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

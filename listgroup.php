<?php
//Get the session stored data
$user_id=$_SESSION['user_id'];

//include config file
require_once "config.php";
?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<div class="container">
    <div class="jumbotron jumbotron-fluid m-0" style="background-color: #1f3f41;">
        <div class="container">
            <h4 class="text-center text-white">Course Lists</h4>
            <div class="message">
                <?php
                //Check if data in session
                if (isset($_SESSION['message'])) {

                    //Display session message
                    echo $_SESSION['message'];

                    //Destroy session variable
                    unset($_SESSION['message']);
                }
                ?>
            </div>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT * FROM course where status=1 order by course_name";
                $result = mysqli_query ($link, $query);
                $course_id = 0;
                while ($alldata = mysqli_fetch_assoc($result)) {
                $course_id++;
                ?>

                <tr>
                    <td><?php echo $alldata['course_name']; ?></td>
                    <td><?php echo $alldata['course_desc']; ?></td>
                    <td>
                        <?php
                        $sql="select * from student where user_id='$user_id'";
                        $results=mysqli_query($link,$sql);
                        $count=mysqli_num_rows($results);
                        if($count==1){ ?>
                        <a class="btn btn-outline-success bdex" href="enroll.php?course_id=<?php echo $alldata['course_id']; ?>">Enroll</a>
                        <?php }else{ ?>
                        <a class="btn btn-outline-danger bdex" href="addinfosession.php?course_id=<?php echo $alldata['course_id']; ?>" onclick="return confirm('Please fill your info first?');">Enroll</a>
                        <?php } ?>
                    </td>

                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
<?php
//Initialize session to get session data
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: adminlogin.php");
    exit;
}

//Check if data exist
if(isset($_GET['course_id'])){

    //Get data
    $course_id=$_GET['course_id'];
}
//Stored data to session variable
$_SESSION['course_id']=$course_id;

//Include config file and navadmin file
require_once "config.php";
include_once "navadmin.php";


?>
<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<div class="container">
    <div class="jumbotron-fluid bg-dark m-0">
        <a href="addcourse.php" class="btn btn-lg  english btn-outline-info my-3 mx-2" role="button" aria-pressed="true">Add Course</a>
        <a href="viewcourse.php" class="btn btn-lg english btn-outline-info my-3" role="button" aria-pressed="true">View Course</a>
        <a href="viewdeletedcourse.php" class="btn btn-lg english btn-outline-info bdex1 float-right my-3 mx-2" role="button" aria-pressed="true">Deleted Course</a>

        <div class="container">
            <h4><p class="display-5 english text-center text-white">Course Details</p></h4>
            <?php
            if (isset($_GET['course_id'])) {
                $course_id = $_GET['course_id'];
                $query = "SELECT * FROM course WHERE course_id= '$course_id'";
                $result = mysqli_query($link, $query);
                $_SESSION['a'] = 0;
                $alldata = mysqli_fetch_assoc($result);
            ?>
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col" class="text-warning">Course Name</th>
                        <th><?php echo $alldata['course_name'];?></th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-warning">Course Description</th>
                        <th><?php echo $alldata['course_desc'];?></th>
                    </tr>
                    </thead>
                </table>
            <?php } ?>
        </div>
<! for tab>
        <section class="container py-4">
            <div class="row">
                <div class="col-md-12">
                    <ul id="tabsJustified" class="nav nav-tabs">
                        <li class="nav-item"><a href="" data-target="#enroll" data-toggle="tab" class="nav-link text-uppercase active">Enrolled Students</a></li>
                        <li class="nav-item"><a href="" data-target="#confirm" data-toggle="tab" class="nav-link text-uppercase">Confirmed Students</a></li>
                    </ul>
                    <br>
                    <div id="tabsJustifiedContent" class="tab-content">
                        <div id="enroll" class="tab-pane fade active show">
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Enrolled Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $query = "SELECT course_student.course_id,student.user_id,student.stdname,course_student.enroll_date,student.phone,student.mail from student inner join course_student on student.user_id=course_student.user_id where course_student.status=0 and course_id='$course_id' order by student.stdname";
                                $result = mysqli_query ($link, $query);
                                $sql="SELECT student.stdname,student.user_id,course_student.enroll_date,student.phone,student.mail from student inner join course_student on student.user_id=course_student.user_id where course_student.status=1 and course_id='$course_id' order by student.stdname";
                                $ans=mysqli_query($link,$sql);
                                $course_id = 0;
                                while ($alldata = mysqli_fetch_assoc($result)) {
                                $course_id++;
                                ?>
                                <tr>
                                    <td><a href="studentinfo.php?user_id=<?php echo $alldata['user_id'];?>"><?php echo $alldata['stdname']; ?></a></td>
                                    <td><?php echo $alldata['phone']; ?></td>
                                    <td><a href="#modal"  data-id="<?php echo $alldata['mail']; ?>" class="open bound anchor1" data-toggle="modal"><?php echo $alldata['mail']; ?></a></td>
                                    <td><?php echo $alldata['enroll_date']; ?></td>
                                    <td><a href="confirmcoursemodal.php?course_id=<?php echo $alldata['course_id'];?>&user_id=<?php echo $alldata['user_id'] ?>" class="btn btn-outline-success bdex" role="button" aria-pressed="true">Confirm</a></td>
                                </tr>
                                </tbody>
                                <?php } ?>
                            </table>
                        </div>
                        <div id="confirm" class="tab-pane fade">
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Enrolled Date</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php
                            $a=0;
                            while ($data=mysqli_fetch_assoc($ans)){
                                $a++;
                                $k=1;
                                ?>
                            <tr>
                                <td><a href="studentinfo.php?user_id=<?php echo $data['user_id']; ?>"><?php echo $data['stdname']; ?></a></td>
                                <td><?php echo $data['phone']; ?></td>
                                <td><a href="#modal" data-id="<?php echo $data['mail']; ?>" class="open bound" data-toggle="modal"><?php echo $data['mail']; ?></a></td>
                                <td><?php echo $data['enroll_date']; ?></td>
                            </tr>
                                </tbody>
                        <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<! for modal form>
<form action="sendmail.php" method="post">
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-image: url('modalimage.jpg');background-size: cover">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Message</h4>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <label>To:</label>
                    <input type="email" id="to" class="form-control validate" name="to" required>
                </div>

                <div class="md-form mb-4">
                    <label>Subject:</label>
                    <input type="text" id="subject" class="form-control validate" name="subject" required>
                </div>

                <div class="md-form mb-4">
                    <label>Messages:</label>
                    <textarea class="form-control" id="message" name="message" maxlength="6000" rows="7" required></textarea>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-success submitBtn float-right" onclick="sendmail()">Send</button>
            </div>
        </div>
    </div>
</div>
</form>
<script>
    $(document).on("click", ".open", function () {
        var myEmail = $(this).data('id');
        $(".modal-body #to").val( myEmail );
    });
</script>
<script>
    function sendmail() {
        var to=$('#to').val();
        var subject=$('#subject').val();
        var message=$('#message').val();
        if(to.trim()==''){
            alert('Please enter email');
            $('#to').focus();
            return false;
        }
        else if(subject.trim()==''){
            alert('Please enter subject');
            $('#subject').focus();
            return false;
        }
        else if(message.trim()==''){
            alert('Please enter message');
            $('#message').focus();
            return false;
        }
    }
</script>



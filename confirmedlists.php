<link rel="stylesheet" href="asset/css/bootstrap.min.css">
<link rel="stylesheet" href="asset/css/style.css">
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/popper.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>
<?php


//Include navadmin file
require_once "navadmin.php";
?>

<div class="container">
    <div class="jumbotron jumbotron-fluid bg-dark m-0">
        <a href="viewstudent.php" class="btn btn-lg  english btn-outline-info mx-2" role="button" aria-pressed="true">View Lists</a>
        <a href="confirmedlists.php" class="btn btn-lg english btn-outline-info" role="button" aria-pressed="true">Confirmed Lists</a>

        <form action="confirmedlistssearch.php" method="post" id="navBarSearchForm" class="form-check-inline float-right">
            <input class="form-control typeahead" id="txt" type="text" name="text" placeholder="Search by student name/course name " aria-label="Search">
        </form>

        <link rel="stylesheet" src="asset/css/bootstrap.min.css">
        <link rel="stylesheet" href="asset/css/style.css">
        <script src="asset/js/jquery.min.js"></script>
        <script src="asset/js/popper.min.js"></script>
        <script src="asset/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="asset/js/typeahead.js"></script>
        <script>
            $(document).ready(function () {
                $('#txt').typeahead({
                    source: function (query, result) {
                        $.ajax({
                            url: "autocomplete.php",
                            data: 'query=' + query,
                            dataType: "json",
                            type: "POST",
                            success: function (data) {
                                result($.map(data, function (item) {
                                    return item;
                                }));
                            }
                        });
                    }
                });
            });
        </script>

        <div class="container">
            <h4 class="text-center text-white my-3">Student lists of confirmed courses</h4>
            <div class="message">


                <?php
                //Display message
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];

                    //Destroy session variable
                    unset($_SESSION['message']);
                }
                ?>
            </div>
            <table class="table table-primary">
                <thead>
                <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Course Description</th>
                    <th scope="col">Enrolled Date</th>
                </tr>
                </thead>
                <tbody>
                <?php

                //Select data which is required
                $query = "SELECT course_student.course_id,student.stdname,course_student.course_name,course_student.course_desc,course_student.enroll_date,course_student.course_id,course_student.user_id from student inner join course_student on student.user_id=course_student.user_id where course_student.status=1";
                $result = mysqli_query ($link, $query);
                $user_id = 0;
                while ($alldata = mysqli_fetch_assoc($result)) {
                    $user_id++;
                    ?>
                    <tr>

                        <?php

                        //Store session variables
                        $course_id=$alldata['course_id'];
                        $user_id=$alldata['user_id'];

                        //Show the retrieve data
                        ?>
                        <td><a class="anchor2 bound" href="studentinfo.php?user_id=<?php echo $alldata['user_id']; ?>"><?php echo $alldata['stdname'];?></a></td>
                        <td><a class="anchor2 bound" href="details.php?course_id=<?php echo $alldata['course_id']; ?>"><?php echo $alldata['course_name'];?></a></td>
                        <td><?php echo $alldata['course_desc'];?></td>
                        <td><?php echo $alldata['enroll_date'];?></td>
                        <td><a href="cancelconfirmedcourse.php?course_id=<?php echo $course_id?>&user_id=<?php echo $user_id?>" onclick="return confirm('Are you sure to cancel?');" class="btn english btn-outline-danger bdex" role="button" aria-pressed="true">Cancel</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
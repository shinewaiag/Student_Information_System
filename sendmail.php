<?php
//Initialize the session
session_start();

//Get the session variable data
$course_id=$_SESSION['course_id'];

    //Processing form data when form is submitted
    $to=filter_input(INPUT_POST,'to');
    $subject=filter_input(INPUT_POST,'subject');
    $message=filter_input(INPUT_POST,'message');

    //send mail directly from a script
    $sendmail = mail($to, $subject, $message);
    if ($sendmail) {

        //Display sent message
        $success = "Sent Successfully";
        echo '<script type="text/javascript">alert("' . $success . '");</script>';
        echo "<script>location='details.php?course_id=$course_id'</script>";
    }

?>
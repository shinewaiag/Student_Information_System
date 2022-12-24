<?php
//Get the data from search php
$keyword = strval($_POST['query']);
$search_param = "{$keyword}%";

//Attempt to connect to mysql database
$link =new mysqli('127.0.0.1', 'root', '' , 'uni');

//Prepare a select statement
$qry=("select * from course where course_name like ?");
$query=("select * from student where stdname like ?");
$sql = $link->prepare($qry);

//Bind variables to the prepared statement as parameter
$sql->bind_param("s",$search_param);
$sql->execute();
$result = $sql->get_result();

//If data row exists,assign to the variable
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $courseResult[] =$row["course_name"];
    }
    echo json_encode($courseResult);

}

$sql= $link->prepare($query);

//Bind variables to the prepared statement as parameter
$sql->bind_param("s",$search_param);
$sql->execute();
$ans=$sql->get_result();

//If data row exists,assign to the variable
if ($ans->num_rows > 0) {
    while($row = $ans->fetch_assoc()) {
        $stdResult[] =$row["stdname"];
    }
    echo json_encode($stdResult);

}

$link->close();
?>


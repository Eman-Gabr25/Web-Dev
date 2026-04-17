<?php
include_once "conn.php";

$class_name = $_POST['name_class'];

$sql = "INSERT INTO info_class (cl_name)
VALUES ('$class_name')";

$result = mysqli_query($conn, $sql);

header("location:class_in.php");
?>
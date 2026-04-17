<?php
include_once "conn.php";

if (
    empty($_POST['name']) || 
    empty($_POST['address']) || 
    empty($_POST['phone']) || 
    empty($_POST['age']) || 
    empty($_POST['class'])
) {
    echo "<script>alert('Please Fill All Data');
    location.href = 'add.php';
    </script>";
   
} else {

    $st_name = $_POST['name'];
    $st_address = $_POST['address'];
    $st_phone = $_POST['phone'];
    $st_age = $_POST['age'];
    $st_class = $_POST['class'];

    $sql = "INSERT INTO info_student (st_name, st_address, st_class, st_age, st_phone)
    VALUES ('$st_name', '$st_address', '$st_class', '$st_age', '$st_phone')";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "<script>alert('Data inserted successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
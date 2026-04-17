<?php
include_once "conn.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM info_student WHERE st_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
        alert('Data deleted successfully');
        location.href='home.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    echo "Invalid request";
}
?>
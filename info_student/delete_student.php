<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;

mysqli_query($conn, "DELETE FROM students WHERE id='$id'");
header("Location: home.php");
exit();

?>

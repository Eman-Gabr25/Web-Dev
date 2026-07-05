<?php
session_start();

echo "Welcome ".$_SESSION['user'];

?>

<br><br>

<a href="profile.php">Profile</a>

<br>

<a href="admin.php">Admin Panel</a>
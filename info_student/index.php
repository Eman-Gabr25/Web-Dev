<?php
session_start();
include "conn.php";
include "style.php";
?>

<div class="main">

    <h2>Login</h2>

    <form class="post-form" method="POST">

        <input type="text" name="username" placeholder="Username" required><br><br>

        <input type="password" name="password" placeholder="Password" required><br><br>

        <button type="submit" name="login">Login</button>

        <button type="button" onclick="location.href='register.php'">
            Register
        </button>

    </form>

</div>

<?php
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']); 
       $sql = "SELECT * FROM login 
            WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $_SESSION['user'] = $username;

        header("Location: home.php");
        exit();

    } else {
        echo "<script>alert('Invalid login');</script>";
    }
}
?>
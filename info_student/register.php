<?php
include "conn.php";
include "style.php";
?>

<div class="main">

    <h2>Register</h2>

    <form class="post-form" method="POST">

        <input type="text" name="name" placeholder="Full Name" required><br><br>

        <input type="text" name="username" placeholder="Username" required><br><br>

        <input type="password" name="password" placeholder="Password" required><br><br>

        <button type="submit" name="register">Register</button>

    </form>

    <a href="index.php">Back to Login</a>

</div>

<?php
if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // 🔥 md5

    $check = "SELECT * FROM login WHERE username='$username'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {

        echo "<script>alert('Username already exists');</script>";

    } else {

        $sql = "INSERT INTO login (name, username, password)
                VALUES ('$name', '$username', '$password')";

        mysqli_query($conn, $sql);

        echo "<script>
        alert('Registered successfully');
        location.href='index.php';
        </script>";
    }
}
?>
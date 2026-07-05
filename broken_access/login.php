<?php
session_start();

if(isset($_POST['login']))
    {

    $username=$_POST['username'];
    $password=$_POST['password'];

    if($username=="admin" && $password=="admin123"){
        $_SESSION['user']="admin";
        $_SESSION['role']="admin";
        header("Location: home.php");
    }

    elseif($username=="eman" && $password=="123"){
        $_SESSION['user']="eman";
        $_SESSION['role']="user";
        header("Location: home.php");
    }

    else{
        echo "Wrong credentials";
    }

}
?>

<form method="POST">
Username
<input name="username">

Password
<input type="password" name="password">

<button name="login">Login</button>

</form>
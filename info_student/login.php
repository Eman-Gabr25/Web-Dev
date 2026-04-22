<?php

session_start();
require_once 'db.php';


if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields!";
    } else {
       
        $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            
            if (password_verify($password, $user['password'])) {
           
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
               
                header("Location: home.php");
                exit();
            } else {
                $error = "Wrong password!";
            }
        } else {
            $error = "Username not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Student System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            width: 380px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h2 { text-align: center; color: #1a73e8; margin-bottom: 25px; font-size: 24px; }
        .subtitle { text-align: center; color: #666; margin-bottom: 25px; font-size: 14px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; color: #333; }
        input {
            width: 100%; padding: 10px 14px;
            border: 1px solid #ccc; border-radius: 6px;
            font-size: 15px; transition: border 0.2s;
        }
        input:focus { border-color: #1a73e8; outline: none; }
        .btn {
            width: 100%; padding: 12px;
            background: #1a73e8; color: white;
            border: none; border-radius: 6px;
            font-size: 16px; cursor: pointer;
        }
        .btn:hover { background: #1558b0; }
        .error { background: #fde8e8; color: #c0392b; padding: 10px; border-radius: 6px; margin-bottom: 15px; }
        .link { text-align: center; margin-top: 18px; }
        .link a { color: #1a73e8; text-decoration: none; }
        .demo { background: #e8f0fe; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 13px; color: #444; }
    </style>
</head>
<body>
<div class="card">
    <h2>🎓 Student System</h2>
    <p class="subtitle">Login to management students</p>

    

    <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Username or Email</label>
            <input type="text" name="username" placeholder="Enter username or email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>

    <div class="link">
        Don't have an account? <a href="register.php">Register here</a>
    </div>
</div>
</body>
</html>

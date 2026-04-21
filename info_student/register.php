<?php

require_once 'db.php';

$error = "";
$success = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm  = trim($_POST['confirm_password']);
    
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    } else {
        
        $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email'");
        
        if (mysqli_num_rows($check) > 0) {
            $error = "Username or Email already exists!";
        } else {
           
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            
            if (mysqli_query($conn, $sql)) {
                $success = "Account created successfully! You can now login.";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Student System</title>
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
            width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h2 { text-align: center; color: #1a73e8; margin-bottom: 25px; }
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
            transition: background 0.2s;
        }
        .btn:hover { background: #1558b0; }
        .error   { background: #fde8e8; color: #c0392b; padding: 10px; border-radius: 6px; margin-bottom: 15px; }
        .success { background: #e8f5e9; color: #27ae60; padding: 10px; border-radius: 6px; margin-bottom: 15px; }
        .link { text-align: center; margin-top: 18px; }
        .link a { color: #1a73e8; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <h2>📝 Create Account</h2>

    <?php if ($error):   ?><div class="error"><?= $error ?></div><?php endif; ?>
    <?php if ($success): ?><div class="success"><?= $success ?></div><?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Min 6 characters" required>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Repeat password" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>

    <div class="link">
        Already have an account? <a href="login.php">Login here</a>
    </div>
</div>
</body>
</html>

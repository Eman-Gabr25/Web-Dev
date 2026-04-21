<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;


$result = mysqli_query($conn, "SELECT * FROM students WHERE id='$id'");
if (mysqli_num_rows($result) == 0) {
    header("Location: home.php"); /
    exit();
}
$student = mysqli_fetch_assoc($result);

$error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name']);
    $address = trim($_POST['address']);
    $age     = trim($_POST['age']);
    $class   = trim($_POST['class']);
    $mobile  = trim($_POST['mobile']);
    
    if (empty($name)) {
        $error = "Student name is required!";
    } else {
        $sql = "UPDATE students SET 
                    name='$name', 
                    address='$address', 
                    age='$age', 
                    class='$class', 
                    mobile='$mobile'
                WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: home.php");
            exit();
        } else {
            $error = "Error updating: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student - Student System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }
        .navbar {
            background: #1a73e8; padding: 14px 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .navbar h1 { color: white; font-size: 20px; }
        .nav-links a {
            color: white; text-decoration: none; margin-left: 15px;
            padding: 7px 14px; border-radius: 5px; font-size: 14px;
            background: rgba(255,255,255,0.15);
        }
        .container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .card { background: white; border-radius: 12px; padding: 35px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h2 { color: #333; margin-bottom: 25px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; color: #555; font-size: 14px; }
        input, select {
            width: 100%; padding: 10px 14px;
            border: 1px solid #ddd; border-radius: 6px; font-size: 15px;
        }
        input:focus, select:focus { border-color: #1a73e8; outline: none; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .btn-submit {
            background: #1a73e8; color: white; width: 100%;
            padding: 12px; border: none; border-radius: 6px;
            font-size: 16px; cursor: pointer; margin-top: 10px;
        }
        .btn-submit:hover { background: #1558b0; }
        .btn-cancel { display: block; text-align: center; margin-top: 12px; color: #666; text-decoration: none; font-size: 14px; }
        .error { background: #fde8e8; color: #c0392b; padding: 10px; border-radius: 6px; margin-bottom: 15px; }
        .id-badge { background: #e8f0fe; color: #1a73e8; padding: 5px 12px; border-radius: 20px; font-size: 13px; }
    </style>
</head>
<body>

<div class="navbar">
    <h1>🎓 Student Management System</h1>
    <div class="nav-links">
        <a href="home.php">🏠 Home</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>✏️ Edit Student <span class="id-badge">ID: <?= $student['id'] ?></span></h2>

        <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name *</label>
                <!-- value="..." fills the input with current data -->
                <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="<?= htmlspecialchars($student['address']) ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" name="age" value="<?= $student['age'] ?>" min="1" max="100">
                </div>
                <div class="form-group">
                    <label>Class</label>
                    <select name="class">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <option value="<?= $i ?>" <?= $student['class'] == $i ? 'selected' : '' ?>>
                                Class <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile" value="<?= htmlspecialchars($student['mobile']) ?>">
            </div>

            <button type="submit" class="btn-submit">💾 Update Student</button>
            <a href="home.php" class="btn-cancel">← Cancel, go back</a>
        </form>
    </div>
</div>

</body>
</html>

<?php
session_start();
require_once 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Student Management System</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; }

        
        .navbar {
            background: #1a73e8;
            padding: 14px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 { color: white; font-size: 20px; }
        .nav-links a {
            color: white; text-decoration: none;
            margin-left: 15px; padding: 7px 14px;
            border-radius: 5px; font-size: 14px;
            background: rgba(255,255,255,0.15);
            transition: background 0.2s;
        }
        .nav-links a:hover { background: rgba(255,255,255,0.3); }
        .nav-links a.danger { background: #e53935; }
        .nav-links a.danger:hover { background: #b71c1c; }

        /* ---- Page Content ---- */
        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .page-header h2 { color: #333; }
        .btn-add {
            background: #27ae60; color: white;
            padding: 10px 20px; border-radius: 6px;
            text-decoration: none; font-size: 14px;
        }
        .btn-add:hover { background: #219150; }

        
        .table-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #1a73e8; color: white; }
        thead th { padding: 14px 16px; text-align: left; font-size: 14px; }
        tbody tr:nth-child(even) { background: #f8f9fa; }
        tbody tr:hover { background: #e8f0fe; }
        tbody td { padding: 12px 16px; color: #444; font-size: 14px; }

        .badge {
            padding: 3px 10px; border-radius: 12px;
            font-size: 12px; font-weight: bold;
        }
        .badge-blue { background: #e8f0fe; color: #1a73e8; }

       
        .btn-edit {
            background: #1a73e8; color: white;
            padding: 5px 12px; border-radius: 4px;
            text-decoration: none; font-size: 13px; margin-right: 5px;
        }
        .btn-delete {
            background: #e53935; color: white;
            padding: 5px 12px; border-radius: 4px;
            text-decoration: none; font-size: 13px;
        }
        .btn-edit:hover   { background: #1558b0; }
        .btn-delete:hover { background: #b71c1c; }

        .no-data { text-align: center; padding: 40px; color: #999; font-size: 16px; }

        .welcome { color: #666; font-size: 14px; }
    </style>
</head>
<body>


<div class="navbar">
    <h1>Student Management System</h1>
    <div class="nav-links">
        <span style="color:white; font-size:14px;">Hello, <strong><?= $_SESSION['username'] ?></strong> &nbsp;|</span>
        <a href="home.php">🏠 Home</a>
        <a href="add_student.php">➕ Add Student</a>
        <a href="logout.php" class="danger">🚪 Logout</a>
    </div>
</div>


<div class="container">
    <div class="page-header">
        <h2>📋 All Students Records</h2>
        <a href="add_student.php" class="btn-add">➕ Add New Student</a>
    </div>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Class</th>
                    <th>Mobile</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) == 0): ?>
                    <tr>
                        <td colspan="7" class="no-data">
                            No students found. <a href="add_student.php">Add the first student!</a>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php while ($student = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td><strong><?= htmlspecialchars($student['name']) ?></strong></td>
                        <td><?= htmlspecialchars($student['address']) ?></td>
                        <td><span class="badge badge-blue"><?= $student['age'] ?></span></td>
                        <td>Class <?= $student['class'] ?></td>
                        <td><?= htmlspecialchars($student['mobile']) ?></td>
                        <td>
                            <a href="edit_student.php?id=<?= $student['id'] ?>" class="btn-edit">✏️ Edit</a>
                            <a href="delete_student.php?id=<?= $student['id'] ?>" class="btn-delete"
                               onclick="return confirm('Are you sure you want to delete this student?')">🗑️ Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

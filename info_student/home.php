<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

include "style.php";
include "nav.php";
include_once "conn.php";


$sql = "SELECT * 
        FROM info_student 
        JOIN info_class 
        ON info_student.st_class = info_class.cl_id";

$result = mysqli_query($conn, $sql);
?>

<div class="main">

<h2>Students List</h2>

<table cellpadding="7px">

    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row['st_id']; ?></td>
            <td><?php echo $row['st_name']; ?></td>
            <td><?php echo $row['st_address']; ?></td>
            <td><?php echo $row['st_phone']; ?></td>
            <td><?php echo $row['st_age']; ?></td>
            <td><?php echo $row['cl_name']; ?></td>

            <td>
                <a href="edit.php?id=<?php echo $row['st_id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['st_id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this student?');">
                   Delete
                </a>
            </td>
        </tr>

    <?php
        }
    } else {
    ?>

        <tr>
            <td colspan="7" style="text-align:center; color:red;">
                No data found
            </td>
        </tr>

    <?php } ?>

    </tbody>

</table>

</div>
<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

include "style.php";
include "nav.php";
include_once"conn.php";
?>
<?php
$search = "";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM info_student 
            WHERE st_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM info_student";
}

$result = mysqli_query($conn, $sql);
?>

<form method="POST">
    <input type="text" name="search" placeholder="Search by name" value="<?php echo $search; ?>">
    <button type="submit">Search</button>
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <td><?php echo $row['st_id']; ?></td>
        <td><?php echo $row['st_name']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['st_id']; ?>">Edit</a>
        </td>
    </tr>
<?php
    }
} else {
?>
    <tr>
        <td colspan="3">No results found</td>
    </tr>
<?php } ?>

</table>
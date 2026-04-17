<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
include "style.php";
include "nav.php";
include_once"conn.php";


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $del = "DELETE FROM info_student WHERE st_id = $id";
    mysqli_query($conn, $del);

    echo "<script>
    alert('Deleted successfully');
    location.href='search_delete.php';
    </script>";
}


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
    <input type="text" name="search" value="<?php echo $search; ?>" placeholder="Search student">
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
            
            <a href="search_delete.php?delete=<?php echo $row['st_id']; ?>"
               onclick="return confirm('Are you sure you want to delete?');">
               Delete
            </a>
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
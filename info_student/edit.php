<?php
include "style.php";
include "nav.php";
include_once "conn.php";


if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $class = $_POST['class'];

    $update = "UPDATE info_student SET
        st_name='$name',
        st_address='$address',
        st_phone='$phone',
        st_age='$age',
        st_class='$class'
        WHERE st_id=$id";

    $result = mysqli_query($conn, $update);

    if ($result) {
        echo "<script>
        alert('Data updated successfully');
        location.href='index.php';
        </script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


$st_id = $_GET['id'];

$sql = "SELECT * FROM info_student WHERE st_id = $st_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="main">
    <h2>Edit Student</h2>

    <form class="post-form" action="" method="POST">

        
        <input type="hidden" name="id" value="<?php echo $row['st_id']; ?>">

        
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $row['st_name']; ?>">
        </div>

       
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $row['st_address']; ?>">
        </div>

        
        <div class="form-group">
            <label>Phone Number</label>
            <input type="number" name="phone" value="<?php echo $row['st_phone']; ?>">
        </div>

        
        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" value="<?php echo $row['st_age']; ?>">
        </div>

        
        <div class="form-group">
            <label>Class</label>
            <select name="class" required>

                <?php
                $class_sql = "SELECT * FROM info_class";
                $class_result = mysqli_query($conn, $class_sql);

                while ($class = mysqli_fetch_assoc($class_result)) {
                    $selected = ($class['cl_id'] == $row['st_class']) ? "selected" : "";
                ?>
                    <option value="<?php echo $class['cl_id']; ?>" <?php echo $selected; ?>>
                        <?php echo $class['cl_name']; ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        
        <input class="submit" type="submit" name="update" value="Update">

    </form>
</div>
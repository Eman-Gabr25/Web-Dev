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
<div class="main">
    <h2>Add Student</h2>

    <form class="post-form" action="save.php" method="POST">

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name">
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" >
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="number" name="phone">
        </div>

        <div class="form-group">
            <label>Age</label>
            <input type="number" name="age" >
        </div>

        <div class="form-group">
            <label>Class</label>
            <select name="class" required>
                <option value="" selected disabled>Select Class</option>
                <?php
                $sql="SELECT * FROM info_class";
                $result=mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($result))
                    {
        ?>
            <option value="<?php echo $row['cl_id']; ?>">
                <?php echo $row['cl_name']; ?>
            </option>
        <?php
        }
        ?>

            </select>
        </div>

        <input class="submit" type="submit" value="Save">

    </form>
</div>
</body>
</html>
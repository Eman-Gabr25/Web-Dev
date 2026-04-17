<?php
session_start();


if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
include "style.php";
include "nav.php";
?>
<div class="main">
    <h2>Add class</h2>

    <form class="post-form" action="class_save.php" method="POST">

        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="name_class" required />
        </div>

        
        <input class="submit" type="submit" value="Save">

    </form>
</div>
</body>
</html>
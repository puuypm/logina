<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['emailAdmin'])) {
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin</h1>
    <?php echo $_SESSION['emailAdmin']; ?>
    <a href="logout.php">Keluar</a>
</body>

</html>

<?php 
session_destroy();
?>
<?php 
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');
    include_once(__DIR__ . '/Classes/User.php');

    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){ 
        header('location:login.php');
        exit;
    }

    $user = User::getUserByEmail($_SESSION['email']);

    if (!User::isAdmin($user['email'])) {
        header('location: index.php');
        exit;
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <h1>Welcome, <?php echo $user['firstname']; ?>!</h1>
    
</body>
</html>
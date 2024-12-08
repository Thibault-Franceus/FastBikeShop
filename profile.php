<?php
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/User.php');
    
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('location: login.php');
    }

    $user = User::getUserByEmail($_SESSION['email']);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['password'])) {
            $message = "Password cannot be empty";
        } else {
            $password = $_POST['password'];
            try {
                User::changePassword($user['email'], $password);
                $message = "Password changed successfully";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }    





?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/styles.css">

</head>
<body class="profile_body">
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <div class="profile">
        <h1>Profile</h1>
        <form action="" method="post">
            <div class="form__field">
                <label for="Firstname">Voornaam</label>
                <h2><?php echo $user['firstname']; ?></h2>
                <label for="Lastname">Achternaam</label>
                <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>">
                <label for="Email">Email</label>
                <input type="text" name="email" value="<?php echo $user['email']; ?>">
            </div>

            <div class="form__field">
                <label for="Password">New Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <?php if(isset($message)): ?>
                <div><?php echo $message; ?></div>
            <?php endif; ?>
            
            <div class="form__field">
                <input type="submit" value="Update" class="btn btn--primary">	
            </div>
        </form>

    </div>

    <script>
        
    </script>
</body>
</html>
<?php

session_start();
include_once(__DIR__ . '/Classes/Db.php');
include_once(__DIR__ . '/Classes/User.php');

function canLogIn($email, $password) {
    $user = User::getUserByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (canLogIn($email, $password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['email'] = $email;

        header('Location: index.php');
        exit;
    } else {
        $error = true;
    }
}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<div class="bikeShopLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Aanmelden</h2>
				<?php if(isset($error)):?>
				<div class="form__error">
					<p>
						Sorry, the email or password is incorrect, please try again!
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Aanmelden" class="btn btn--primary">	
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Onthoud mij</label>
				</div>
                <div class="form__field">
                    <p>Door op aanmelden te klikken erken je dat ik cookies gebruik om u te tracken.</p>
                </div>
                <div class="form__field">
                    <p>Nog geen Account? <a href="signup.php">Registreer</a></p>
                </div>
			</form>
		</div>
	</div>

</body>
</html>
<?php 
	include_once(__DIR__ . '/Classes/User.php');

	if(!empty($_POST)){
		try{
		$user = new User();
		$user->setFirstname($_POST['firstname']);
		$user->setLastname($_POST['lastname']);
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		$user->register();
		}
		catch(Exception $e){
			$error = $e->getMessage();
		}

	}


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<div class="bikeShopLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Registreer</h2>
				<?php if(isset($error)):?>
				<div class="form__error">
					<p>
						<?php echo $error; ?>
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Firstname">Voornaam</label>
					<input type="text" name="firstname">
					<label for="Lastname">Achternaam</label>
					<input type="text" name="lastname">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Passwoord</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Registreer" class="btn btn--primary">	
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Onthoud mij</label>
				</div>
                <div class="form__field">
                    <p>Door op registreren te klikken erken je dat ik cookies gebruik om u te tracken.</p>
                </div>
                <div class="form__field">
                    <p>Al een account? <a href="login.php">Aanmelden</a></p>
                </div>
			</form>
		</div>
	</div>
</body>
</html>
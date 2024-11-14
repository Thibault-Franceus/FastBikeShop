<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/styles.css">
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
					<label for="Password">Passwoord</label>
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
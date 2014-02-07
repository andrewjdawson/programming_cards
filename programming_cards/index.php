<!DOCTYPE html>
<html>
	<head>
		<?php
			require 'util/functions.php';
			$link = connect();
			$db = initialize_database($link);
		?>
		<title>My Journal</title>
	</head>
	
	<body>
		<form id='login' method='post' action='api/login.php'>
			<fieldset>
				<legend>Login</legend>
				<label for='username'>Username: </label>
				<input type='text' name='username' required='required'> <br />
				<label for='password'>Password: </label>
				<input type='password' name='password' required='required'> <br />
				<input type='submit'>
			</fieldset>
		</form>
		
		<form id='signup' method='post' action='api/sign_up.php'>
			<fieldset>
				<legend>Signup</legend>
				<label for='username'>Username: </label>
				<input type='text' name='username' required='required'> <br />
				<label for='password'>Password: </label>
				<input type='password' name='password' required='required'> <br />
				<label for='comfirm_password'>Comfirm Password: </label>
				<input type='password' name='comfirm_password' required='required'> <br />
				<input type='submit'>
			</fieldset>
		</form>
	</body>
</html>
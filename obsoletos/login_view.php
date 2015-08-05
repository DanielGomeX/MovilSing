<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<h1>LOGIN </h1>
	<?php echo validation_errors(); ?>
	<?php echo form_open('verifylogin'); ?>
	<label for="username">Username:</label>
	<input type="text" size="20" id="username" name="username" autofocus/>
	<br/>
	<label for="password">Password:</label>
	<input type="password" size="20" id="passowrd" name="password"/>
	<br/>
	<input type="submit" value="Login"/>
</form>
</body>
</html>
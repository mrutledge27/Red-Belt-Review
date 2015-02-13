<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="../assets/users/css/login_reg.css">
</head>
<body>

	<h1>Welcome!</h1>
	<form action="/users/register" method="post">
		<label>Name: <input type="text" name="name"></label>
		<label>Alias: <input type="text" name="alias"></label>
		<label>Email: <input type="text" name="email"></label>
		<label>Password: <input type="password" name="password"></label>
		<p>*Password should be at least 8 characters</p>
		<label>Confirm PW: <input type="password" name="confirm_password"></label>
		<input type="submit" value="Register">
		<input type="hidden" name="action" value="register">
		<?php
			if ($this->session->flashdata('registration_error'))
			{
				echo $this->session->flashdata('registration_error');
			}
		?>
	</form>
	<form action="/users/login" method="post">
		<label>Email: <input type="text" name="email"></label>
		<label>Password: <input type="password" name="password"></label>
		<input type="submit" value="Login">
		<input type="hidden" name="action" value="login">
		<?php
			if ($this->session->flashdata('login_error'))
			{
				echo $this->session->flashdata('login_error');
			}
		?>
	</form>
</body>
</html>
<?php include('server.php') ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registration system PHP and MySQL</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>

		<div class="header">
			<p class="headers" style="color: #ffffff;font-weight: normal;">Login Panel</p>
		</div>
	
		<form method="post" action="login.php">

			<?php include('errors.php'); ?>

			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" placeholder="Type your username">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password" placeholder="Type your password">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="login_user">Login</button>
			</div>
		
	</form>


</body>
</html>
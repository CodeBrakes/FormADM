<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Add application</h2>
	</div>
	
	<form method="post" action="addapplication.php">

		

		<div class="input-group">
			<label>Date From</label>
			<input type="date" name="datefrom" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Date To</label>
			<input type="date" name="dateto" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Reason</label>
			<textarea type="text" name="reason"></textarea>
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="app_registration">Submit</button>
		</div>
		<p>
	 <a href="index.php">Back to application list</a>
		</p>
	</form>
</body>
</html>
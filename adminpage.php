<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel Page</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body style="padding: 3% 3% 3% 3%;">
		
		<p class="headers">Admin Page</p>
		<br><br>

		<div style="background-color: #ffffff; width: 100%;box-shadow: 0px 2px 18px rgba(0, 0, 0, 0.1);padding: 1%1%1%1%;">

			<!-- notification message -->
			<?php if (isset($_SESSION['success'])) : ?>
				<div class="error success" >
					<p>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
					</p>
				</div>
			<?php endif ?>

			<!-- logged in user information -->
			<?php  if (isset($_SESSION['username'])) : ?>
				
			<p class="headers">Welcome to <?php echo $_SESSION['username']; ?> panel </p>
			<br>
			<a href="index.php?logout='1'" class="buttons_1">logout</a> 
			<input type="button" onclick="window.location='register.php'" class="buttons_2" value="Register New User"/>

			<br><br>

			<table style="width: 100%;">
			    <tr>
			        <th>Username</th>
			        <th>Name</th>
			        <th>Surname</th>
			        <th>Email</th>
			        <th>Type</th>
			    </tr>

				<?php 
					$mysqli = new mysqli("localhost", 'root', '', 'codebrak_registration'); 
					$query = "SELECT * FROM users";
					
					$i = 0;
					
					if ($result = $mysqli->query($query)) {
				    	while ($row = $result->fetch_assoc()) {    	
				    		echo '<tr class="' . ( ( $i %2 == 0 ) ? 'gray_row' : 'white_row' ) . '">
					                  
					                  <td style="width: 20%;">'.	$row["username"]	.'</td>
					                  <td style="width: 20%;">'.	$row["name"]		.'</td>
					                  <td style="width: 20%;">'.	$row["lastname"]	.'</td>
					                  <td style="width: 20%;">'.	$row["email"]		.'</td>
					                  <td style="width: 20%;">'.	$row["type"]		.'</td>
					              
					              </tr>';
				    		$i++;
				    	}
				    	$result->free();
					} 
				?>

			</table>

			<?php endif ?>

		</div>
	

	</body>

</html>
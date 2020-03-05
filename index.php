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
		<title>PHP Form User panel</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body style="padding: 3% 3% 3% 3%;">
		<p class="headers">User Application Dashboard</p>
		<br><br>
		<div style="background-color: #ffffff; width: 100%;box-shadow: 0px 2px 18px rgba(0, 0, 0, 0.1);padding: 1%1%1%1%;">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>

		<p class="headers">Welcome beloved <?php echo $_SESSION['username']; ?> <span style="color:red;">&hearts;</span> </p>
		<br>
		<a href="index.php?logout='1'" class="buttons_1">logout</a> 
		<input type="button" onclick="window.location='addapplication.php'" class="buttons_2" value="Submit Request"/>

		<br><br><br>
		<table style="width: 100%;">
			<tr>
			    <th> Date From </th>
			    <th> Date To </th>
			    <th> Reason </th>
			    <th> Status</th>
			</tr>
			<?php 
				$mysqli = new mysqli("localhost", 'root', '', 'codebrak_registration'); 
				$query = "SELECT * FROM applications where username = '".$_SESSION['username']."' order by timestamp desc";
					
				$i = 0;
					
				if ($result = $mysqli->query($query)) {
				    while ($row = $result->fetch_assoc()) {  
				    	$datefrom =  date("d/m/Y", strtotime($row["datefrom"]));
				        $dateto = date("d/m/Y", strtotime($row["dateto"]));
				        $reason = $row["reason"];
				        $status = $row["status"];

				    	echo '<tr class="' . ( ( $i %2 == 0 ) ? 'gray_row' : 'white_row' ) . '">
					              <td style="width: 20%;text-align:center;">'.	$datefrom	.'</td>
					              <td style="width: 20%;text-align:center;">'.	$dateto		.'</td>
					              <td style="width: 20%;text-align:left;">'.	$reason		.'</td>
					              <td style="width: 20%;text-align:center;">'.	$status		.'</td>
					          </tr>';
				    		$i++;
				    	}
				    	$result->free();
					} 
			?>
		</table>
		<br><br><br>

		<?php endif ?>
	</div>
	

</body>
</html>
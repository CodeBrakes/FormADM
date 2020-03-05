<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'codebrak_registration');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$usertype = mysqli_real_escape_string($db, $_POST['usertype']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($name)) { array_push($errors, "Name is required"); }
		if (empty($lastname)) { array_push($errors, "Surname is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
	    if(!isset($_POST['usertype'])) {array_push($errors, "user type is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = $password_1;//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, name, lastname, email, password, type) 
					  VALUES('$username','$name','$lastname', '$email', '$password', '$usertype')";
			mysqli_query($db, $query);

			//$_SESSION['username'] = $username;
			$_SESSION['success'] = "The user was registered succesfully";
			header('location: adminpage.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = $password;
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				 while($row = mysqli_fetch_assoc($results)) {
                 $type= $row["type"];
				if ($type == 'employee'){
				header('location: index.php');
				}
			    if ($type == 'admin'){
				header('location: adminpage.php');
				}
			}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

		// REGISTER APPLICATION
	if (isset($_POST['app_registration'])) {
		$username = mysqli_real_escape_string($db, $_SESSION['username']);
		$datefrom = mysqli_real_escape_string($db, date('Y-m-d', strtotime(str_replace('-','/',$_POST['datefrom']))));
		$dateto = mysqli_real_escape_string($db, date('Y-m-d', strtotime(str_replace('-','/',$_POST['dateto']))));
		$reason = mysqli_real_escape_string($db, $_POST['reason']);

		//if (empty($username)) {
		//	array_push($errors, "Username is required");
		//}
		//if (empty($password)) {
		//	array_push($errors, "Password is required");
		//}

		//if (count($errors) == 0) {
			$query = "INSERT INTO applications (username, datefrom, dateto,reason) 
					  VALUES('$username', '$datefrom', '$dateto','$reason')";
			$results = mysqli_query($db, $query);

			
			header('location: index.php');
			}
		//}
	



?>
<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if(isset($_POST['login_button'])) {
		$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

		$_SESSION['log_email'] = $email; //Store email into seesion variable
		$password = md5($_POST['log_password']); //Get password

		$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
		$check_login_query = mysqli_num_rows($check_database_query); //check results made, 1 or 0

		if($check_login_query  == 1) {
			$row = mysqli_fetch_array($check_database_query); //access the results from query
			$username = $row ['username'];
			
			$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = 'email' AND user_closed = 'yes'");
			if(mysqli_num_rows[$user_closed_query] == 1) {
				$reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email'");
			}

			$_SESSION['username'] = $username;
			header("Location: index.php");
			exit();
		}
		
		else{
			array_push($error_array, "email or password was incorrct<br>");
		}
	}

?>
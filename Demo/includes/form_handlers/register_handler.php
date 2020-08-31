<?php

//Declaring variables to prevent errors
$fname = "";//First name
$lname = "";//Last name
$em = "";//email
$em2 = "";//confirm email
$password = "";//password
$password2 = "";//password2
$date = "";//sign up date
$error_array = array();//Holds error messages

if(isset($_POST['register_button'])){

	//registration firm vales+

	//first name
	$fname = strip_tags($_POST['reg_fname']);//remove html tags
	$fname = str_replace(' ', '', $fname);//remove spaces
	$fname = ucfirst(strtolower($fname));//uppercase fist letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//last name
	$lname = strip_tags($_POST['reg_lname']);//remove html tags
	$lname = str_replace(' ', '', $lname);//remove spaces
	$lname = ucfirst(strtolower($lname));//uppercase fist letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//email
	$em = strip_tags($_POST['reg_email']);//remove html tags
	$em = str_replace(' ', '', $em);//remove spaces
	$em = ucfirst(strtolower($em));//uppercase fist letter
	$_SESSION['reg_email'] = $em; //Stores email name into session variable

	//email2
	$em2 = strip_tags($_POST['reg_email2']);//remove html tags
	$em2 = str_replace(' ', '', $em2);//remove spaces
	$em2 = ucfirst(strtolower($em2));//uppercase fist letter
	$_SESSION['reg_email2'] = $em2; //Stores email2 name into session variable

	$password = strip_tags($_POST['reg_password']);//remove html tags
	$password2 = strip_tags($_POST['reg_password2']);//remove html tags

	$date = date("Y-m-d"); //gets current date


	if($em == $em2) {
		//check if email is in vaild format
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//check if email already exsits
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");

			//count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "email already in use<br>");
			}
		}
		else {
			array_push($error_array, "Invaild email format<br>");
		}
	}
	else {
		array_push($error_array, "emails dont match<br>");
	}

	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 charavtors<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array, "Your last name must be between 2 and 25 charavtors<br>");
	}

	if($password != $password2) {
		array_push($error_array, "your passwords do not match<br>");
	}

	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "your password must be between 5 and 30 characters<br>");
	}

	if(empty($error_array)) {
		$password = md5($password); //encrypt password before sending to database

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");

		$i = 0;
		//if username exsits add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //add 1 to i
			$username = username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
		}

		//Profile picture assignment
		$rand = rand(1, 2); //random number between 1 and 2

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/default_pic.jpg";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/.jpg";

		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style = 'color: #14C800';'>you're all set! go ahead and login!</span><br>");

		//clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
}
?>
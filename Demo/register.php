<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to kirstys site!</title>
	<link rel = "stylesheet" type = "text/css" href = "assets/css/register_style.css">
	<script scr = <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script scr = "assets/js/register.js"></script>
</head>
<body>
<?php 
for($i = 0; $i < count($error_array); $i++){
		echo $error_array[$i];
	}
?>
	<div class = "wrapper">
		<div class = "login_box">
			<div class = "login_header">
				<h1>Scrollfeed</h1>
				login or sign up below

			</div>

				<form action = "register.php" method = "POST">
					<input type = "email" name = "log_email" placeholder = "Email Address" value="<?php 
					if(isset($_SESSION['log_email'])) {
						echo $_SESSION['log_email'];
					} 
					?>" required>
					<br>
					<input type = "password" name = "log_password" placeholder = "Password">
					<br>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href = "" id = "signup" class = "signup">Need an account? Register here!</a>

				</form>

				<form action="register.php" method="POST">
					<input type = "text" name = "reg_fname" placeholder= "First Name" value = "<?php 
					if(isset($_SESSION['reg_fname'])) {
						echo $_SESSION['reg_fname'];
					}?>" required>
					<br>

					<input type = "text" name = "reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])) {
						echo $_SESSION['reg_lname'];
					} 
					?>" required>
					<br>

					<input type = "email" name = "reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])) {
						echo $_SESSION['reg_email'];
					} 
					?>" required>
					<br>
					<input type = "email" name = "reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])) {
						echo $_SESSION['reg_email2'];
					} 
					?>"required>
					<br>
					<input type = "password" name = "reg_password" placeholder="Confirm Password" required>
					<br>
					<input type = "password" name = "reg_password2" placeholder="Confirm Password" required>
					<br>
					<input type = "submit" name = "register_button" value = "Register">
					<br>

					<?php if(in_array("<span style = 'color: #14C800';'>you're all set! go ahead and login!</span><br>", $error_array)) echo "<span style = 'color: #14C800';'>you're all set! go ahead and login!</span><br>"; ?>
					<a href = "" id = "signup" class = "signup">Already have an account? Sign in here!</a>
					</form>
					
			
		</div>
	</div>

</body>
</html>
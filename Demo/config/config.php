<?php  
ob_start(); //turns on output buffering
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "root", "", "social"); //connection variable

if(mysqli_connect_errno())
{
	echo "failed to connect: " . mysqli_connect_errno();
}

?>
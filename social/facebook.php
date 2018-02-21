<?php
$servername = "localhost";
$username = "cryptokl_user";
$password = "F%hd&F36*cnhJt";
$dbname = "cryptokl_main";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
session_start();
//Storing user data into session
$_SESSION['email'] = $_POST['email'];
$selectData = "select * from user where email='".$_POST["email"]."'";
$exquery = mysqli_query($conn, $selectData);
$count = mysqli_num_rows($exquery);
$Rquery = mysqli_fetch_assoc($exquery);
if($count == 0) {
	$sql1="INSERT INTO user(email,active,login_type) VALUES ('$_POST[email]', 'Active', 'facebook')";
	mysqli_query($conn,$sql1);
}
if(isset($_SESSION)) {
	echo 1;
}
?>

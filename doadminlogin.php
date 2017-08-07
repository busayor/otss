<?php
include '../config/config.php';
session_start();

@$password = mysql_real_escape_string($_POST['password']);
@$username = mysql_real_escape_string($_POST['username']);
//$username = base64_decode(base64_decode(base64_decode($_GET['username'])));

//echo $username;
/*
if(password_verify($password, $hashed_password)) {
    // If the password inputs matched the hashed password in the database
    // Do something, you know... log them in.
} */

$result = mysql_query("SELECT * FROM manageadmin WHERE username = '$username' and password = '$password'");

if(mysql_num_rows($result) > 0):
$row111 = mysql_fetch_array($result);

	
		$_SESSION['signed_in'] = true;
		$_SESSION['username'] 	= $row111['username'];
		
		if($row111['role'] == 1):
			$encryptuser = base64_encode(base64_encode(base64_encode($row111['username'])));
			header('location:admindefault.php?page=null&username='.$encryptuser);
		else:
			$encryptuser = base64_encode(base64_encode(base64_encode($row111['username'])));
			header('location:sadmindefault.php?page=null&username='.$encryptuser);
		endif;
	else:
	echo 
		'<script type="text/javascript">
			alert("Invalid username and/or password.Please try again.")
			window.location="login.php"
		</SCRIPT>';
endif;

?>
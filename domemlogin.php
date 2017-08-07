<?php
include 'config/config.php';
session_start();

//@$password = mysql_real_escape_string($_POST['password']);
@$username = mysql_real_escape_string($_POST['matnum']);
//$username = base64_decode(base64_decode(base64_decode($_GET['username'])));

//echo $username;
$result = mysql_query("SELECT * FROM manageuser WHERE matricnum = '$username' or email = '$username'");

if(mysql_num_rows($result) > 0):
$row111 = mysql_fetch_array($result);

	
		$_SESSION['signed_in'] = true;
		//$_SESSION['username'] 	= $row111['username'];
		$_SESSION['fullname'] 	= $row111['fullname'];
		$_SESSION['email'] = $row111['email'];
		
		$set_last_activity = mysql_query("UPDATE `manageuser` SET `last_activity` = now()");
		
						$encryptuser = base64_encode(base64_encode(base64_encode($row111['email'])));
						header('location:clientarea/clientdefault.php?page=null&username='.$encryptuser);
					//endif;
	else:
	echo 
		'<script type="text/javascript">
			alert("Invalid username and/or password.Please try again.")
			window.location="home.php"
		</SCRIPT>';
endif;

?>
<?php
include 'config/config.php';
session_start();


@$fullname = mysql_real_escape_string($_POST['fullname']);
@$email = mysql_real_escape_string($_POST['email']);
@$phone = mysql_real_escape_string($_POST['phone']);
$matricnum = 'YCT'.str_pad(mt_rand(0, 1000000), 6, '0', STR_PAD_LEFT);

$result1 = mysql_query("SELECT * FROM manageuser WHERE email = '$email' ");
if(mysql_num_rows($result1) > 0):////result1
	echo '<script type=text/javascript>
	alert("A USER ALREADY EXISTS WITH THIS EMAIL,PLEASE USE ANOTHER")
	window.location = "errorPage.php"
	</script>';		
else:

	mysql_query("INSERT into manageuser(m_id,matricnum,fullname,email,phone,last_activity)
	VALUES('','$matricnum','$fullname','$email','$phone',now())");
	
	$encryptuser = base64_encode(base64_encode(base64_encode($email)));
	echo 
				'<script type="text/javascript">
				alert("YOU HAVE CREATED A NEW PROFILE\n\nYour login details is:'.$email.'Thank you.")
				window.location="clientarea/clientdefault.php?page=null&username='.$encryptuser.'"
				</SCRIPT>';
	//header('location:clientarea/clientdefault.php?page=null&username='.$encryptuser);

endif;

?>
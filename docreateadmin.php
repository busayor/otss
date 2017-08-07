<?php
	include '../config/config.php';

$email = mysql_real_escape_string($_POST['email']);
$password = mysql_real_escape_string($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = mysql_real_escape_string($_POST['role']);
$category = $_POST['category'];

		if(isset($_POST['submit'])):
			$check_admin = mysql_query("SELECT * FROM manageadmin where username = '$email'");
			if(mysql_num_rows($check_admin) < 1):
		
	  			mysql_query("INSERT into manageadmin (a_id,username,password,date_reg,role,c_id) 
	   			VALUES ('','$email','$hashed_password',now(),'$role','$category')");		
			
				echo mysql_error();
				$encryptuser = base64_encode(base64_encode(base64_encode($email)));
				echo 
					'<script type="text/javascript">
					alert("YOU HAVE SUCCESSFULLY CREATED A NEW ADMINISTRATOR\n\nThank you.")
					window.location="sadmindefault.php?page=null&username='.$encryptuser.'"
					</SCRIPT>';
			else:
				echo 
					'<script type="text/javascript">
					alert("An admin with same email address allready exists.")
					window.location = "errorPage.php"
					</SCRIPT>';
			endif;
	   
	   		//$encryptuser = base64_encode(base64_encode(base64_encode($adminid)));
			//header('location:adminhome.php?page=null&username='.$encryptuser);
	else:
	
	echo 
				'<script type="text/javascript">
				alert("Some fields are missing, please check and correct!.")
				window.location = "errorPage.php"
				</SCRIPT>';
	endif;
	
?>
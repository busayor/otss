<?php
	include '../config/config.php';

$username = mysql_real_escape_string($_POST['username']);
$ticket_code = $_POST['ticket_code'];
$status = $_POST['status'];

		if ($ticket_code != ''):
		
	   $updateres = mysql_query("UPDATE `ticket` SET status = '$status' where ticket_code =  '$ticket_code'");
			
			//mysql_query("INSERT into response (t_id,email,c_id,p_id,subject,message,date_posted,status,ticket_code) 
	   		//VALUES ('','$email','$category','$priority','$subject','$message',NOW(),0,'$ticket_code')");
			
			
			echo mysql_error();
			$encryptuser = base64_encode(base64_encode(base64_encode($username)));
			echo 
				'<script type="text/javascript">
				alert("YOU HAVE SUCCESSFULLY CHANGED THE STATUS OF TICKET:'. ($ticket_code).'\n\nThank you.")
				window.location="admindefault.php?page=null&username='.$encryptuser.'"
				</SCRIPT>';
	   
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
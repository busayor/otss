<?php
	include '../config/config.php';

$email = mysql_real_escape_string($_POST['email']);
$username = mysql_real_escape_string($_POST['username']);
$getaid =mysql_query("select a_id from manageadmin where username = '$username'") or die ("database error!");
if(mysql_num_rows($getaid) > 0):
$res_getaid = mysql_fetch_array($getaid);
$a_id = $res_getaid['a_id'];
endif;

$ticket_code = $_POST['ticket_code'];
$userreply = $_POST['userreply'];
$response = mysql_real_escape_string($_POST['response']);

		if ($email != ''):
		
	   $updateres = mysql_query("UPDATE `ticket` SET `response` = '$response',a_id = '$a_id', 
	   date_updated = now(), userreply = '$userreply', status = 1 where ticket_code =  '$ticket_code'");
			
			//mysql_query("INSERT into response (t_id,email,c_id,p_id,subject,message,date_posted,status,ticket_code) 
	   		//VALUES ('','$email','$category','$priority','$subject','$message',NOW(),0,'$ticket_code')");
			
			
			echo mysql_error();
			$encryptuser = base64_encode(base64_encode(base64_encode($username)));
			echo 
				'<script type="text/javascript">
				alert("YOU HAVE SUCCESSFULLY UPDATED TICKET:'.($ticket_code).'\n\nThank you.")
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
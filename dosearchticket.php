<?php
	include '../config/config.php';
	
	
@$email = $_POST['adminid'];
$search = mysql_real_escape_string($_POST['search']);

$getuser_info =mysql_query("select * from manageadmin where adminid = '$adminid'") or die ("database error!");
if(mysql_num_rows($getuser_info) > 0):
$res_getuser_info = mysql_fetch_array($getuser_info);
//echo $res_chkdownline;
endif;

$email = mysql_real_escape_string($_POST['email']);
$category = $_POST['category'];
$priority = mysql_real_escape_string($_POST['priority']);
$subject = mysql_real_escape_string($_POST['subject']);
$message = mysql_real_escape_string($_POST['message']);
$username = mysql_real_escape_string($_POST['email']);
$ticket_code = '#'.str_pad(mt_rand(0, 100000000), 6, '0', STR_PAD_LEFT);

		if (($subject != '') && ($message != '') && ($category != '')):
		
	   		mysql_query("INSERT into ticket (t_id,email,c_id,p_id,subject,message,date_posted,status,ticket_code) 
	   		VALUES ('','$email','$category','$priority','$subject','$message',NOW(),0,'$ticket_code')");
			
			
			echo mysql_error();
			$encryptuser = base64_encode(base64_encode(base64_encode($email)));
			echo 
				'<script type="text/javascript">
				alert("YOU HAVE SUCCESSFULLY CREATED A NEW TICKET\n\nYour ticket ID is:'.$ticket_code.'\n\nYou can check the status of this ticket at anytime by using this ticket ID to search from your dashboard.\n\nThank you.")
				window.location="clientdefault.php?page=null&username='.$encryptuser.'"
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
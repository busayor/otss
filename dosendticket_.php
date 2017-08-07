<?php
include '../config/config.php';

$ticket_code = 'TC'.str_pad(mt_rand(0, 100000000), 6, '0', STR_PAD_LEFT);
$email = mysql_real_escape_string($_POST['email']);
$category = $_POST['category'];
$priority = mysql_real_escape_string($_POST['priority']);
$subject = mysql_real_escape_string($_POST['subject']);
$message = mysql_real_escape_string($_POST['message']);
$username = mysql_real_escape_string($_POST['email']);
$encryptuser = base64_encode(base64_encode(base64_encode($email)));
$newfilename = 'NULL';
if (($subject != '') && ($message != '') && ($category != '')):///////////check required fields
	if(isset($_POST['draft'])):////////////save ticket as draft
		include 'fileupload.php';
		
		mysql_query("INSERT into ticket (t_id,email,c_id,p_id,subject,message,date_posted,status,ticket_code,file,draft) 
	   	VALUES ('','$email','$category','$priority','$subject','$message',NOW(),0,'$ticket_code','$newfilename',1)");
		
		//echo mysql_error();
			//header('location:clientdefault.php?page=null&username='.$encryptuser);
		?>
			<script type='text/javascript'>
			alert('YOUR TICKET HAS BEEN CREATED AS A DRAFT\n\nYour ticket ID is:<?php echo $ticket_code; ?>')
			</script>
			<?php			
	elseif(isset($_POST['submit'])):////////////submit ticket
		include 'fileupload.php';
				
	   	mysql_query("INSERT into ticket (t_id,email,c_id,p_id,subject,message,date_posted,status,ticket_code,file,draft) 
	   	VALUES ('','$email','$category','$priority','$subject','$message',NOW(),0,'$ticket_code','$newfilename',0)");
		
		echo mysql_error();
		echo 
		'<script type="text/javascript">
		alert("YOU HAVE SUCCESSFULLY CREATED A NEW TICKET\n\nYour ticket ID is:'.$ticket_code.'\n\n
		You can check the status of this ticket at anytime by using this ticket ID to search from your dashboard.
		\n\nPlease note that tickets are attended to Mon - Fri (8AM - 4PM) Thank you.")
		window.location="clientdefault.php?page=null&username='.$encryptuser.'"
		</script>';
	endif;
else:
	echo 
		'<script type="text/javascript">
		alert("Some fields are missing, please check and correct!.")
		window.location = "errorPage.php"
		</SCRIPT>';
endif;
	
?>
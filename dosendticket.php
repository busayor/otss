<?php
	include '../config/config.php';
	
///////////////////////////////FILE UPLOAD AND RENAME/////////////////////////////////////
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.doc','.docx','.rtf','.pdf', '.jpg', '.png');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
	{	
		// Rename file
		$ticket_code = 'TC'.str_pad(mt_rand(0, 100000000), 6, '0', STR_PAD_LEFT);
		$newfilename = $ticket_code . $file_ext;
		//$newfilename = md5($file_basename) . $file_ext;
		if (file_exists("upload/" . $newfilename))
		{
			// file already exists error
			//echo "You have already uploaded this file.";
			echo 
				'<script type="text/javascript">
				alert("You have already uploaded this file.")
				window.location = "errorPage.php"
				</SCRIPT>';
		}
		else
		{		
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $newfilename);
			//echo "File uploaded successfully.";		
		}
	}
	/*elseif (empty($file_basename))
	{	
		// file selection error
		//echo "Please select a file to upload.";
		echo 
				'<script type="text/javascript">
				alert("Please select a file to upload")
				window.location = "errorPage.php"
				</SCRIPT>';
	} */
	elseif ($filesize > 200000)
	{	
		// file size error
		//echo "The file you are trying to upload is too large.";
		echo 
				'<script type="text/javascript">
				alert("The file you are trying to upload is too large.")
				window.location = "errorPage.php"
				</SCRIPT>';
	}
	else
	{
		// file type error
		//echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
		//unlink($_FILES["file"]["tmp_name"]);
		
		echo 
				'<script type="text/javascript">
				alert("Only these file types are allowed for upload: "'; echo implode(', ',$allowed_file_types); ')
				window.location = "errorPage.php"
				</SCRIPT>';
				//unlink($_FILES["file"]["tmp_name"]);
	}
///////////////////////////////FILE UPLOAD AND RENAME/////////////////////////////////////	
	

$email = mysql_real_escape_string($_POST['email']);
$category = $_POST['category'];
$priority = mysql_real_escape_string($_POST['priority']);
$subject = mysql_real_escape_string($_POST['subject']);
$message = mysql_real_escape_string($_POST['message']);
$username = mysql_real_escape_string($_POST['email']);
//$ticket_code = 'TC'.str_pad(mt_rand(0, 100000000), 6, '0', STR_PAD_LEFT);

		if (($subject != '') && ($message != '') && ($category != '')):
		
	   		mysql_query("INSERT into ticket (t_id,email,c_id,p_id,subject,message,date_posted,status,ticket_code,file) 
	   		VALUES ('','$email','$category','$priority','$subject','$message',NOW(),0,'$ticket_code','$newfilename' )");
			
			
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
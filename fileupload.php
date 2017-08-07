<?php


///////////////////////////////FILE UPLOAD AND RENAME/////////////////////////////////////
	$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	$allowed_file_types = array('.doc','.docx','.rtf','.pdf', '.jpg', '.png');	

	if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
	{	
		// Rename file
		
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
?>
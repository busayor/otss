<?php
	include '../config/config.php';

$email = mysql_real_escape_string($_POST['email']);
$oldcat = $_POST['oldcat'];
$newcat = $_POST['newcat'];
$adminid = $_POST['adminid'];

$get_cat = mysql_query("SELECT cat_name FROM category where c_id = '$oldcat'");
if(mysql_num_rows($get_cat) > 0):
$res_getRole = mysql_fetch_array($get_cat);
endif;

$get_cat1 = mysql_query("SELECT cat_name FROM category where c_id = '$newcat'");
if(mysql_num_rows($get_cat1) > 0):
$res_getRole1 = mysql_fetch_array($get_cat1);
endif;

		//echo $res_getRole['cat_name'].'<br><br>'.$res_getRole1['cat_name'];
		
		if ($email != ''):
			//$check_cat = mysql_query("SELECT * FROM manageadmin where c_id = '$oldcat'");
			if($res_getRole['cat_name'] != $res_getRole1['cat_name']):
		
	   		$updateres = mysql_query("UPDATE `manageadmin` SET c_id = '$newcat' where username =  '$email'");
			
			mysql_query("INSERT into changelog (l_id,oldcat,newcat,change_by,change_for,date_changed) 
	   		VALUES ('','$oldcat','$newcat','$adminid','$email',NOW())");
			
			
			echo mysql_error();
			$encryptuser = base64_encode(base64_encode(base64_encode($adminid)));
			echo 
				'<script type="text/javascript">
				alert("YOU HAVE SUCCESSFULLY CHANGED THE DEPARTMENT OF ADMIN 
				:'. ($email).'From '.$res_getRole['cat_name']. ' to '.$res_getRole1['cat_name'].'\n\nThank you.")
				window.location="admindefault.php?page=null&username='.$encryptuser.'"
				</SCRIPT>';
			else:
				echo 
					'<script type="text/javascript">
					alert("The department you selected is different from the current Admins department")
					window.location = "errorPage.php"
					</SCRIPT>';
			endif;
	else:
	
	echo 
				'<script type="text/javascript">
				alert("Admin email can not be left empty!")
				window.location = "errorPage.php"
				</SCRIPT>';
	endif;
	
?>
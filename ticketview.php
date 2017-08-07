<!--Form Validation goes here-->
        <script type="text/javascript">
   <!--
      // Form validation code will come here.
      function validate()
      {
         if( document.myForm.search.value == "" )
         {
            alert( "Please enter a search criteria" );
            document.myForm.search.focus() ;
            return false;
         }
         return( true );
      }
   //-->
</script>
<?php
// database connection info
$conn = mysql_connect('localhost','root','') or trigger_error("SQL", E_USER_ERROR);
$db = mysql_select_db('helpdesk',$conn) or trigger_error("SQL", E_USER_ERROR);


//$conn = mysql_connect('localhost','binietbi_myUserD','ipwTUu,-,hdC') or trigger_error("SQL", E_USER_ERROR);
//$db = mysql_select_db('binietbi_myDB',$conn) or trigger_error("SQL", E_USER_ERROR);

// find out how many rows are in the table 
$sql = "SELECT COUNT(*) FROM ticket";
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$nummem = mysql_num_rows($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 10;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 
$sql = "SELECT * FROM ticket LIMIT $offset, $rowsperpage";
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
echo '<form name="myForm" method="post" action="dosearch.php" class="" onsubmit="return(validate());">
  <label for="textfield"></label>
  <input type="text" name="search" id="search" placeholder="Seach for member">
  <input type="hidden" name="adminid" id="adminid" value="'.$username.'">
  <input type="submit" name="button" id="button" value="Search"> <br>
</form><br>';include 'totalTickets.php';
echo '<br><table class="table table-bordered">
		<tr>
          <th>Ticket ID</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Date Submitted</th>
          <th>Status</th>
          <th>Action</th>
        </tr>';	
	
// while there are rows to be fetched...
while ($list = mysql_fetch_assoc($result)) {
   // echo data
   //echo $list['u_code'] . " : " . $list['email'] . "<br />";
  	echo '<tr>';
		echo '<td>'; echo $list['ticket_code']; echo '</td>';
		echo '<td>'; echo $list['email']; echo '</td>';
		echo '<td>'; echo $list['subject']; echo '</td>';
		echo '<td>'; echo $list['date_posted']; echo '</td>';
		echo '<td>'; if($list['status'] == 0):
                        echo 'PENDING';
                    elseif($list['status'] == 1):
						echo 'OPEN';
					else:
						echo 'COMPLETED';
					endif;
		
		 echo '</td>';
		echo '<td> <a href="memberinfo.php?username='.base64_encode(base64_encode(base64_encode($list['email']))).'" target="_blank">View Ticket</a></td>';
	echo '</tr>';
} // end while
echo '</table>';
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1.$username'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage.$username'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
		 echo '<a href="viewticket.php?currentpage='.$x.'&username='.base64_encode(base64_encode(base64_encode($username))).'" target="_blank">';
		 			echo ' '.$x;
		 echo 	   '</a>';
        // echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x&username=base64_encode(base64_encode(base64_encode($adminid)))'>$x</a> ";
      } // end else
   } // end if 
} // end for
                 
// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
	echo '<a href="viewticket.php?currentpage='.$nextpage.'&username='.base64_encode(base64_encode(base64_encode($username))).'">';
		 			echo ' >';
	echo 	   '</a>';
   //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo '<a href="viewticket.php?currentpage='.$totalpages.'&username='.base64_encode(base64_encode(base64_encode($username))).'">';
		 			echo ' >>';
	echo 	   '</a>';
   //echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
?>
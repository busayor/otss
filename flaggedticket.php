<?php
	include '../config/config.php';
@$username = base64_decode(base64_decode(base64_decode($_GET['username'])));

$getRole =mysql_query("select * from manageadmin where username = '$username'") or die ("database error!");
if(mysql_num_rows($getRole) > 0):
$res_getRole = mysql_fetch_array($getRole);
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>YABATECH HELPDESK - complaints | queries | info</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
 	<script>//tinymce.init({ selector:'textarea' });</script>

	<!--ckeditor------------------->
    <script src="../ckeditor/ckeditor/ckeditor.js"></script>
	<script src="../ckeditor/ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="../ckeditor/ckeditor/samples/css/samples.css">
	<link rel="stylesheet" href="../ckeditor/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <!--ckeditor------------------->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        	<?php include 'sidebar.php';?>
        <!-- Navigation -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard -- <?php 
					$getCat =mysql_query("select cat_name from category where c_id = '$res_getRole[c_id]'") or die ("database error!");
					if(mysql_num_rows($getCat) > 0):
					$res_getCat = mysql_fetch_array($getCat);
					endif;
					echo $res_getCat['cat_name'].' Tickets';?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php include 'boxes.php';?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-11">
                    <div class="panel-heading">
                            <i class="fa fa-search"></i> Search result
                            <form role="form" action="searchresult_.php" method="post">
                            <div class="input-group custom-search-form">
                                <input type="text" name="search" class="form-control" placeholder="Search Ticket...">
                                <input type="hidden" name="email" value="<?php echo $res_getuser_info['email'];?>" />
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            </form>
                            <table class="table table-bordered">
                                        <tr>
                                            <th>Ticket ID</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Date Submitted</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <?php 
                                            @$getres= mysql_query("select * from ticket where c_id = $res_getRole[c_id]");
                                            
                                            if(@mysql_num_rows($getres) < 1):
                                                echo '<br>OOPS, NO RESULT FOUND!<br><br>';
                                            else:
                                            
                                            while (@$res_getres = mysql_fetch_array($getres)){
                                                //@$sum = $sum + 1;
                                            ?>
                                            <td><?php echo $res_getres['ticket_code'];?></td>
                                            <td><?php echo $res_getres['email'];?></td>
                                            <td><?php echo $res_getres['subject'];?></td>
                                            <td><?php echo $res_getres['date_posted'];?></td>
                                            <td><?php if($res_getres['status'] == 0):
                                                        echo 'PENDING';
                                                      elseif($res_getres['status'] == 1):
														echo 'OPEN';
													  else:
													  	echo 'COMPLETED';
													  endif;
                                            ;?></td>
                                            <?php
                                                $ticket_code = $res_getres['ticket_code'];
                                                $username1 = base64_encode(base64_encode(base64_encode($username)));
                                            ?>
                         <td><a href="viewticket.php?ticket_code=<?php echo $ticket_code;?>&username=<?php echo $username1;?>">View</a> | <a href="flagticket.php?ticket_code=<?php echo $ticket_code;?>&username=<?php echo $username1;?>">Flag</a> | <a href="pushticket.php?ticket_code=<?php echo $ticket_code;?>&username=<?php echo $username1;?>">Push</a></td>
                                        </tr>
                                       <?php } endif;?>
                                    </table>
                        </div>
                </div>
                <!-- /.col-lg-8 -->
               
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
<script>
	initSample();
</script>
</body>

</html>

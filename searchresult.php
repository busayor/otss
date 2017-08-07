<?php
	include '../config/config.php';
	//$search = mysql_real_escape_string($_POST['search']);
	//$email = $_POST['email'];
	$email = base64_decode(base64_decode(base64_decode($_GET['username'])));
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



	<!--ckeditor------------------->
    <script src="../ckeditor/ckeditor/ckeditor.js"></script>
	<script src="../ckeditor/ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="../ckeditor/ckeditor/samples/css/samples.css">
	<link rel="stylesheet" href="../ckeditor/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <!--ckeditor------------------->
    
    	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/598310dbd1385b2b2e285665/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        	<?php include 'sidebar.php';?>
        <!-- Navigation -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php include 'boxes.php';?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
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
											@$getres= mysql_query("select * from ticket where email = '$email'");
											
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
												$email = base64_encode(base64_encode(base64_encode($res_getres['email'])));
											?>
                         <td><a href="viewticket.php?ticket_code=<?php echo $ticket_code;?>&username=<?php echo $email;?>">View Ticket</a></td>
                                        </tr>
                                       <?php } endif;?>
                                    </table>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div id="morris-area-chart"></div>-->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
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

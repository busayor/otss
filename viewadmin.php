<?php
	include '../config/config.php';
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
  

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        	<?php include 'ssidebar.php';?>
        <!-- Navigation -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <?php include 'sboxes.php';?>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> View Administrators
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	 <table class="table table-bordered">
                                        <tr>
                                            <th>Email</th>
                                            <th>Date Created</th>
                                            <th>Date Submitted</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <?php 
											@$getres= mysql_query("select * from manageadmin");
											
											if(@mysql_num_rows($getres) < 1):
												echo '<br>OOPS, NO RESULT FOUND!<br><br>';
											else:
											
											while (@$res_getres = mysql_fetch_array($getres)){
												//@$sum = $sum + 1;
											?>
                                            <td><?php echo $res_getres['username'];?></td>
                                            <td><?php echo $res_getres['date_reg'];?></td>
                                            <td><?php if($res_getres['role'] == 1):
													echo 'ADMIN';
													else:
														echo 'SUPER ADMIN';
													endif;
											?></td>
                                            <td><?php $res_getres['c_id'];
												@$getcat= mysql_query("select cat_name from category where c_id = '$res_getres[c_id]'");
												if(mysql_num_rows($getcat) > 0):
													$res_getcat = mysql_fetch_array($getcat);
													echo $res_getcat['cat_name'];
												endif;
											?></td>
                                            <td>Change Dept | Change Role | Edit Admin | Delete</td>
                                        </tr>
                                       <?php } endif;?>
                                    </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications Panel
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                            
                            
                            
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
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

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
                            <i class="fa fa-exchange"></i> Change Admin Category
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <form action="dochangeadmincat.php" method="post">
                        <div class="form-group">
                                            <label>email</label>
                                            <input name="email" class="form-control" type="text">
                                            <input name="adminid" class="form-control" type="hidden" value="<?php echo $username;?>">
                                            <p class="help-block">New administrator's email</p>
                              </div>
                               <div class="form-group">
                                           <label>old department</label>
                    						<select name="oldcat" id="oldcat" class="form-control">
                                             <?php
				$check = "SELECT * FROM category where active = 1";
				$result_cat = mysql_query($check);
				while ($list = mysql_fetch_array($result_cat)) 
					{
						$c_id = $list['c_id'];
						$cat_name = $list['cat_name'];
						print("<option value='$c_id'>". strtoupper($cat_name)."</option>\n");
					}
			?>
                                            </select>
                                            <p class="help-block">Administrator's old department</p>
                              </div>
                              <div class="form-group">
                                           <label>new department</label>
                    						<select name="newcat" id="newcat" class="form-control">
                                             <?php
				$check = "SELECT * FROM category where active = 1";
				$result_cat = mysql_query($check);
				while ($list = mysql_fetch_array($result_cat)) 
					{
						$c_id = $list['c_id'];
						$cat_name = $list['cat_name'];
						print("<option value='$c_id'>". strtoupper($cat_name)."</option>\n");
					}
			?>
                                            </select>
                                            <p class="help-block">Administrator's new department</p>
                              </div>
                              <input id="Submit" name="submit" type="submit" class="btn btn-default" value="Change Admin Category" />
                        </form>
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

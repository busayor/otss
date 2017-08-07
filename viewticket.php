<?php
	include '../config/config.php';
@$username = base64_decode(base64_decode(base64_decode($_GET['username'])));
$ticket_code = $_GET['ticket_code'];

$getRole =mysql_query("select * from manageadmin where username = '$username'") or die ("database error!");
if(mysql_num_rows($getRole) > 0):
$res_getRole = mysql_fetch_array($getRole);
endif;

$gettc_info =mysql_query("select * from ticket where ticket_code = '$ticket_code'") or die ("database error!");
if(mysql_num_rows($gettc_info) > 0):
$res_gettc_info = mysql_fetch_array($gettc_info);
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
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle"></i> View Support Ticket - <?php echo $ticket_code;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div id="morris-area-chart"></div>-->
                            <form role="form" action="doupdateticket.php" method="post">
                                        <div class="form-group">
                                            <label>email</label>
                                            <input name="email" class="form-control" value="<?php echo $res_gettc_info['email'];?>" readonly>
                                            <input type="hidden" name="username" value="<?php echo $username;?>">
                                            <input type="hidden" name="ticket_code" value="<?php echo $ticket_code;?>">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>category/department</label>
                    <select name="category" id="category" class="form-control" disabled>
                    <option value=""><?php 
                            $getCat =mysql_query("select cat_name from category where c_id = '$res_gettc_info[c_id]'") or die ("database error!");
if(mysql_num_rows($getCat) > 0):
$res_getCat = mysql_fetch_array($getCat);
endif;
                    echo $res_getCat['cat_name'];
                    ;?></option>
          </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>priority</label>
                    <select name="priority" id="priority" class="form-control" disabled>
           <option value=""><?php 
                            $getPr =mysql_query("select priority from priority where p_id = '$res_gettc_info[p_id]'") or die ("database error!");
if(mysql_num_rows($getPr) > 0):
$res_getPr = mysql_fetch_array($getPr);
endif;
                    echo $res_getPr['priority'];
                    ;?></option>
          </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input name="subject" class="form-control" placeholder="Enter subject" value="<?php echo $res_gettc_info['subject'];?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>description of the problem</label>
                                            <textarea name="message" id="message" rows="5" cols="25"  class="form-control" readonly>
                                            <?php echo html_entity_decode($res_gettc_info['message']);?>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>respond to this ticket</label>
                                             <textarea name="response" id="response" rows="5" cols="25"  class="form-control">
                                            <?php //echo html_entity_decode($res_gettc_info['message']);?>
                                            </textarea>
                                        </div>
                                        
                                        <?php  if($res_gettc_info['file'] != ''):
										echo '<div class="form-group"><label>Uploaded file</label>
										<a href="../clientarea/upload/'; echo $res_gettc_info['file']; echo '"target="_blank"><img src="../clientarea/upload/'; echo $res_gettc_info['file']; echo'" width="50" height="50"></a><br>';										
                                        	
                                        echo '</div><p class="help-block">Click to view</p>'; endif;
										?>
                                        <div class="form-group">
                                            <label>Expect reply from client</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="userreply" id="optionsRadiosInline1" value="0" checked>NO
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="userreply" id="optionsRadiosInline2" value="1">YES
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Respond to ticket</button>
                                        <button type="submit" class="btn btn-default">Push ticket</button>
                                        <button type="reset" class="btn btn-default"><i class="fa fa-close">Close Ticket</i></button>
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

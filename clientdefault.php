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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
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
                            <i class="fa fa-plus-circle"></i> Create New Support Ticket
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!--<div id="morris-area-chart"></div>-->
                            <form role="form" action="dosendticket.php" method="post"  enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>email</label>
                                            <input name="email" class="form-control" value="<?php echo $res_getuser_info['email'];?>" readonly>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>category/department</label>
                    <select name="category" id="category" class="form-control">
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
                                            <p class="help-block">Please select the type of trouble you are having.</p>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>priority</label>
                    <select name="priority" id="priority" class="form-control">
            <?php
				$check_pr = "SELECT * FROM priority";
				$result_pr = mysql_query($check_pr);
				while ($list_pr = mysql_fetch_array($result_pr)) 
					{
						$p_id = $list_pr['p_id'];
						$priority = $list_pr['priority'];
						$color = $list_pr['color'];
						print("<option value='$p_id' style='background-color:$color; color:#FFF'>". strtoupper($priority)."</option>\n");
					}
			?>
          </select>
                                            <p class="help-block">Choose the importance of this ticket.</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>enter a subject for this ticket</label>
                                            <input name="subject" class="form-control" placeholder="Enter subject">
                                        </div>
                                        <div class="form-group">
                                            <label>description of the problem</label>
                                            <textarea name="message" id="message" rows="5" cols="25"  class="form-control">
            								</textarea>
            								<script>
                								//CKEDITOR.replace( 'message' );
            								</script>
                                        </div>
                                        <div class="form-group">
                                            <label>File input</label>
                                            <input id="file" name="file" type="file" />
                                           <!-- <input id="file" name="file[]" type="file" />
											<button type='button' class="add_more">Add More Files</button>-->
                                            <p class="help-block">Upload file to support your message. Allowed file types (.doc,.docx,.pdf,.jpg,.png)</p>
                                        </div>
                                        <input id="Submit" name="submit" type="submit" class="btn btn-default" value="Submit Ticket" />
                          			    <!--<input id="Submit" name="draft" type="submit" class="btn btn-default" value="Save as draft" /></i>
                                        <button type="submit" class="btn btn-default">Submit Ticket</button>
                                        <button type="submit" class="btn btn-default"><i class="fa fa-save">  Save as draft</i></button>-->
                                        <button type="reset" class="btn btn-default"><i class="fa fa-eraser">  Reset Ticket  </i></button>
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

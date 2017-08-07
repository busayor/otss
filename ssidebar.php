<?php 
include '../config/config.php';
@session_start();
@$username = base64_decode(base64_decode(base64_decode($_GET['username'])));

$getuser_info =mysql_query("select * from manageadmin where username = '$username'") or die ("database error!");
if(mysql_num_rows($getuser_info) > 0):
$res_getuser_info = mysql_fetch_array($getuser_info);
endif;
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../pages/index.html">HelpDesk 1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Hi!, <?php echo @$res_getuser_info['username'];?>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../pages/login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="sadmindefault.php?username=<?php echo base64_encode(base64_encode(base64_encode($username)));?>" ><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="sa_viewtickets.php?username=<?php echo base64_encode(base64_encode(base64_encode($username)));?>" ><i class="fa fa-user"></i> View Tickets</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Manage Admin<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="addadmincat.php?username=<?php echo base64_encode(base64_encode(base64_encode($username)));?>" >CreateAdmin</a>
                                </li>
                                <li>
                                    <a href="viewadmin.php?username=<?php echo base64_encode(base64_encode(base64_encode($username)));?>" >View Admins</a>
                                </li>
                                <li>
                                    <a href="changecat.php?username=<?php echo base64_encode(base64_encode(base64_encode($username)));?>" >Change Admin Department</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-flag-o"></i> Create Admin</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Categories<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Add Category</a>
                                </li>
                                <li>
                                    <a href="#">Delete Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
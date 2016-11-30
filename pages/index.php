<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CPMA - MIS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <script>
        function showHideMenu() {
            var div = document.getElementById("menuContainer");
            if (div.style.display !== "none") {
                div.style.display = "none";
            }
            else {
                div.style.display = "block";
            }
        }
    </script>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <img src=".././assets/header2.gif">


        </div>

        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" onclick="showHideMenu()" href="#">vertical Menu
                    <i class="fa fa-arrow-circle-down fa-fw"></i>
                </a>
                <!-- /.dropdown-vertical menu -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Read All Messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->


            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-tasks">
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 1</strong>
                                    <span class="pull-right text-muted">40% Complete</span>
                                </p>

                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 2</strong>
                                    <span class="pull-right text-muted">20% Complete</span>
                                </p>

                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 3</strong>
                                    <span class="pull-right text-muted">60% Complete</span>
                                </p>

                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                        <span class="sr-only">60% Complete (warning)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <p>
                                    <strong>Task 4</strong>
                                    <span class="pull-right text-muted">80% Complete</span>
                                </p>

                                <div class="progress progress-striped active">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Tasks</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-tasks -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
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
                    <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


        <div style="display:none;" class="navbar-default sidebar" id='menuContainer' role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="flot.php">Flot Charts</a>
                            </li>
                            <li>
                                <a href="morris.php">Morris.js Charts</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="tables.php"><i class="fa fa-table fa-fw"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.php"><i class="fa fa-edit fa-fw"></i> Forms</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.php">Panels and Wells</a>
                            </li>
                            <li>
                                <a href="buttons.php">Buttons</a>
                            </li>
                            <li>
                                <a href="notifications.php">Notifications</a>
                            </li>
                            <li>
                                <a href="typography.php">Typography</a>
                            </li>
                            <li>
                                <a href="icons.php"> Icons</a>
                            </li>
                            <li>
                                <a href="grid.php">Grid</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                                <!-- /.nav-third-level -->
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="blank.php">Blank Page</a>
                            </li>
                            <li>
                                <a href="login.php">Login Page</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->

        </div>

        <!-- /.navbar-static-side -->


    </nav>


    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12 breadcrumb-container">
                <!--Start bread crumbs -->
                <ol class="breadcrumb breadcrumb-arrow">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Activity Reports</a></li>
                    <li class="active"><span>MELA</span></li>
                </ol>
                <!--End bread crumbs -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-newspaper-o fa-fw"></i> MELA REPORT
                        <div class="pull-right"><a
                                class="btn btn-primary btn-indicator btnPrevious">Previous</a> <a
                                class="btn btn-primary btn-indicator btnNext">Next</a></div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped  fixed-columns">
                                        <thead>
                                        <tr>
                                            <th class="fixed-column" rowspan='3'>#</th>
                                            <th class="fixed-column" rowspan='3'>Indicator</th>
                                            <th class="fixed-column" rowspan='3'>Baseline</th>
                                            <th colspan='5'>FY1</th>
                                            <th colspan='5'>FY2</th>
                                            <th colspan='5'>FY3</th>
                                            <th colspan='5'>FY4</th>
                                            <th colspan='5'>FY5</th>
                                            <th colspan='5'>FY6</th>
                                        </tr>

                                        <tr>
                                            <th rowspan='2'>Target</th>
                                            <th colspan='3'>Actual</th>
                                            <th rowspan='2'>%</th>

                                            <th rowspan='2'>Target</th>
                                            <th colspan='3'>Actual</th>
                                            <th rowspan='2'>%</th>

                                            <th rowspan='2'>Target</th>
                                            <th colspan='3'>Actual</th>
                                            <th rowspan='2'>%</th>

                                            <th rowspan='2'>Target</th>
                                            <th colspan='3'>Actual</th>
                                            <th rowspan='2'>%</th>

                                            <th rowspan='2'>Target</th>
                                            <th colspan='3'>Actual</th>
                                            <th rowspan='2'>%</th>

                                            <th rowspan='2'>Target</th>
                                            <th colspan='3'>Actual</th>
                                            <th rowspan='2'>%</th>


                                        </tr>

                                        <tr>
                                            <th>Oct-Mar</th>
                                            <th>Apr-Sep</th>
                                            <th>Annual</th>

                                            <th>Oct-Mar</th>
                                            <th>Apr-Sep</th>
                                            <th>Annual</th>

                                            <th>Oct-Mar</th>
                                            <th>Apr-Sep</th>
                                            <th>Annual</th>

                                            <th>Oct-Mar</th>
                                            <th>Apr-Sep</th>
                                            <th>Annual</th>

                                            <th>Oct-Mar</th>
                                            <th>Apr-Sep</th>
                                            <th>Annual</th>

                                            <th>Oct-Mar</th>
                                            <th>Apr-Sep</th>
                                            <th>Annual</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="fixed-column"></td>
                                            <td class="fixed-column"></td>
                                            <td class="fixed-column">Purpose</td>
                                            <td colspan='42'>Sustainably increase the production
                                                and marketing of high
                                                quality maize, beans, and coffee in 34 focus districts.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fixed-column" rowspan="4">1</td>
                                            <td class="fixed-column">
                                                <div style="max-width: 130px;">Gross margin per unit of land, kilogram,
                                                    or animal
                                                    of selected product
                                                    (crop,animal,fisheries selection varies by country)
                                                </div>
                                            </td>
                                            <td class="fixed-column">326,000.00</td>

                                            <td>100,000,000</td>
                                            <td>200,000,000</td>
                                            <td>300,000,000</td>
                                            <td>400,000,000</td>
                                            <td>700%</td>

                                            <td>800,000,000</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12%</td>

                                            <td>13</td>
                                            <td>14</td>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19%</td>

                                            <td>20</td>
                                            <td>21</td>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26%</td>

                                            <td>27</td>
                                            <td>28</td>
                                            <td>31</td>
                                            <td>32</td>
                                            <td>33%</td>

                                            <td>34</td>
                                            <td>35</td>
                                            <td>38</td>
                                            <td>39</td>
                                            <td>40%</td>
                                        </tr>

                                        <tr>

                                            <td class="fixed-column" align="right">Coffee</td>
                                            <td class="fixed-column">P</td>
                                            <td>C-100,000,000</td>
                                            <td>C-200,000,000</td>
                                            <td>C-300,000,000</td>
                                            <td>C-400,000,000</td>
                                            <td>C-700%</td>

                                            <td>C-800,000,000</td>
                                            <td>C-9</td>
                                            <td>C-10</td>
                                            <td>C-11</td>
                                            <td>C-12%</td>

                                            <td>C-13</td>
                                            <td>C-14</td>
                                            <td>C-17</td>
                                            <td>C-18</td>
                                            <td>C-19%</td>

                                            <td>C-20</td>
                                            <td>C-21</td>
                                            <td>C-24</td>
                                            <td>C-25</td>
                                            <td>C-26%</td>

                                            <td>C-27</td>
                                            <td>C-28</td>
                                            <td>C-31</td>
                                            <td>C-32</td>
                                            <td>C-33%</td>

                                            <td>C-34</td>
                                            <td>C-35</td>
                                            <td>C-38</td>
                                            <td>C-39</td>
                                            <td>C-40%</td>
                                        </tr>

                                        <tr>
                                            <td class="fixed-column" align="right">Maize</td>
                                            <td class="fixed-column">P</td>
                                            <td>M-100,000,000</td>
                                            <td>M-200,000,000</td>
                                            <td>M-300,000,000</td>
                                            <td>M-400,000,000</td>
                                            <td>M-700%</td>

                                            <td>M-800,000,000</td>
                                            <td>M-9</td>
                                            <td>M-10</td>
                                            <td>M-11</td>
                                            <td>M-12%</td>

                                            <td>M-13</td>
                                            <td>M-14</td>
                                            <td>M-17</td>
                                            <td>M-18</td>
                                            <td>M-19%</td>

                                            <td>M-20</td>
                                            <td>M-21</td>
                                            <td>M-24</td>
                                            <td>M-25</td>
                                            <td>M-26%</td>

                                            <td>M-27</td>
                                            <td>M-28</td>
                                            <td>M-31</td>
                                            <td>M-32</td>
                                            <td>M-33%</td>

                                            <td>M-34</td>
                                            <td>M-35</td>
                                            <td>M-38</td>
                                            <td>M-39</td>
                                            <td>M-40%</td>
                                        </tr>

                                        <tr>
                                            <td class="fixed-column" align="right">Beans</td>
                                            <td class="fixed-column">P</td>
                                            <td>B-100,000,000</td>
                                            <td>B-200,000,000</td>
                                            <td>B-300,000,000</td>
                                            <td>B-400,000,000</td>
                                            <td>B-700%</td>

                                            <td>B-800,000,000</td>
                                            <td>B-9</td>
                                            <td>B-10</td>
                                            <td>B-11</td>
                                            <td>B-12%</td>

                                            <td>B-13</td>
                                            <td>B-14</td>
                                            <td>B-17</td>
                                            <td>B-18</td>
                                            <td>B-19%</td>

                                            <td>B-20</td>
                                            <td>B-21</td>
                                            <td>B-24</td>
                                            <td>B-25</td>
                                            <td>B-26%</td>

                                            <td>B-27</td>
                                            <td>B-28</td>
                                            <td>B-31</td>
                                            <td>B-32</td>
                                            <td>B-33%</td>

                                            <td>B-34</td>
                                            <td>B-35</td>
                                            <td>B-38</td>
                                            <td>B-39</td>
                                            <td>B-40%</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

            </div>
            <!-- /.col-lg-8 -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->


    <!--start of Footer-->
    <div align="center" class="row">
        <div class="col-xs-18 col-md-12">
            <footer>
                <div class="container">
                    <p>Developed by <a href="http://dcareug.com/" rel="author">Data Care (U)
                            Ltd</a>. &copy; <?php echo date('Y'); ?> Inspired By<a
                            href="http://dcareug.com/"
                            rel="external">The
                            Guy who makes things disappear</a> and <a href="#" rel="external">Data Care&rsquo;s PHP
                            Production
                            Line</a>.</p>
                </div>
            </footer>
        </div>
    </div>
    <!--end of Footer-->


</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="../js/table_fixedColumn.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>


</body>

</html>

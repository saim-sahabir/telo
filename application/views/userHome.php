<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tealo | Team Activity Watcher</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
        <!-- jQuery 3 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> 
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <!-- InputMask -->
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
        <!-- Sweet alert -->
        <script src="<?php echo base_url(); ?>assets/bower_components/sweetalert2/dist/sweetalert2.all.min.js"></script> 
        <!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <!-- <link href="<?php echo base_url(); ?>asset/plugins/iCheck/minimal/color-scheme.css" rel="stylesheet"> -->
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
        <!-- Favicon -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style type="text/css">
            .company_info{
                min-height: 41px;
                color: white !important;
                text-align: center;
                font-weight: bold;
            }
            .breadcrumb{
                padding: 0px 5px !important;
            }
            .btn-primary{
                background-color: #0c5889;
            }
            .form_question{
                font-size: 24px;
                color: #0c5889; 
                padding-top: 7px; 
            }
            .main-footer{
                padding: 10px !important;
            }
            .main-footer p{
                padding-top: 10px;
            }
            .left-sdide{
                float: left !important;
            }
            .navbar-nav > .user-menu > .dropdown-menu{
                width: 170px;
            }
            .box{
                border-top: 3px solid #0c5889;
            }
        </style>
        <script>
            jQuery(document).ready(function($) { 
                $('[data-mask]').inputmask()
                $(".delete").click(function(e){ 
/*                 swal({
                    title: "Are you sure?",
                    //text: "You will not be able to recover this imaginary file!",
                    //type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#0C5889",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        return true;    
                    } else {
                        return false;
                    }
                });*/
                    var job=confirm("Are you sure you want to delete?");
                    if(job==true){
                        return true;
                    }else{
                        return false;
                    }

                }); 

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                  checkboxClass: 'icheckbox_minimal-blue',
                  radioClass   : 'iradio_minimal-blue'
                })

 
                
            }); 
        </script>
    </head>
 

    <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
    <body class="hold-transition skin-blue sidebar-mini">
        <!--<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">-->
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">TAW</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/images/tealo_logo_white.png"></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </a> 

                    <div class="navbar-custom-menu left-sdide">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="<?php echo base_url(); ?>Activity/addEditActivity">
                                    <i class="fa fa-tasks"></i>
                                    <span class="hidden-xs">Add Activity</span>
                                </a> 
                            </li>  
                        </ul>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs">
                                        <?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name'); ?> - <?php if ($this->session->userdata('designation_id') == NULL) {
                                            echo "Admin";
                                        } else{
                                            echo getDesignationName($this->session->userdata('designation_id'));
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu"> 

                                    <!-- Menu Footer-->
                                    <li class="user-footer">  
                                            <a href="<?php echo base_url(); ?>Authentication/logOut" class="btn btn-default btn-flat">Logout</a> 
                                    </li>
                                </ul>
                            </li> 
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                      <div class="user-panel">
                        <div class="pull-left image">
                          <img src="<?php echo base_url();?>assets/images/avatar.jpg" class="img-circle" alt="User Image" style="height: 45px;">
                        </div>
                        <div class="pull-left info">
                          <p><?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name');?></p> 
                        </div>
                      </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li> 
                            <li>
                                <a href="<?php echo base_url(); ?>Authentication/userProfile"><i class="fa fa-home"></i> <span>Home</span></a>
                            </li> 
                            <?php if($this->session->userdata('designation_id') == NULL){?>
                            <li>
                                <a href="<?php echo base_url(); ?>Dashboard/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                            </li>
                            <?php } ?> 
                            <li>
                                <a href="<?php echo base_url(); ?>Activity/myActivities"><i class="fa fa-tasks"></i> <span>My Activities</span></a>
                            </li>  
                            <?php if($this->session->userdata('designation_id') == NULL){?>  
                            <li>
                                <a href="<?php echo base_url(); ?>Activity/allActivities"><i class="fa fa-tasks"></i> <span>Team Activities</span></a>
                            </li>   
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-file-text"></i> <span>Report</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url(); ?>Report/report"><i class="fa fa-circle-o"></i>Report Filter</a></li>   
                                </ul>
                            </li>  
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-database"></i> <span>Master</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url(); ?>Master/designations"><i class="fa fa-circle-o"></i>Designations</a></li> 
                                    <li><a href="<?php echo base_url(); ?>Master/projects"><i class="fa fa-circle-o"></i>Projects</a></li>  
                                </ul>
                            </li> 
                            <?php } ?> 
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>Account</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu"> 
                                    <li><a href="<?php echo base_url(); ?>Authentication/changePassword"><i class="fa fa-circle-o"></i>Change Password</a></li>
                                    <?php if($this->session->userdata('designation_id') == NULL){?>  
                                    <li><a href="<?php echo base_url(); ?>Authentication/updateOrganizationProfile"><i class="fa fa-circle-o"></i>Organization Profile</a></li>
                                    <?php } ?> 
                                    <?php if($this->session->userdata('designation_id') == NULL){?>  
                                    <li><a href="<?php echo base_url(); ?>User/users"><i class="fa fa-circle-o"></i>Team</a></li> 
                                    <?php } ?> 
                                    <li><a href="<?php echo base_url(); ?>Authentication/logOut"><i class="fa fa-circle-o"></i>Logout</a></li> 
                                </ul>
                            </li>   
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">  
                <!-- Main content -->
                 
                    <?php
                    if (isset($main_content)) {
                        echo $main_content;
                    }
                    ?> 
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">  
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <strong>Tealo</strong>, Team Activity Watcher by <a href="https://multidimensionsystems.com">Multidimension Systems</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                        <strong>Support:</strong> prnt.multisys@gmail.com
                    </div> 
                </div> 
            </footer> 
        </div>
        <!-- ./wrapper -->

        <!-- SlimScroll -->
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
    </body>
</html>

<?php
ob_start();
error_reporting(0);
include 'core/Session.php';
Session::init();
Session::checkSession();
include 'core/Database.php';
include'core/Format.php';
include 'class/Admin.php';
$fm = new Format();
$admin = new Admin();
$user_id = Session::get("user_id");

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/sfu.ico">
        <title>Dashboard | Stamford University Bangladesh</title>
        <!-- Custom CSS -->
        <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="dist/css/style.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/jquery-minicolors/jquery.minicolors.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="assets/libs/quill/dist/quill.snow.css">

        <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
        <link href="assets/libs/datatables/jquery.dataTables.min.css" rel="stylesheet">
        <link href="assets/libs/datatables/buttons.dataTables.min.css" rel="stylesheet">


        <link href="assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <link href="assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
        <link href="assets/extra-libs/calendar/calendar.css" rel="stylesheet" />

        <style>
            .form-control{
                border: 1px solid #07203a!important;
            }
            .select2-selection--single {
                border: 1px solid #061e3a!important;
                min-height: 37px!important;

            }
            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 34px!important;
                margin-left: 14px;
            }
            .tbl th {
                background-color: #3b117d;
                color: white;
                border: 1px solid #ddd;
                padding: 8px;
                font-size: 18px;
                font-weight: bold;
            }
            .tblReport th {
                background-color: #6cad6e;
                color: #000000;
                border: 1px solid #ddd;
                padding: 8px;
                font-size: 18px;
                font-weight: bold;
            }
        </style>
        <style>
            @media print {
                #printbtn {
                    display :  none;
                }
                #closeButton {
                    display :  none;
                }
            }
        </style>
    </head>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div id="main-wrapper">
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin5">
                        <!-- This is for the sidebar toggle which is visible on mobile only -->
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

                        <a class="navbar-brand" href="dashboard.php">
                            <!--End Logo icon -->
                            <b class="logo-icon p-l-10">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <!--<img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />-->

                            </b>
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="assets/images/sfu.PNG" alt="homepage" class="light-logo" width="170px" height="50px"/>

                            </span>
                            <!-- Logo icon -->
                            <!-- <b class="logo-icon"> -->
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="../../assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                            <!-- </b> -->
                            <!--End Logo icon -->
                        </a>
                        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>

                    </div>

                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        <ul class="navbar-nav float-left mr-auto">
                            <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="d-none d-md-block">
									<b>Student Registration System &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                        <?php
                                        date_default_timezone_set('Asia/Dhaka');
                                        echo date('l d M Y');
                                        ?>
                                    </span> 
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav float-right">
                          
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="<?php echo Session::get('user_name'); ?>" class="rounded-circle" width="31"></a>
                                <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                    <?php
                                    $staff_id = Session::get('user_id');
                                    ?>
                                    <a class="dropdown-item" href="#"><i class="ti-settings m-r-5 m-l-5"></i><?php echo Session::get('user_name'); ?></a>
                                    <!-- <a class="dropdown-item" href="profile.php?pid=<?php echo $staff_id; ?>"><i class="fas fa-user m-r-5 m-l-5"></i>Profile</a> -->
                                    <a class="dropdown-item" href="changepassword.php"><i class="ti-settings m-r-5 m-l-5"></i>Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="?uid=<?php Session::get('user_id'); ?>"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    <?php
                                    if (isset($_GET['uid'])) {

                                        Session::destroy();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
$stdId = Session::get('user_id');
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"> Student Dashboard</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <!--<h4 class="card-title"></h4>-->
                                <!--<h5 class="card-subtitle">Overview of Latest Month</h5>-->
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-12">
                                <div class="card-body">
                                   <!-- <h5 class="card-title">Recent Login</h5> -->

                                </div>
                                <!-- <table id="" class="table table-striped table-bordered tbl">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">SL</th>
                                            <th style="width:20px;">User</th>
                                            <th style="width:20px;">Name</th>
                                            <th style="width:20px;">Browser</th>
                                            <th style="width:20px;">Date & Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table> -->
                            </div>

                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    <?php include 'footer.php'; ?>


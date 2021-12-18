<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-staff.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}
$getStaff = $admin->getStaffInfo($sid);
$getInfo = mysqli_fetch_assoc($getStaff);

//Basic
$staffFullname = $getInfo['user_fullname'];
$staffDesignation = $getInfo['user_designation'];

$email_office = $getInfo['user_email'];

if($getInfo['user_type'] == 1){
    $user_type = 'Admin';
}else if($getInfo['user_type'] == 2){
    $user_type = 'Chairmen';
}else if($getInfo['user_type'] == 3){
    $user_type = 'Advisor';
}else if($getInfo['user_type'] == 4){
    $user_type = 'Accountant';
}else{
    $user_type = 'Not defined';
}
$joining_date = $getInfo['joining_date'];


?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">User Information</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">user info</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="printableArea">
        <div class="row">
            <div class="col-md-4">
                <h5 class="card-title"></h5>
            
            </div>
            <div class="col-md-5">
                <div class="card">
                    <span align="center" style="color:#000000;font-weight: bold;font-size: 22px;">Stamford University Bangladesh</span><br>
                    <span align="center" style="color:#000000;font-weight: bold;font-size: 15px;">Dept. of CSE</span>

                </div>
            </div>
            <div class="col-md-3">
                <div align="right">
                    <button id ="printbtn" class="btn btn-primary" type="button" value="Print this page" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                    <button id ="closeButton" class="btn btn-danger" onclick="window.close();">Close Page</button>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Basic Information</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Name</b>&nbsp;&nbsp;<?php echo $staffFullname; ?><br>
                        <b>Designation</b>&nbsp;&nbsp;<?php echo $staffDesignation; ?><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Email (Office)</b>&nbsp;&nbsp;<?php echo $email_office; ?><br>
                        <b>Registration: </b>&nbsp;&nbsp;<?php echo $joining_date; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Type</b>&nbsp;&nbsp;<?php echo $user_type; ?><br>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include 'footer.php'; ?>


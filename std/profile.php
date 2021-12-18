<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$sid = Session::get('user_id');
$getStu = $student->getStuInfo($sid);
$getInfo = mysqli_fetch_assoc($getStu);

?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Student Information</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">student info</li>
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

                </div>
            </div>
            <div class="col-md-3">
                <div align="right">
                    <button id ="printbtn" class="btn btn-primary" type="button" value="Print this page" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
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
                        <b>Name: </b>&nbsp;&nbsp;<?php echo $getInfo['student_name']; ?><br>
                        <b>Phone: </b>&nbsp;&nbsp;<?php echo $getInfo['student_contact']; ?><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Student ID: </b>&nbsp;&nbsp;<?php echo $getInfo['student_id']; ?><br>
                        <b>Email: </b>&nbsp;&nbsp;<?php echo $getInfo['student_email']; ?><br>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Date of Birth: </b>&nbsp;&nbsp;<?php echo $getInfo['student_dob']; ?><br>
                        <b>Address: </b>&nbsp;&nbsp;<?php echo $getInfo['student_address']; ?>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
<?php include 'footer.php'; ?>





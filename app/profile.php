<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['pid']) || $_GET['pid'] == NULL) {
    echo "<script>window.location = 'manage-staff.php';</script>";
} else {
    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['pid']);
}
$getStaff = $admin->getStaffInfo($sid);
$getInfo = mysqli_fetch_assoc($getStaff);
$staffImg = $getInfo['pic'];
//Basic
$staffFullname = $getInfo['fullname'];
$staffDesignation = $admin->getOneCol('designation', 'staff_designation', 'id', $getInfo['staff_designation']);
$staffcareOf = $getInfo['careOf'];
$staffbirth = $getInfo['birth'];
$staffmobile = $getInfo['mobile'];
$staffmobile2 = $getInfo['mobile2'];
$staffemail_personal = $getInfo['email_personal'];

$email_office = $getInfo['email_office'];
$blood = $getInfo['blood'];
$present_address = $getInfo['present_address'];
$permanent_address = $getInfo['permanent_address'];
$nationality = $getInfo['nationality'];
$organization = $getInfo['organization'];
$joining = $getInfo['joining'];
$probitionary_start = $getInfo['probitionary_start'];
$probitionary_end = $getInfo['probitionary_end'];
$confirmation_date = $getInfo['confirmation_date'];
$probitionary_status = $getInfo['probitionary_status'];
$job_status = $getInfo['job_status'];



$StaffId = $getInfo['id'];
//Educational
$getEduInfo = $admin->eduInfoByStaff($StaffId);

//Training
$getTrInfo = $admin->trInfoByStaff($StaffId);

//Pay Scale
$getPayInfo = $admin->payInfoByStaff($StaffId);
//Provident
$getProvidentInfo = $admin->providentInfoByStaff($StaffId);
//Gratuity
$getGratuityInfo = $admin->gratuityInfoByStaff($StaffId);
//Leave
$getLeaveInfo = $admin->leaveInfoByStaff($StaffId);
//Nominee
$getNomineeInfo = $admin->nomineeInfoByStaff($StaffId);
//Previous Working History
$getWhInfo = $admin->workingHistoryByStaff($StaffId);
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Staff Information</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">staff info</li>
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
                <img class="img-fluid" src="assets/images/users/<?php echo $staffImg; ?>" height="180px" width="140px">

            </div>
            <div class="col-md-4">
                <div class="card">
                    <span align="center" style="color:#000000;font-weight: bold;font-size: 22px;">Bangladesh University</span>

                </div>
            </div>
            <div class="col-md-4">
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
                        <b>Care of</b>&nbsp;&nbsp;<?php echo $staffcareOf; ?><br>
                        <b>DOB</b>&nbsp;&nbsp;<?php echo $staffbirth; ?><br>
                        <b>Contact</b>&nbsp;&nbsp;<?php echo $staffmobile; ?><br>
                        <b>Contact2</b>&nbsp;&nbsp;<?php echo $staffmobile2; ?><br>
                        <b>Email (Personal)</b>&nbsp;&nbsp;<?php echo $staffemail_personal; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Email (Office)</b>&nbsp;&nbsp;<?php echo $email_office; ?><br>
                        <b>Blood Group</b>&nbsp;&nbsp;<?php echo $blood; ?><br>
                        <b>Pres. Addr</b>&nbsp;&nbsp;<?php echo $present_address; ?><br>
                        <b>Perm. Addr</b>&nbsp;&nbsp;<?php echo $permanent_address; ?><br>
                        <b>Nationality</b>&nbsp;&nbsp;<?php echo $nationality; ?><br>
                        <b>Organization</b>&nbsp;&nbsp;<?php echo $organization; ?><br>
                        <b>Joining</b>&nbsp;&nbsp;<?php echo $fm->formatDate($joining); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Probitionary Start</b>&nbsp;&nbsp;<?php echo $fm->formatDate($probitionary_start); ?><br>
                        <b>Probitionary End</b>&nbsp;&nbsp;<?php echo $fm->formatDate($probitionary_end); ?><br>
                        <b>Confirmation Date</b>&nbsp;&nbsp;<?php echo $fm->formatDate($confirmation_date); ?><br>
                        <b>Probitionary Status</b>&nbsp;&nbsp;<?php echo $probitionary_status; ?><br>
                        <b>Job Status</b>&nbsp;&nbsp;<?php echo $job_status; ?><br>
                        <b></b>&nbsp;&nbsp;<br>
                        <b></b>&nbsp;&nbsp;
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Educational Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Level</b></th>
                                    <th scope="col"><b>Course</b></th>
                                    <th scope="col"><b>Board/University</b></th>
                                    <th scope="col"><b>Year</b></th>
                                    <th scope="col"><b>Result</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($getEduInfo) {
                                    while ($eduRes = $getEduInfo->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $eduRes['level']; ?></th>
                                            <td><?php echo $eduRes['course']; ?></td>
                                            <td><?php echo $eduRes['board_university']; ?></td>
                                            <td><?php echo $eduRes['year']; ?></td>
                                            <td><?php echo $eduRes['result']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Training Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>

                                <tr>
                                    <th scope="col"><b>Title</b></th>
                                    <th scope="col"><b>Duration</b></th>
                                    <th scope="col"><b>Conducted By</b></th>
                                    <th scope="col"><b>Start Date</b></th>
                                    <th scope="col"><b>End Date</b></th>
                                    <th scope="col"><b>Cost</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getTrInfo) {
                                    while ($trRes = $getTrInfo->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $trRes['title']; ?></th>
                                            <td><?php echo $trRes['duration']; ?></td>
                                            <td><?php echo $trRes['conducted_by']; ?></td>
                                            <td><?php echo $fm->formatDate($trRes['start_date']); ?></td>
                                            <td><?php echo $fm->formatDate($trRes['end_date']); ?></td>
                                            <td><?php echo $trRes['cost']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pay Scale Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Effective Date</b></th>
                                    <th scope="col"><b>Basic</b></th>
                                    <th scope="col"><b>House Rent</b></th>
                                    <th scope="col"><b>Medicle Allowance</b></th>
                                    <th scope="col"><b>Conveyance</b></th>
                                    <th scope="col"><b>LFA</b></th>
                                    <th scope="col"><b>Others</b></th>
                                    <th scope="col"><b>Consolited Amount</b></th>
                                    <th scope="col"><b>Yearly Status</b></th>
                                    <th scope="col"><b>Designation</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getPayInfo) {
                                    while ($payRes = $getPayInfo->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $fm->formatDate($payRes['effective_date']); ?></th>
                                            <td><?php echo $payRes['basic']; ?></td>
                                            <td><?php echo $payRes['house_rent']; ?></td>
                                            <td><?php echo $payRes['medical']; ?></td>
                                            <td><?php echo $payRes['conveyance']; ?></td>
                                            <td><?php echo $payRes['lfa']; ?></td>
                                            <td><?php echo $payRes['others']; ?></td>
                                            <td><?php echo $payRes['consolidated']; ?></td>
                                            <td><?php echo $payRes['yearly_status']; ?></td>
                                            <td><?php echo $payRes['designation']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Provident Fund Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Date As On</b></th>
                                    <th scope="col"><b>Emp. Contribution with Profit</b></th>
                                    <th scope="col"><b>PBF Contribution with Profit</b></th>
                                    <th scope="col"><b>Deduction</b></th>
                                    <th scope="col"><b>Net Total</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getProvidentInfo) {
                                    while ($proRes = $getProvidentInfo->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fm->formatDate($proRes['date_as']); ?></td>
                                            <td><?php echo $proRes['emp_con_profit']; ?></td>
                                            <td><?php echo $proRes['pbf_con_profit']; ?></td>
                                            <td><?php echo $proRes['deduction']; ?></td>
                                            <td><?php echo $proRes['net_total']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gratuity Fund Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>Date As On</b></th>
                                    <th scope="col"><b>PBF Contribution with Profit</b></th>
                                    <th scope="col"><b>Deduction</b></th>
                                    <th scope="col"><b>Net Total</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getGratuityInfo) {
                                    while ($proRes = $getGratuityInfo->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fm->formatDate($proRes['date_as']); ?></td>
                                            <td><?php echo $proRes['pbf_con_profit']; ?></td>
                                            <td><?php echo $proRes['deduction']; ?></td>
                                            <td><?php echo $proRes['net_total']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Leave Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><b>SL</b></th>
                                    <th><b>Type</b></th>
                                    <th><b>Nature</b></th>
                                    <th><b>Start Date</b></th>
                                    <th><b>End Date</b></th>
                                    <th><b>Day(s)</b></th>
                                    <th><b>Reason</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getLeaveInfo) {
                                    $i = 0;
                                    while ($proRes = $getLeaveInfo->fetch_assoc()) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <?php
                                                $leaveType = $admin->getOneCol('leave_type', 'leave_type', 'id', $proRes['leaveType']);
                                                echo $leaveType;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $leaveNature = $admin->getOneCol('leave_nature', 'nature_of_leave', 'id', $proRes['leave_nature']);
                                                echo $leaveNature;
                                                ?>
                                            </td>
                                            <td><?php echo $fm->formatDate($proRes['start_date']); ?></td>
                                            <td><?php echo $fm->formatDate($proRes['end_date']); ?></td>
                                            <td><?php echo $proRes['days']; ?></td>
                                            <td><?php echo $proRes['reason']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nominee Information</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><b>SL</b></th>
                                    <th><b>Nominee</b></th>
                                    <th><b>Care of</b></th>
                                    <th><b>Relation</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getNomineeInfo) {
                                    $i = 0;
                                    while ($proRes = $getNomineeInfo->fetch_assoc()) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $proRes['nominee_name']; ?></td>
                                            <td><?php echo $proRes['care_of']; ?></td>
                                            <td><?php echo $proRes['relation']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Previous Working History</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><b>SL</b></th>
                                    <th><b>Name of Organization</b></th>
                                    <th><b>Designation</b></th>
                                    <th><b>Start Date</b></th>
                                    <th><b>End Date</b></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if ($getWhInfo) {
                                    $i = 0;
                                    while ($proRes = $getWhInfo->fetch_assoc()) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $proRes['organization_name']; ?></td>
                                            <td><?php echo $proRes['designation']; ?></td>
                                            <td><?php echo $fm->formatDate($proRes['start_date']); ?></td>
                                            <td><?php echo $fm->formatDate($proRes['end_date']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>




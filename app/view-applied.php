<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['aid']) || $_GET['aid'] == NULL) {
    echo "<script>window.location = 'pending-registration.php';</script>";
} else {

    $aid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['aid']);
}

$offer_id = $admin->getOneCol('offer_id','registration_info','id',$aid);
$program = $admin->getOneCol('program','offered_courses_info','id',$offer_id);	
$batch = $admin->getOneCol('batch','offered_courses_info','id',$offer_id);
$semester = $admin->getOneCol('semester','offered_courses_info','id',$offer_id);
$apply_date = $admin->getOneCol('apply_date','registration_info','id',$aid);
$student_ID = $admin->getOneCol('student_ID','registration_info','id',$aid);

$reg_date = $admin->getOneCol('joining_date','students','id',$student_ID);


$getStu = $admin->getAppliedCourseList($aid);

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $rejectPreReq = $admin->rejectCourse($course_id,$aid);
}


?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Applied Course Details</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">details</li>
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
                    <span align="center" style="color:#000000;font-weight: bold;font-size: 15px;">Dept. of <?php echo $program; ?></span>
                    <?php
                    if (isset($apply)) {
                        echo $apply;
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div align="right">
                    <button id ="printbtn" class="btn btn-primary" type="button" value="Print this page" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                    <button id ="closeButton" class="btn btn-danger" onclick="window.close();">Close Page</button>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Basic Information</h5>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Course List</h5>
                        <?php
                        if(isset($rejectPreReq)){
                            echo $rejectPreReq;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Name:</b>&nbsp;&nbsp;<?php echo $admin->getOneCol('student_name','students','id',$student_ID); ?><?php if($fm->getOldStudent($reg_date) == 1){?><sup><span class="label label-danger">OLD</span></sup><?php } ?><br>
                        <b>ID:</b>&nbsp;&nbsp;<?php echo $admin->getOneCol('student_id','students','id',$student_ID);; ?><br>
                        <b>Program</b>&nbsp;&nbsp;<?php echo $program; ?><br>
                        <b>Batch</b>&nbsp;&nbsp;<?php echo $batch; ?><br>
                        <b>Semester</b>&nbsp;&nbsp;<?php echo $semester; ?><br>
                        <b>Apply Date</b>&nbsp;&nbsp;<?php echo $fm->formatDate($apply_date); ?><br>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                      <form class="form-horizontal" method = "post" action="">
                       <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Course</th>
                                        <th>Credit</th>
                                        <th>Code</th>
                                        <th>Prerequisite</th>
                                        <th>Done</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getStu) {
                                        $i = 0;
                                        while ($row = $getStu->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php 
                                                       echo $admin->getOneCol('course_name','courses','id',$row['course_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                       echo $admin->getOneCol('course_credit','courses','id',$row['course_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                       echo $admin->getOneCol('course_code','courses','id',$row['course_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                       $prcid = $admin->getOneCol('prerequisite_course','courses','id',$row['course_id']);
                                                       echo $admin->getOneCol('course_name','courses','id',$prcid);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                      $prid = $admin->getOneCol('prerequisite_course','courses','id',$row['course_id']);
                                                      if($prid != 0){
                                                        echo $info = $admin->getPreRequisiteInfo($student_ID,$prid);
                                                      }else{
                                                          echo 'N/A';
                                                      }
                                                      
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                      $prcid = $admin->getOneCol('prerequisite_course','courses','id',$row['course_id']);
                                                      if($prcid != 0){
                                                    ?>
                                                   <a onclick="return confirm('Are you sure to reject?');" href="?aid=<?php echo $aid; ?>&&course_id=<?php echo $row['course_id']; ?>"><span class="label label-danger">Reject</span></a>
                                                 <?php }
                                                  ?>
                                                </td>
                                                <td>
                                                <?php
                                                     if($row['status'] == 0){
                                                        ?>
                                                        <span class="label label-warning">Pending</span>
                                                     <?php
                                                        }else if($row['status'] == 1){
                                                            ?>
                                                            <span class="label label-success">Approved</span>
                                                       <?php
                                                        }else{
                                                        ?>
                                                            <span class="label label-danger">Rejected</span>
                                                        <?php

                                                        }
                                                     ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    
                    
                        </form>
                    
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    <?php include 'footer.php'; ?>


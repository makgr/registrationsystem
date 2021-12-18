<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['aplid'])) {
    $aplid = $_GET['aplid'];
    $StdID = $_GET['StdID'];
    $approvReg = $admin->registrationApprov($aplid,$StdID);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Pending Registration</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">registration</li>
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
                    <?php
                    if (isset($_SESSION['applyMessage'])) {
                        echo $_SESSION['applyMessage'];
                        unset($_SESSION['applyMessage']);
                    }
                    if (isset($_SESSION['statusChangeMessage'])) {
                        echo $_SESSION['statusChangeMessage'];
                        unset($_SESSION['statusChangeMessage']);
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Pending Registration</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Student</th>
                                        <th>Student ID</th>
                                        <th>Program</th>
                                        <th>Batch</th>
                                        <th>Semester</th>
                                        <th>Registration Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getStaff = $admin->getPendingRegistrationList();
                                    if ($getStaff) {
                                        $i = 0;
                                        while ($result = $getStaff->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                   <?php 
                                                       $reg_date = $admin->getOneCol('joining_date','students','id',$result['student_ID']);
                                                       echo $admin->getOneCol('student_name','students','id',$result['student_ID']);
                                                    ?>
                                                    <?php if($fm->getOldStudent($reg_date) == 1){?><sup><span class="label label-danger">OLD</span></sup><?php } ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('student_id','students','id',$result['student_ID']);
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('program','offered_courses_info','id',$result['offer_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('batch','offered_courses_info','id',$result['offer_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('semester','offered_courses_info','id',$result['offer_id']);
                                                    ?>
                                                </td>
                                                <td><?php echo $fm->formatDate($result['apply_date']); ?></td>
                                                <td>
                                                    <?php
                                                     if($result['status'] == 0){
                                                        ?>
                                                        <a onclick="return confirm('Are you sure to approv?');" href="?aplid=<?php echo $result['id']; ?>&StdID=<?php echo $result['student_ID'];?>"><span class="label label-warning">Pending</span></a>
                                                     <?php
                                                        }else{
                                                            ?>
                                                            <span class="label label-success">Approved</span>
                                                       <?php
                                                        }
                                                     ?>
                                                     <?php
                                                        $getStu = $admin->getAppliedCourseList($result['id']);
                                                        if ($getStu) {
                                                            $i = 0;
                                                            while ($row = $getStu->fetch_assoc()) {
                                                                  $i++;
                                                                        $prid = $admin->getOneCol('prerequisite_course','courses','id',$row['course_id']);
                                                                        if($prid != 0){
                                                                           $info = $admin->getPreRequisiteInfo($result['student_ID'],$prid);
                                                                        }else{
                                                                            echo '<br>';
                                                                        }
                                                                   }
                                                                   if($info == 'Not Done'){
                                                                    echo "<div class='alert alert-danger'>
                                                                    <h4> Pre requisite issue</h4>
                                                                 </div>";
                                                                   }
                                                             }
                                                      ?>
                                                    
                                               </td>
                                               <td>
                                               <a href="view-applied.php?aid=<?php echo $result['id']; ?>"><span class="label label-primary">View</span></a>
                                               </td>
                                               
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
    </div>
</div>
<?php include 'footer.php'; ?>


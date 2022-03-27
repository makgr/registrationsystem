<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['fid']) || $_GET['fid'] == NULL) {
    echo "<script>window.location = 'offer-list.php';</script>";
} else {

    $fid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['fid']);
}
$getInformation = $student->getOfferedCourseInfo($fid);
$getInfo = mysqli_fetch_assoc($getInformation);

$getStu = $student->getOfferedCourseList($fid);

//check already applied or not
$appliedOrNot = $student->alreadyAppliedOrNot($fid,$user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $apply = $student->applyForRegistration($fid,$user_id);
    if($apply){
        foreach($_POST['cid'] as $id){
            $message2 = $student->registeredCourses($id,$apply,$user_id);
          }
    
        // if ($savecount == count($_POST['contact'])) {
            if ($message2) {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully Applied.</div>";
            header('Location: available-registration.php');
            exit();
        } else {
            // $_SESSION['message'] = "<div class='alert alert-danger'>Failed to apply.</div>";
            // header('Location: available-registration.php');
            // exit();
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully Applied.</div>";
            header('Location: available-registration.php');
            exit();
        }
    }
}

?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Offeres Course Details</h4>
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
                    <span align="center" style="color:#000000;font-weight: bold;font-size: 15px;">Dept. of <?php echo $getInfo['program']; ?></span>
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
                         if(isset($_SESSION['insmsg'])){
                            echo $_SESSION['insmsg'];
                            unset($_SESSION['insmsg']);
                         }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <b>Program</b>&nbsp;&nbsp;<?php echo $getInfo['program']; ?><br>
                        <b>Batch</b>&nbsp;&nbsp;<?php echo $getInfo['batch']; ?><br>
                        <b>Semester</b>&nbsp;&nbsp;<?php echo $getInfo['semester']; ?><br>
                        <b>Offer Date</b>&nbsp;&nbsp;<?php echo $fm->formatDate($getInfo['offer_date']); ?><br>
                        <b>Registration End</b>&nbsp;&nbsp;<?php echo $fm->formatDate($getInfo['registration_end']); ?><br>
                        <b>Semester Type</b>&nbsp;&nbsp;<?php echo $fm->getSemesterType($getInfo['registration_end']); ?><br>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <br>
                        <div class="form-group">
                            <input type="checkbox" id="checkAll" name="" value="ALL">
                            <label style="margin-left: 8px;color: green">ALL</label>
                        </div>
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
                                        <th>Action</th>
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
                                                       echo $student->getOneCol('course_name','courses','id',$row['course_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                       echo $student->getOneCol('course_credit','courses','id',$row['course_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                       echo $student->getOneCol('course_code','courses','id',$row['course_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                       $prcid = $student->getOneCol('prerequisite_course','courses','id',$row['course_id']);
                                                       echo $student->getOneCol('course_name','courses','id',$prcid);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                      if(isset($appliedOrNot) == 1){
                                                    ?>
                                                    Already applied.
                                                  <?php }else{
                                                ?>
                                                <input type="checkbox" id="checkItem" name="cid[]" value="<?php echo $row['course_id']; ?>" class="checkItem">
                                                <?php
                                                  } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    
                        <?php 
                       if(Session::get('reg_status') == 1){ 
                    ?>
                       <button type="submit" name = "save" class="btn btn-success">Apply Now</button>
                    <?php
                    }else{
                        ?>
                        <span class="label label-danger">Sorry You are not eligible.</span>
                    <?php
                    }
                    ?>
                    
                        </form>
                    
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script>
    $('#checkAll').click(function() {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
   </script>

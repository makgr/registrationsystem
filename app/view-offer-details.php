<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['oid']) || $_GET['oid'] == NULL) {
    echo "<script>window.location = 'offer-list.php';</script>";
} else {

    $oid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['oid']);
}
$getInformation = $admin->getOfferedCourseInfo($oid);
$getInfo = mysqli_fetch_assoc($getInformation);

$getStu = $admin->getOfferedCourseList($oid);


if (isset($_GET['oid']) && isset($_GET['deloffercourse'])) {
    $deloffercourse = $_GET['deloffercourse'];
    $offerCrsDel = $admin->deleteOfferCourse($deloffercourse,$oid);
}

$getOfferCrsList = $admin->getAllCourse();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addNewCrs'])) {

    $newOfferCrs = $admin->addNewOfferCourse($_POST,$oid,$user_id);
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
                         if(isset($_SESSION['delMsg'])){
                             echo $_SESSION['delMsg'];
                             unset($_SESSION['delMsg']);
                         }
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
                    <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Course</th>
                                        <th>Credit</th>
                                        <th>Code</th>
                                        <th>Pre Requisite</th>
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
                                                       $prerequisite_course = $admin->getOneCol('prerequisite_course','courses','id',$row['course_id']);
                                                       echo $admin->getOneCol('course_name','courses','id',$prerequisite_course);
                                                    ?>
                                                </td>
                                                <td>
                                                   <a onclick="return confirm('Are you sure to delete?');" href="?oid=<?php echo $oid;?>&&deloffercourse=<?php echo $row['id']; ?>"><span class="label label-danger"><i class="fas fa-trash"></i></span></a>
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

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method = "post" action="">
                                <select class="select2" name="addNewOfferCourse" required>
                                    <option value="">Select Course</option>
                                    <?php
                                    while ($crsresult = $getOfferCrsList->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $crsresult['id'];?>"><?php echo $crsresult['course_name'];?></option>
                                    <?php } ?>
                            </select> 
                            <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "addNewCrs" class="btn btn-success">Add</button>
                            </div>
                        </div>      
                        </form>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    <?php include 'footer.php'; ?>


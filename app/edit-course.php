<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-course.php';</script>";
} else {
    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}
$getPreReqCourse = $admin->getAllCourse();
$getInfo = $admin->getCourseById($sid);
$res = mysqli_fetch_assoc($getInfo);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $subUpdate = $admin->updateSubject($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Course</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit course</li>
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
                    if (isset($subUpdate)) {
                        echo $subUpdate;
                    }
                    ?>
                    
                            <form class="form-horizontal" name="demo-form2" method = "post" action="">
                                <div class="card-body">
                                    <h4 class="card-title">Course</h4>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="course_name">Course Name<span style="color: red"> *</span></label>
                                                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo $res['course_name']; ?>" placeholder="Course Name" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="course_code">Course Code<span style="color: red"> *</span></label>
                                                        <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $res['course_code']; ?>" placeholder="Course code" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="course_credit">Credit<span style="color: red"> *</span></label>
                                                        <input type="text" class="form-control" id="course_credit" name="course_credit" value="<?php echo $res['course_credit']; ?>" placeholder="Course credit" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="program">Program<span style="color: red"> *</span></label>
                                                        <input type="text" class="form-control" id="program" name="program" value="<?php echo $res['program']; ?>" placeholder="Program" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="prerequisite_course">Pre Requisite Course<span style="color: red"> *</span></label>
                                                        <select class="form-control" id="prerequisite_course" name="prerequisite_course" required>
                                                            <option>Select Course</option>
                                                            <option value="0">N/A</option>
                                                            <?php
                                                            while($crs = $getPreReqCourse->fetch_assoc()){
                                                            ?>
                                                             <option value="<?php echo $crs['id'];?>"><?php echo $crs['course_code'].'-'.$crs['course_name'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_teacher">Course Teacher<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="course_teacher" name="course_teacher" value="<?php echo $res['course_teacher']; ?>" pattern="[A-Z a-z]+" title="Allow only text" placeholder="Program (text only)" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>										
                                </div>
                                <div class="border-top">
                                    <div class="card-body" align="center">
                                        <button type="submit" name = "save" class="btn btn-primary">Save Change</button>
                                    </div>
                                </div>
                            </form>
                            
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script>
document.forms['demo-form2'].elements['prerequisite_course'].value = '<?php echo $res['prerequisite_course']; ?>';
</script>


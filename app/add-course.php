<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getPreReqCourse = $admin->getAllCourse();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $subjectInsert = $admin->addCourse($_POST);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Subject</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">add subject</li>
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
                    if (isset($subjectInsert)) {
                        echo $subjectInsert;
                    }
                    if (isset($_SESSION['courseMessage'])) {
                        echo $_SESSION['courseMessage'];
                        unset($_SESSION['courseMessage']);
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Subject</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_name">Course Name<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Course Name" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_code">Course Code<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="course_code" name="course_code" placeholder="Course code" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_credit">Credit<span style="color: red"> *</span></label>
                                                <input type="number" step="any" class="form-control" id="course_credit" name="course_credit" placeholder="Course credit (Number only)" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="program">Program<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="program" name="program" value="CSE" pattern="[A-Za-z]+" placeholder="Program (text only)" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="prerequisite_course">Pre Requisite Course<span style="color: red"> *</span></label>
                                            <select class="form-control select2" name="prerequisite_course" required>
                                                <option>Select Course</option>
                                                <option value="0">N/A</option>
                                                <?php
                                                foreach($getPreReqCourse as $crs){
                                                ?>
                                                <option value="<?php echo $crs['id'];?>"><?php echo $crs['course_code'].'-'.$crs['course_name'];?></option>
                                                <?php }?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_teacher">Course Teacher<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" id="course_teacher" name="course_teacher" placeholder="Program (text only)" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

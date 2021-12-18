<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStu = $admin->getAllCourse();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $offerCourseInfo = $admin->offerCourseInformation($_POST,$user_id);
    if($offerCourseInfo){
        foreach($_POST['cid'] as $id){
            $message2 = $admin->offeredCourses($id,$offerCourseInfo,$user_id);
          }
    
        // if ($savecount == count($_POST['contact'])) {
            if ($message2) {
            $_SESSION['message'] = "<div class='alert alert-success'>Successfully Offered Courses.</div>";
            header('Location: offer-course.php');
            exit();
        } else {
            $_SESSION['message'] = "<div class='alert alert-danger'>Failed.</div>";
            header('Location: offer-course.php');
            exit();
        }
    }
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Offer Course</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Offer Course</li>
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
                        if (isset($offerCourseInfo)) {
                            echo $offerCourseInfo;
                        }
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Offer Course</h4>
                            <div class="row">	
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="program">Program<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="program" name="program" value="CSE" placeholder="Program Name" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="batch">Batch<span style="color: red"> *</span></label>
                                        <input type="number" class="form-control" id="batch" name="batch" placeholder="Batch" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="semester">Semester<span style="color: red"> *</span></label>
                                        <input type="number" class="form-control" id="semester" name="semester" placeholder="Semester" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="registration_end">Registration End<span style="color: red"> *</span></label>
                                        <input type="date" class="form-control" id="registration_end" name="registration_end" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>										
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">All Courses</h5>
                        <br>
                        <div class="form-group">
                            <input type="checkbox" id="checkAll" name="" value="ALL">
                            <label style="margin-left: 8px;color: green">ALL</label>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Code</th>
                                        <th>Credit</th>
                                        <th>Subject</th>
                                        <th>Program</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($getStu) {
                                        $i = 0;
                                        while ($result = $getStu->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['course_code']; ?></td>
                                                <td><?php echo $result['course_credit']; ?></td>
                                                <td><?php echo $result['course_name']; ?></td>
                                                <td><?php echo $result['program']; ?></td>
                                                <td>
                                                  <input type="checkbox" id="checkItem" name="cid[]" value="<?php echo $result['id']; ?>" class="checkItem">
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
                        <div class="border-top">
                            <div class="card-body" align="center">
                                <button type="submit" name = "save" class="btn btn-success">Offer Now</button>
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
    $('#checkAll').click(function() {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
</script>




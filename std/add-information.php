<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
error_reporting(0);
$user_id = Session::get('user_id');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $updateInfo = $student->updateStuInfo($_POST);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Basic Information</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">basic Information</li>
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
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                    <?php
                    $getInfo = $student->getStuInfoById($user_id);
                    if ($getInfo) {
                        while ($res = $getInfo->fetch_assoc()) {
                            ?>
                            <form class="form-horizontal" method = "post" action="" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Basic Information</h4>
                                    <div class="row">	
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="si">Student ID<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="si" name="std_id" value="<?php echo $res['student_id']; ?>" placeholder="Std ID" autocomplete="off" readonly="" required>
                                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" placeholder="Std ID" autocomplete="off" readonly="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="program">Program<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="program" name="program" value="<?php echo $res['program']; ?>" placeholder="Std ID" autocomplete="off" readonly="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="batch">Batch<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="batch" name="batch" value="<?php echo $res['batch']; ?>" placeholder="Std ID" autocomplete="off" readonly="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="student_dob">Date of Birth<span style="color: red">*</span></label>
                                                <input type="date" class="form-control" id="student_dob" name="student_dob" value="<?php echo $res['student_dob']; ?>" placeholder="Std ID" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student_name">Full Name</label>
                                                <input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo $res['student_name']; ?>" placeholder="Full name" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="student_email">Email</label>
                                                <input type="text" class="form-control" id="student_email" name="student_email" value="<?php echo $res['student_email']; ?>" placeholder="Full name" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="student_contact">Phone</label>
                                                <input type="text" class="form-control" id="student_contact" name="student_contact" value="<?php echo $res['student_contact']; ?>" placeholder="Phone" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label for="student_address">Address</label>
                                                <input type="text" class="form-control" id="student_address" name="student_address" value="<?php echo $res['student_address']; ?>" placeholder="Address" autocomplete="off">
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
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>




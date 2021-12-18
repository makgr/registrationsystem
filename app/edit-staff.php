<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (!isset($_GET['sid']) || $_GET['sid'] == NULL) {
    echo "<script>window.location = 'manage-staff.php';</script>";
} else {

    $sid = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['sid']);
}
$value = $admin->getStaffById($sid);
$getInfo = mysqli_fetch_assoc($value);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $staffUpd = $admin->updateUser($_POST, $sid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">User</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">edit user</li>
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
                    if (isset($staffUpd)) {
                        echo $staffUpd;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">Basic Information</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_type">Type<span style="color: red"> *</span></label>
                                        <select class="form-control" name="user_type" required>
                                            <option>Select Type</option>
                                            <?php
                                             if($getInfo['user_type'] == 1){
                                            ?>
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Chairmen</option>
                                            <option value="3">Advisor</option>
                                            <option value="4">Accountant</option>
                                            <?php
                                             }else if($getInfo['user_type'] == 2){
                                            ?>
                                            <option value="1">Admin</option>
                                            <option value="2" selected>Chairmen</option>
                                            <option value="3">Advisor</option>
                                            <option value="4">Accountant</option>
                                            <?php
                                             }else if($getInfo['user_type'] == 3){
                                            ?>
                                            <option value="1">Admin</option>
                                            <option value="2">Chairmen</option>
                                            <option value="3" selected>Advisor</option>
                                            <option value="4">Accountant</option>
                                            <?php
                                             }else if($getInfo['user_type'] == 4){
                                            ?>
                                            <option value="1">Admin</option>
                                            <option value="2">Chairmen</option>
                                            <option value="3">Advisor</option>
                                            <option value="4" selected>Accountant</option>
                                            <?php
                                             }else{
                                            ?>
                                            <option value="1">Admin</option>
                                            <option value="2">Chairmen</option>
                                            <option value="3">Advisor</option>
                                            <option value="4">Accountant</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_designation">Designation<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="user_designation" name="user_designation" value="<?php echo $getInfo['user_designation'];?>" autocomplete="off" placeholder="Designation" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Full Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fullname" name="user_fullname" placeholder="Full Name" value="<?php echo $getInfo['user_fullname'];?>" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_email">Email (Office)<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $getInfo['user_email'];?>" autocomplete="off" placeholder="Email" required>
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
    $('#checkAll').click(function () {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
</script>

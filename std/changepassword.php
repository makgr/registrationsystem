<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatePassword'])) {
    $user_id = Session::get("user_id");

    if (isset($_POST['OldPassword']) && isset($_POST['NewPassword'])) {

        $OldPassword = md5($_POST['OldPassword']);

        $NewPassword = $_POST['NewPassword'];

        $passUpdate = $student->updatePas($OldPassword, $NewPassword, $user_id);
    }
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Change Password</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    if (isset($passUpdate)) {
                        echo $passUpdate;
                    }
                    ?>
                    <form class="form-horizontal" method = "post">
                        <div class="card-body">
                            <h4 class="card-title">Change Password</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lname">Old Password</label>
                                        <input type="password" name = "OldPassword" class="form-control" id="lname" placeholder="Old Password Here" autocomplete="off" required>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="lname">New Password</label>
                                    <input type="password" name = "NewPassword" class="form-control" id="lname" placeholder="New Password Here" autocomplete="off" required>

                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name = "updatePassword" class="btn btn-primary">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
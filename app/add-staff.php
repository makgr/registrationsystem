<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {

    $staffInsert = $admin->addStaff($_POST);
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
                            <li class="breadcrumb-item active" aria-current="page">add user</li>
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
                    if (isset($staffInsert)) {
                        echo $staffInsert;
                    }
                    ?>
                    <form class="form-horizontal" method = "post" action="">
                        <div class="card-body">
                            <h4 class="card-title">Basic Information</h4>
                            <div class="row">	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_type">User Type<span style="color: red"> *</span></label>
                                        <select class="form-control" name="user_type" required>
                                            <option>Select Type</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Chairmen</option>
                                            <option value="3">Advisor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_designation">Designation<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="user_designation" name="user_designation" pattern="[A-Za-z]+" title="Allow only text" autocomplete="off" placeholder="Designation (text only)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_email">Email (Office)<span style="color: red"> *</span></label>
                                        <input type="email" class="form-control" id="user_email" name="user_email" autocomplete="off" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullname">Full Name<span style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="fullname" name="user_fullname" required placeholder="Full Name (text only)" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_password">Password<span style="color: red"> *</span></label>
                                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="password" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="advisor_batch">Batch<span style="color: red"> Mandatory if you are select advisor</span></label>
                                        <input type="number" pattern="^[0-9]" title='Only Number' min="1" step="1" class="form-control" id="advisor_batch" name="advisor_batch" placeholder="Enter batch" autocomplete="off">
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
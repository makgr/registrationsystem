<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $staffDel = $admin->deleteStaff($delid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Manage Users</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">users</li>
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
                    if (isset($staffDel)) {
                        echo $staffDel;
                    }
                    if (isset($staffAp)) {
                        echo $staffAp;
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All User</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Designation</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getStaff = $admin->getAllStaff();
                                    if ($getStaff) {
                                        $i = 0;
                                        while ($result = $getStaff->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><a target="_blank" href="view-staff.php?sid=<?php echo $result['id']; ?>"><?php echo $result['user_fullname']; ?></a></td>
                                                
                                                <td>
                                                <?php
                                                    if($result['user_type'] == 1){
                                                        echo 'Admin';
                                                    }else if($result['user_type'] == 2){
                                                        echo 'Chairmen';
                                                    }else if($result['user_type'] == 3){
                                                        echo 'Advisor';
                                                    }else if($result['user_type'] == 4){
                                                        echo 'Accountant';
                                                    }else{
                                                        echo 'Not defined';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $result['user_designation']; ?></td>
                                                <td><?php echo $result['user_email']; ?></td>
                                                <td>
                                                    <a target="_blank" href="view-staff.php?sid=<?php echo $result['id']; ?>"><span class="label label-primary"><i class="fas fa-eye"></i></span></a>
                                                    <a href="edit-staff.php?sid=<?php echo $result['id']; ?>"><span class="label label-info"><i class=" fas fa-edit"></i></span></a>
                                                    <a onclick="return confirm('Are you sure to delete?');" href="?delid=<?php echo $result['id']; ?>"><span class="label label-danger"><i class="fas fa-trash"></i></span></a>
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


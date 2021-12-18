<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['stpid'])) {
    $stpid = $_GET['stpid'];
    $staffDel = $admin->changeStatusToPending($stpid);
}
if (isset($_GET['stoid'])) {
    $stoid = $_GET['stoid'];
    $staffDel2 = $admin->changeStatusToOk($stoid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Manage Student</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">students</li>
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
                    <div class="card-body">
                        <h5 class="card-title">All Students</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>Program</th>
                                        <th>Batch</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getStu = $admin->getAllStudent();
                                    if ($getStu) {
                                        $i = 0;
                                        while ($result = $getStu->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['student_name']; ?> <?php if($fm->getOldStudent($result['joining_date']) == 1){?><sup><span class="label label-danger">OLD</span></sup><?php } ?></td>
                                                <td><?php echo $result['student_id']; ?></td>
                                                <td><?php echo $result['program']; ?></td>
                                                <td><?php echo $result['batch']; ?></td>
                                                <td>
                                                  <?php
                                                    if (Session::get("user_type") == '3') {
                                                        if ($result['status'] == 1) {
                                                        ?>
                                                     <a onclick="return confirm('Are you sure to pending?');" href="?stpid=<?php echo $result['id']; ?>"><span class="label label-success">Ok</span></a>
                                                    <?php }else{
                                                        ?>
                                                  <a onclick="return confirm('Are you sure to approv?');" href="?stoid=<?php echo $result['id']; ?>"><span class="label label-warning">Pending</span></a>
                                                     <?php
                                                    }} ?>
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


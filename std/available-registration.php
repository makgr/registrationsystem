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
                <h4 class="page-title">Available Form</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">registration</li>
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
                    if (isset($_SESSION['applyMessage'])) {
                        echo $_SESSION['applyMessage'];
                        unset($_SESSION['applyMessage']);
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Form</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Program</th>
                                        <th>Batch</th>
                                        <th>Semester</th>
                                        <th>End Date</th>
                                        <th>Semester Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getStaff = $student->getAllRegistrationForm();
                                    if ($getStaff) {
                                        $i = 0;
                                        while ($result = $getStaff->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $result['program']; ?></td>
                                                <td><?php echo $result['batch']; ?></td>
                                                <td><?php echo $result['semester']; ?></td>
                                                <td><?php echo $result['registration_end']; ?></td>
                                                <td><span class="label label-success"><b><?php echo $fm->getSemesterType($result['offer_date']); ?></b></span></td>
                                                <td>
                                                    <a href="view-details.php?fid=<?php echo $result['id']; ?>"><span class="label label-primary">View</span></a>
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


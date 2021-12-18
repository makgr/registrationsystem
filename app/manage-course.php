<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $studentDel = $admin->deleteCourse($delid);
}
$getStu = $admin->getAllCourse();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Manage Course</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">course</li>
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
                    if (isset($studentDel)) {
                        echo $studentDel;
                    }
                    if (isset($_SESSION['courseUpdateMessage'])) {
                        echo $_SESSION['courseUpdateMessage'];
                        unset($_SESSION['courseUpdateMessage']);
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Courses</h5>
                        <br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Code</th>
                                        <th>Credit</th>
                                        <th>Subject</th>
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
                                                <td>
                                                    <a href="edit-course.php?sid=<?php echo $result['id']; ?>"><span class="label label-info"><i class=" fas fa-edit"></i></span></a>
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




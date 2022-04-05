<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
if (isset($_GET['aplid'])) {
    $aplid = $_GET['aplid'];
    $StdID = $_GET['StdID'];
    $approvReg = $admin->registrationApprov($aplid,$StdID);
}
if (isset($_GET['wid'])) {
    $wid = $_GET['wid'];
    $withdraw = $admin->approvWithdrawCourse($wid);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Withdraw Request</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">withdraw</li>
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
                        <h5 class="card-title">All Withdraw Request</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Student</th>
                                        <th>Student ID</th>
                                        <th>Program</th>
                                        <th>Registration Date</th>
                                        <th>Withdraw Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getStaff = $admin->getTotalWithdrawList();
                                    if ($getStaff) {
                                        $i = 0;
                                        while ($result = $getStaff->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('student_name','students','id',$result['student_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('student_id','students','id',$result['student_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $admin->getOneCol('program','students','id',$result['student_id']);
                                                    ?>
                                                </td>
                                                <td>
                                                   <?php 
                                                       echo $result['registered_date'];
                                                    ?>
                                                </td>
                                                <td>
                                                <?php
                                                     if($result['withdraw_status'] == 1){
                                                        ?>
                                                       <a onclick="return confirm('Are you sure to approv?');" href="?wid=<?php echo $result['id']; ?>"> <span class="label label-warning">Pending Withdrawal</span></a>
                                                     <?php
                                                        }else if($result['withdraw_status'] == 2){
                                                            ?>
                                                            <span class="label label-success">Approved Withdrawal</span>
                                                       <?php
                                                        }else{
                                                        ?>
                                                            <span class="label label-info">N/A</span>
                                                        <?php

                                                        }
                                                     ?>
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


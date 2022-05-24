<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
$getStu = $admin->getAllOffer();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['extend'])) {
$extend_id = $_POST['extend_id'];
$extend_date = $_POST['extend_date'];
$extendRegDate = $admin->updateRegistrationDate($extend_id ,$extend_date);
}
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Offer List</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">offer list</li>
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
                    if (isset($_SESSION['courseUpdateMessage'])) {
                        echo $_SESSION['courseUpdateMessage'];
                        unset($_SESSION['courseUpdateMessage']);
                    }
                    if (isset($_SESSION['message'])) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title">All Offer</h5>
                        <br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered tbl">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Program</th>
                                        <th>Batch</th>
                                        <th>Semester</th>
                                        <th>Semester Type</th>
                                        <th>Offer Date</th>
                                        <th>Registration End</th>
                                        <th>Action</th>
                                        <th>Extend</th>
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
                                                <td><?php echo $result['program']; ?></td>
                                                <td><?php echo $result['batch']; ?></td>
                                                <td><?php echo $result['semester']; ?></td>
                                                <td><span class="label label-success"><b><?php echo $fm->getSemesterType($result['offer_date']); ?></b></span></td>
                                                <td><?php echo $fm->formatDate($result['offer_date']); ?></td>
                                                <td><?php echo $fm->formatDate($result['registration_end']); ?></td>
                                                <td>
                                                <a target="_blank" href="view-offer-details.php?oid=<?php echo $result['id']; ?>"><span class="label label-primary"><i class="fas fa-eye"></i></span></a>
                                                </td>
                                                <td>
                                                    <form method="post" action="">
                                                        <input type="date" class="form-control" id="extend_date" name="extend_date">
                                                        <input type="hidden" name="extend_id" value="<?php echo $result['id'];?>">
                                                        <input type="submit" name="extend" value="extend">
                                                    </form>
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
<script>
   
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("extend_date")[0].setAttribute('min', today);
	
	//extend max 10 days

	var date1 = new Date(); // Now
date1.setDate(date1.getDate() + 10); // Set now + 10 days as the new date
var extendMax = date1.toISOString().split('T')[0];
console.log(extendMax);

   document.getElementById("extend_date").setAttribute("max", extendMax);
	
    
	
</script>



<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
 $getPendingReg = $admin->getPendingRegistration();
 $totalStudent = $admin->getTotalStudent();
 $totalChairmen = $admin->getTotalChairmen();
 $totalSupervisor = $admin->getTotSupervisor();
 $totalAccountant = $admin->getTotalAccountant();
?>
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
       
        <div class="row">
            <!-- Column -->
            <div class="col-md-4 col-lg-4 col-xlg-3">
                <a href="student-list.php"> <div class="card card-hover">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                            <h5 class="text-white">
                                <?php
                                    if(isset($totalStudent)){
                                        echo $totalStudent;
                                    }
                                ?>
                            </h5>
                            <h5 class="text-white">Total Student</h5>
                        </div>
                    </div> </a>
            </div>
            <!-- Column -->
            <?php
                if (Session::get("user_type") == '1') {
                    ?>
            <div class="col-md-4 col-lg-4 col-xlg-3">
                <a href="manage-staff.php"> <div class="card card-hover">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                            <h5 class="text-white">
                                <?php
                                    if(isset($totalChairmen)){
                                        echo $totalChairmen;
                                    }
                                ?>
                            </h5>
                            <h5 class="text-white">Total Chairmen</h5>
                        </div>
                    </div> 
                </a>
            </div>
            
            <div class="col-md-4 col-lg-4 col-xlg-3">
                <a href="manage-staff.php"> <div class="card card-hover">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                            <h5 class="text-white">
                                <?php
                                 if(isset($totalSupervisor)){
                                    echo $totalSupervisor;
                                 }
                                ?>
                            </h5>
                            <h5 class="text-white">Total Advisor</h5>
                        </div>
                    </div> </a>
            </div>
            <!-- <div class="col-md-4 col-lg-3 col-xlg-3">
                <a href="manage-staff.php"> <div class="card card-hover">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                            <h5 class="text-white"> 
                            <?php
                                //  if(isset($totalAccountant)){
                                //     echo $totalAccountant;
                                //  }
                                ?>
                            </h5>
                            <h5 class="text-white">Total Accountant</h5>
                        </div>
                    </div> </a>
            </div> -->
            <?php } ?>
            <?php
                if (Session::get("user_type") == '3' || Session::get("user_type") == '2') {
                    ?>
                <div class="col-md-4 col-lg-4 col-xlg-3">
                   <a href="pending-registration.php"> <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                            <h5 class="text-white">
                                <?php
                                 if(isset($getPendingReg)){
                                    echo $getPendingReg;
                                 }
                                ?>
                            </h5>
                            <h5 class="text-white">Pending Registration</h5>
                        </div>
                    </div> </a>
                </div>
            <?php } ?>
        </div>
          
    </div>
    <?php include 'footer.php'; ?>
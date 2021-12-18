<?php
ob_start();
include 'core/Session.php';
Session::init();
Session::checkLogin();

include 'core/Database.php';
include'core/Format.php';
include'class/Student.php';

$student = new Student();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['student_id']) && isset($_POST['Pass'])) {
        $student_id = $_POST['student_id'];
        $pass = $_POST['Pass'];
        $loginChk = $student->userLogin($student_id, $pass);
    }
}
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/sfu.ico">
    <title>Login | Stamford University Bangladesh</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
</head>

<body background="class.jpg">
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <!--<div class="auth-box bg-dark border-top border-secondary">-->
                <div id="loginform">
                    <div class="text-center p-t-20 p-b-20">
                         <span class="db">
                            <?php
//                            $GetLogo = $student->getLogo();
//                            if ($GetLogo) {
//                                $result = $GetLogo->fetch_assoc();
                                ?>
                             <img class="rounded-circle" src="assets/images/logo.jpeg" width="110" height="110" alt="logo" data-toggle="tooltip" data-placement="top" title="Stamford University Bangladesh" data-original-title="logo" />
                                <?php // } ?>
                            </span>
                        <span style="color:#e81848;font-size:18px;">
                                <?php
                                if (isset($loginChk)) {
                                    echo $loginChk;
                                }
                                ?>
                            </span><br>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="loginform" action="" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="student_id" class="form-control form-control-lg" placeholder="Student ID" aria-label="Username" aria-describedby="basic-addon1" autocomplete="off" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" name="Pass" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                        </div>
                        <!--<div class="row border-top border-secondary">-->
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <a class="btn btn-info" href="../index.php" id="to-login" name="action">Back</a>
                                        <a class="btn btn-primary" href="reg/index.php" id="to-login" name="action">Sign Up</a>
                                        <button type="submit" class="btn btn-success float-right">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){
        
        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
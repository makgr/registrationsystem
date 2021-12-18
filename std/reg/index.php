<!DOCTYPE html>
<?php
include '../core/Database.php';
include'../core/Format.php';
include'../class/Student.php';
$student = new Student();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $reg = $student->studentSignup($_POST);
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <title>Sign Up | Stamford University Bangladesh</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/sfu.ico">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .register{
                background: -webkit-linear-gradient(left, #3931af, #00c6ff);
                margin-top: 3%;
                padding: 3%;
            }
            .register-left{
                text-align: center;
                color: #fff;
                margin-top: 4%;
            }
            .register-left input{
                border: none;
                border-radius: 1.5rem;
                padding: 2%;
                width: 60%;
                background: #f8f9fa;
                font-weight: bold;
                color: #383d41;
                margin-top: 30%;
                margin-bottom: 3%;
                cursor: pointer;
            }
            .register-right{
                background: #f8f9fa;
                border-top-left-radius: 10% 50%;
                border-bottom-left-radius: 10% 50%;
            }
            .register-left img{
                margin-top: 15%;
                margin-bottom: 5%;
                width: 25%;
                -webkit-animation: mover 2s infinite  alternate;
                animation: mover 1s infinite  alternate;
            }
            @-webkit-keyframes mover {
                0% { transform: translateY(0); }
                100% { transform: translateY(-20px); }
            }
            @keyframes mover {
                0% { transform: translateY(0); }
                100% { transform: translateY(-20px); }
            }
            .register-left p{
                font-weight: lighter;
                padding: 12%;
                margin-top: -9%;
            }
            .register .register-form{
                padding: 10%;
                margin-top: 10%;
            }
            .btnRegister{
                float: right;
                margin-top: 10%;
                border: none;
                border-radius: 1.5rem;
                padding: 2%;
                background: #0062cc;
                color: #fff;
                font-weight: 600;
                width: 50%;
                cursor: pointer;
            }
            .register .nav-tabs{
                margin-top: 3%;
                border: none;
                background: #0062cc;
                border-radius: 1.5rem;
                width: 28%;
                float: right;
            }
            .register .nav-tabs .nav-link{
                padding: 2%;
                height: 34px;
                font-weight: 600;
                color: #fff;
                border-top-right-radius: 1.5rem;
                border-bottom-right-radius: 1.5rem;
            }
            .register .nav-tabs .nav-link:hover{
                border: none;
            }
            .register .nav-tabs .nav-link.active{
                width: 100px;
                color: #0062cc;
                border: 2px solid #0062cc;
                border-top-left-radius: 1.5rem;
                border-bottom-left-radius: 1.5rem;
            }
            .register-heading{
                text-align: center;
                margin-top: 8%;
                margin-bottom: -15%;
                color: #495057;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container register">
            <div class="row">
                <div class="col-md-3 register-left">
                    <img src="images/logo.jpeg" alt=""/>
                    <h3>Stamford University Bangladesh</h3>
                    <br><a class="btn btn-success" href="../index.php" id="to-login" name="action">Login</a><br/>
                </div>
                <div class="col-md-9 register-right">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Sign Up Online Today!</h3>
                            <h4 class="register-heading">
                                <?php
                                if (isset($reg)) {
                                    echo $reg;
                                }
                                ?>
                            </h4>
                            <form action="" method="post">
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="student_name" pattern="[A-Z a-z]+" title="Allow only text" placeholder="Fullname" required autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="student_id" placeholder="Student ID" required autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" placeholder="Password" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="student_email" class="form-control" placeholder="Your Email" required autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="program" value="CSE" pattern="[A-Za-z]+" title="Allow only text" placeholder="Program" autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="batch" pattern="[0-9]+" title="Allow only number" placeholder="Batch" autocomplete="off"/>
                                        </div>
                                        <input type="submit" class="btnRegister" name="add"  value="Register"/>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div align="center">
                <span style="color: #f8f9fa;margin-top:10px;display: inline-block;">Student sign up form. All rights reserved. <a target="_blank" href="#" style="color: #fff;"></a></span>
            </div>
        </div>
        <script type="text/javascript">

        </script>
    </body>
</html>

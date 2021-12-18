<?php
    error_reporting(0);
    include '../core/Database.php';
    include '../core/Format.php';
    include '../class/Admin.php';
    $objAdmin = new Admin();
    $student = $_POST['student'];

    $sql = "SELECT *  FROM `student` WHERE id = '$student'";
    $result = $objAdmin->fetchRows($sql);
    
    $mobile = $result[0]['mobile'];
    
    echo $mobile;
?>


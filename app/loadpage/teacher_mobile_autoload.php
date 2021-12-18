<?php
    error_reporting(0);
    include '../core/Database.php';
    include '../core/Format.php';
    include '../class/Admin.php';
    $objAdmin = new Admin();
    $teacher = $_POST['teacher'];

    $sql = "SELECT *  FROM `staff` WHERE id = '$teacher'";
    $result = $objAdmin->fetchRows($sql);
    
    $mobile = $result[0]['mobile'];
    
    echo $mobile;
?>


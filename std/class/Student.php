<?php

class Student {

    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getOneCol($col, $tbl, $comCol, $comVal) {
        // $db_connect = $this->__construct();

        $sql = "SELECT $col FROM $tbl WHERE $comCol='$comVal' ";
        $res = $this->db->select($sql);

        if ($res) {
            $result = $this->db->select($sql);
            $row = $result->fetch_assoc();
            return $row[$col];
        }
    }

    public function fetchRows($sql) {
        //$db_connect = $this->__construct();
        $arr = array();
        if ($this->db->select($sql)) {
            $res = $this->db->select($sql);
            while ($row = mysqli_fetch_array($res)) {
                $arr[] = $row;
            }
            return $arr;
        }
    }

    public function studentSignup($data) {

        $student_name = mysqli_real_escape_string($this->db->link, $data['student_name']);
        $student_id = mysqli_real_escape_string($this->db->link, $data['student_id']);
        $student_email = mysqli_real_escape_string($this->db->link, $data['student_email']);
        $program = mysqli_real_escape_string($this->db->link, $data['program']);
        $batch = mysqli_real_escape_string($this->db->link, $data['batch']);
        $student_password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($student_name == "" || $student_id == "" || $student_password == "" || $student_email == "" || $program == "" || $batch == "") {

            $msg = "
                   <div class='alert alert-danger'>
                      <h4> Field can not be empty. </h4>
                   </div>";

            return $msg;
        } else {

            $stdquery = "SELECT * FROM students WHERE student_id = '$student_id' LIMIT 1";

            $typechk = $this->db->select($stdquery);
            if ($typechk != false) {

                $msg = "<div class='alert alert-danger'>Student already exits.</div>";

                return $msg;
            } else {

                $query = "INSERT INTO `students`( `student_name`, `student_id`, `student_password`, `program`, `batch`, `student_email`)
                          VALUES
                        ('$student_name','$student_id','$student_password','$program','$batch','$student_email')";

                $typeinsert = $this->db->insert($query);

                if ($typeinsert) {
                    header("Refresh:2; url = ../index.php");
                    $msg = "<div class='alert alert-success'>
                              <h4>Sign up successful. Now login with Student ID & Password.</h4>
			</div>";
                    return $msg;
                } else {
                    $msg = "
			<div class='alert alert-danger'>
                           <h3>Sign up Failed. Try Again.</h3>
			</div>";

                    return $msg;
                }
            }
        }
    }

    public function userLogin($student_id, $pass) {

        $student_id = $this->fm->validation($student_id);

        $pass = $this->fm->validation($pass);

        $student_id = mysqli_real_escape_string($this->db->link, $student_id);

        $pass = mysqli_real_escape_string($this->db->link, md5($pass));

        if (empty($student_id) || empty($pass)) {

            $loginmsg = "Username or password can not be empty";

            return $loginmsg;
        } else {

            $query = "SELECT * FROM students WHERE student_id = '$student_id' AND student_password = '$pass'";

            $result = $this->db->select($query);

            if ($result != false) {

                $value = $result->fetch_assoc();

                Session::set("stdlogin", true);

                Session::set("user_id", $value['id']);

                Session::set("student_id", $value['student_id']);

                Session::set("name", $value['student_name']);

                Session::set("email", $value['student_email']);
                Session::set("phone", $value['student_contact']);
                Session::set("reg_status", $value['status']);
                Session::set("std_batch", $value['batch']);


                header('Location: dashboard.php');
            } else {

                $loginmsg = "Something Wrong.";

                return $loginmsg;
            }
        }
    }
    
    public function updatePas($OldPassword, $NewPassword, $user_id) {

        $OldPassword = mysqli_real_escape_string($this->db->link, $OldPassword);

        $NewPassword = mysqli_real_escape_string($this->db->link, md5($NewPassword));

        if (empty($OldPassword) || empty($NewPassword)) {

            $msg = '<div class="alert alert-danger">

		     <h4 align="center">Field can not be empty.</h4>
		   </div>';

            return $msg;
        } else {

            $passquery = "SELECT * FROM students WHERE id = '$user_id' AND student_password = '$OldPassword'";

            $passchk = $this->db->select($passquery);

            if ($passchk == false) {
                $msg = '
			<div class="alert alert-danger" style="text-align:center;">
			  <h4>Old passwords do not match.</h4>
			</div>
			 ';
                return $msg;
            } else {
                $query = "UPDATE students 
			      SET student_password = '$NewPassword'
			    WHERE id = '$user_id'
			";

                $passupdate = $this->db->update($query);

                if ($passupdate) {

                    $msg = '<div class="alert alert-success">
				<h4 align="center">Password updated successfully.</h4>
			    </div>';

                    return $msg;
                } else {

                    $msg = '<div class="alert alert-danger">
				<h4>Failed to Update Password</h4>
			</div>';

                    return $msg;
                }
            }
        }
    }

    public function getStuInfo($sid) {
        $query = "SELECT * FROM students WHERE id = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getStuInfoById($user_id) {
        $query = "SELECT * FROM students WHERE id = '$user_id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateStuInfo($data) {

        $user_id = mysqli_real_escape_string($this->db->link, $data['user_id']);
        $student_name = mysqli_real_escape_string($this->db->link, $data['student_name']);
        $student_email = mysqli_real_escape_string($this->db->link, $data['student_email']);
        $student_contact = mysqli_real_escape_string($this->db->link, $data['student_contact']);
        $student_address = mysqli_real_escape_string($this->db->link, $data['student_address']);
        $student_dob = mysqli_real_escape_string($this->db->link, date('Y-m-d', strtotime($data['student_dob'])));


        
        if ($student_name == "" || $student_email == "" || $student_contact == "") {

            $msg = "
                    <div class='alert alert-danger'>
                      <h4> Field can not be empty.</h4>
                   </div>";

            return $msg;
        } else {
            $query = "UPDATE students 
			          SET student_name  = '$student_name',
                      student_dob = '$student_dob',
                      student_email  = '$student_email',
                      student_contact  = '$student_contact',
                      student_address  = '$student_address'
					 WHERE id = '$user_id'
					 ";

                $infoupdate = $this->db->update($query);

                if ($infoupdate) {

                    $_SESSION['message'] = "<div class='alert alert-success' style='text-align:center;'>

                                   <h4>Information updated successfully.</h4>

				</div>";
                    header('Location: add-information.php');
                    exit();
                } else {

                    $_SESSION['message'] = "<div class='alert alert-success' style='text-align:center;'><h4>Failed to Update.</h4></div>";
                    header('Location: add-information.php');
                    exit();
                }
        }
    }

    public function getAllRegistrationForm(){
        $batch = Session::get("std_batch");
        $query = "SELECT * FROM offered_courses_info WHERE deletion_status = '0' AND batch >= '$batch' AND registration_end >= date(now())";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOfferedCourseInfo($oid) {

        $query = "SELECT * FROM offered_courses_info WHERE deletion_status = 0 AND id = '$oid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getOfferedCourseList($oid) {

        $query = "SELECT * FROM offered_courses WHERE deletion_status = 0 AND common_id = '$oid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function applyForRegistration($applyId,$user_id){
        $apply_date = date('Y-m-d');

        $checkAppliedCreditQuery = "SELECT SUM(courseCredit) as appCrdt FROM `registered_course` WHERE status = 0";
        $checkAppliedCreditQueryRes = $this->db->select($checkAppliedCreditQuery);
        $resRow = mysqli_fetch_assoc($checkAppliedCreditQueryRes);

        if($resRow['appCrdt'] > 18){
            $_SESSION['insmsg'] = "<div class='alert alert-danger'>
                                      <h5>You can not apply more than 18 credits.</h5>
                                  </div>";
                            header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
                            exit();
             }
      

        $checkquery = "SELECT * FROM registration_info WHERE offer_id = '$applyId' AND student_ID = '$user_id' AND deletion_status = 0 LIMIT 1";

            $typechk = $this->db->select($checkquery);
            if ($typechk != false) {

                $_SESSION['applyMessage'] = "
                            <div class='alert alert-danger'>
                                        <h3> Already Applied. </h3>
                            </div>";
                            header('Location: available-registration.php');
                            exit();
            }else{
                
        $query = "INSERT INTO `registration_info`( `offer_id`, `student_ID`,`apply_date`) VALUES ('$applyId','$user_id','$apply_date')";
        $apply = $this->db->insert($query);
        if ($apply) {
            $id = mysqli_insert_id($this->db->link);
            return $id;
            
        } else {
            $msg = "
                <div class='alert alert-danger'>
                    <h3> Failed to offer course. </h3>
                </div>";

            return $msg;
           
        }
            }

    }

    public function getAppliedRegistrationList($user_id){
        
        $query = "SELECT * FROM registration_info WHERE deletion_status = '0' AND student_ID = '$user_id' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function registeredCourses($id,$apply,$user_id){
        $credit = $this->getOneCol('course_credit','courses','id',$id);

        $query = "INSERT INTO `registered_course`(`student_id`, `course_id`,`courseCredit`, `registration_id`) VALUES ('$user_id','$id','$credit','$apply')";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAppliedCourseList($aid) {

        $query = "SELECT * FROM registered_course WHERE deletion_status = 0 AND registration_id = '$aid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function alreadyAppliedOrNot($applyId,$user_id){

        $checkquery = "SELECT * FROM registration_info WHERE offer_id = '$applyId' AND student_ID = '$user_id' AND deletion_status = 0 LIMIT 1";

            $typechk = $this->db->select($checkquery);
            if ($typechk != false) {
                return 1;
            }
    }

    

}
?>


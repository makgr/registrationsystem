<?php

class Admin {

    private $db;
    private $fm;

    public function __construct() {

        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getOneCol($col, $tbl, $comCol, $comVal) {
        $sql = "SELECT $col FROM $tbl WHERE $comCol='$comVal' ";
        $res = $this->db->select($sql);


        if ($res) {
            $result = $this->db->select($sql);
            $row = $result->fetch_assoc();
            return $row[$col];
        }
    }

    public function fetchRows($sql) {
        $arr = array();
        if ($this->db->select($sql)) {
            $res = $this->db->select($sql);
            while ($row = mysqli_fetch_array($res)) {
                $arr[] = $row;
            }
            return $arr;
        }
    }


    public function userLogin($Email, $pass) {

        $Email = $this->fm->validation($Email);

        $pass = $this->fm->validation($pass);

        $Email = mysqli_real_escape_string($this->db->link, $Email);

        $pass = mysqli_real_escape_string($this->db->link, md5($pass));

        if (empty($Email) || empty($pass)) {

            $loginmsg = "Username or password can not be empty";

            return $loginmsg;
        } else {

            $query = "SELECT * FROM users WHERE user_email = '$Email' AND user_password = '$pass'";

            $result = $this->db->select($query);

            if ($result != false) {

                $value = $result->fetch_assoc();

                Session::set("userlogin", true);

                Session::set("user_id", $value['id']);

                Session::set("user_name", $value['user_fullname']);
                Session::set("user_type", $value['user_type']);
                Session::set("email", $value['user_email']);
                Session::set("advisor_batch", $value['advisor_batch']);

                header('Location: dashboard.php');
            } else {

                $loginmsg = "Username or password not matched.";

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

            $passquery = "SELECT * FROM users WHERE id = '$user_id' AND user_password = '$OldPassword'";

            $passchk = $this->db->select($passquery);

            if ($passchk == false) {
                $msg = '
			<div class="alert alert-danger" style="text-align:center;">
			  <h4>Old passwords do not match.</h4>
			</div>
			 ';
                return $msg;
            } else {
                $query = "UPDATE users 
			      SET user_password = '$NewPassword'
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

    public function addStaff($data) {

        $user_type = mysqli_real_escape_string($this->db->link, $data['user_type']);
        $user_fullname = mysqli_real_escape_string($this->db->link, $data['user_fullname']);
        $user_designation = mysqli_real_escape_string($this->db->link, $data['user_designation']);
        $user_email = mysqli_real_escape_string($this->db->link, $data['user_email']);
        $advisor_batch = mysqli_real_escape_string($this->db->link, $data['advisor_batch']);
        $user_password = mysqli_real_escape_string($this->db->link, md5($data['user_password']));

        if (!preg_match('/^[\p{L} ]+$/u', $user_fullname)){
            
            $msg = "<div class='alert alert-danger'>
                      <h4> Full Name must contain letters and spaces only! </h4>
                   </div>";

            return $msg;
          }
          if ($user_type == 3 && $advisor_batch == ""){
            
            $msg = "<div class='alert alert-danger'>
                      <h4> Advisor batch can not be empty!</h4>
                   </div>";

            return $msg;
          }

          if ($advisor_batch != ""){
            $batchquery = "SELECT * FROM users WHERE user_type = '3' AND advisor_batch = '$advisor_batch' LIMIT 1";

            $batchchk = $this->db->select($batchquery);
            if ($batchchk != false) {

                $msg = "<div class='alert alert-danger'>Batch already assigned.</div>";

                return $msg;
            }
          }

          
        if ($user_type == "" || $user_fullname == "" || $user_designation == "" || $user_password == "" || $user_email == "") {

            $msg = "<div class='alert alert-danger'>
                      <h4> Field can not be empty </h4>
                   </div>";

            return $msg;
        } else {

            $typequery = "SELECT * FROM users WHERE user_email = '$user_email' LIMIT 1";

            $typechk = $this->db->select($typequery);
            if ($typechk != false) {

                $msg = "<div class='alert alert-danger'>User already exits.</div>";

                return $msg;
            } else {
                $userQuery = "INSERT INTO `users`(`user_fullname`, `user_email`, `user_password`, `user_type`, `user_designation`, `advisor_batch`) 
                VALUES ('$user_fullname','$user_email','$user_password','$user_type','$user_designation','$advisor_batch')";
                    $userinsert = $this->db->insert($userQuery);
                    if ($userinsert) {
                        $msg = "<div class='alert alert-success'>
                                        <h4>User added successfully</h4>
                        </div>";
                        return $msg;
                    } else {
                        $msg = "
                            <div class='alert alert-danger'>
                                <h3> Failed to add User. </h3>
                            </div>";

                        return $msg;
                    }
            }
        }
    }

    public function getAllStaff() {

        $query = "SELECT * FROM users WHERE deletion_status = 0 AND user_email != 'admin@mail.com'";

        $result = $this->db->select($query);

        return $result;
    }

    public function deleteStaff($id) {
        $query = "UPDATE users SET 
			deletion_status='1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url=manage-staff.php");
            $msg = "<div class='alert alert-success'>
                              <h4>User deleted successfully</h4>
						</div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
                          <h3> Failed to delete user. </h3>
		</div>";

            return $msg;
        }
    }

    public function getStaffById($sid) {

        $query = "SELECT * FROM users WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function updateUser($data, $sid) {
        $user_type = mysqli_real_escape_string($this->db->link, $data['user_type']);
        $user_fullname = mysqli_real_escape_string($this->db->link, $data['user_fullname']);
        $user_designation = mysqli_real_escape_string($this->db->link, $data['user_designation']);
        $user_email = mysqli_real_escape_string($this->db->link, $data['user_email']);
        $advisor_batch = mysqli_real_escape_string($this->db->link, $data['advisor_batch']);

        if ($user_type == 3 && $advisor_batch == ""){
            
            $msg = "<div class='alert alert-danger'>
                      <h4> Advisor batch can not be empty!</h4>
                   </div>";

            return $msg;
          }

        if ($user_type == "" || $user_fullname == "" || $user_designation == "" || $user_email == "") {

            $msg = "<div class='alert alert-danger'>
                      <h4> Field can not be empty </h4>
                   </div>";

            return $msg;
        } else {

            $uequery = "SELECT * FROM users WHERE user_email = '$user_email' AND id != '$sid'";

            $uechk = $this->db->select($uequery);
            if ($uechk != false) {

                $msg = "<div class='alert alert-danger'>User email already exits.</div>";

                return $msg;
            }else{
                $query = "UPDATE users SET 
			user_fullname = '$user_fullname',
			user_email = '$user_email',
            user_type = '$user_type',
			user_designation = '$user_designation',
			advisor_batch = '$advisor_batch'
			WHERE id = '$sid'";

            $result = $this->db->update($query);
            if ($result) {
                $_SESSION['message'] = "<div class='alert alert-success'>
                              <h4>User updated successfully</h4>
			</div>";
            header('Location: manage-staff.php');
                    exit();
                
            } else {
                $_SESSION['message'] = "
			<div class='alert alert-danger'>
                           <h3> Failed to update user. </h3>
			</div>";
            header('Location: manage-staff.php');
            exit();
               
            }
            }

            
        }
    }

    public function getStaffInfo($sid) {

        $query = "SELECT * FROM users WHERE deletion_status = 0 AND id = '$sid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function addCourse($data) {
        $course_name = mysqli_real_escape_string($this->db->link, $data['course_name']);
        $course_code = mysqli_real_escape_string($this->db->link, $data['course_code']);
        $course_credit = mysqli_real_escape_string($this->db->link, $data['course_credit']);
        $program = mysqli_real_escape_string($this->db->link, $data['program']);
        $prerequisite_course = mysqli_real_escape_string($this->db->link, $data['prerequisite_course']);
        $course_teacher = mysqli_real_escape_string($this->db->link, $data['course_teacher']);
        $course_semester = mysqli_real_escape_string($this->db->link, $data['course_semester']);

        if (!preg_match('/^[\p{L} ]+$/u', $course_teacher)){
            $msg = "
                    <div class='alert alert-danger'>
                      <h4> Course teacher name must contain letters and spaces only!. </h4>
                   </div>";

            return $msg;
          }


        if ($course_name == "" || $course_code == "" || $course_credit == "" || $program == "" || $course_teacher == "" || $course_semester == "") {

            $msg = "
                    <div class='alert alert-danger'>
                      <h4> Field can not be empty. </h4>
                   </div>";

            return $msg;
        } else {
            $subjectquery = "SELECT * FROM courses WHERE course_name = '$course_name' AND course_code = '$course_code' LIMIT 1";

            $subjectchk = $this->db->select($subjectquery);
            if ($subjectchk != false) {

                $msg = "<div class='alert alert-danger'><h4>Course already exits.</h4></div>";

                return $msg;
            } else {
                $query = "INSERT INTO `courses`(`course_name`, `course_code`, `course_credit`, `program`,`prerequisite_course`,`course_teacher`, `course_semester`) 
                VALUES  ('$course_name','$course_code','$course_credit','$program','$prerequisite_course','$course_teacher','$course_semester')";

                $subinsert = $this->db->insert($query);

                if ($subinsert) {
                    $_SESSION['courseMessage'] = "<div class='alert alert-success'>
                                  <h4>Course added successfully.</h4>
                </div>";
                header('Location: add-course.php');
                        exit();
                    
                } else {
                    $_SESSION['courseMessage'] = "
                <div class='alert alert-danger'>
                               <h3> Failed. </h3>
                </div>";
                header('Location: add-course.php');
                exit();
                   
                }
            }
        }
    }

    public function getAllCourse() {
        $query = "SELECT * FROM courses WHERE deletion_status = 0";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteCourse($id) {
        $query = "UPDATE courses SET 
			deletion_status = '1'
			WHERE id = '$id'";

        $result = $this->db->update($query);
        if ($result) {
            header("Refresh:1; url= manage-course.php");
            $msg = "<div class='alert alert-success'>
                              <h4>Course deleted successfully.</h4>
		    </div>";
            return $msg;
        } else {
            $msg = "
		<div class='alert alert-danger'>
                          <h3> Failed to delete course. </h3>
		</div>";
            return $msg;
        }
    }

    public function getCourseById($sid) {
        $query = "SELECT * FROM courses WHERE deletion_status = 0 AND id = '$sid'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateSubject($data, $sid) {

        $sid = mysqli_real_escape_string($this->db->link, $sid);
        $course_name = mysqli_real_escape_string($this->db->link, $data['course_name']);
        $course_code = mysqli_real_escape_string($this->db->link, $data['course_code']);
        $course_credit = mysqli_real_escape_string($this->db->link, $data['course_credit']);
        $program = mysqli_real_escape_string($this->db->link, $data['program']);
        $prerequisite_course = mysqli_real_escape_string($this->db->link, $data['prerequisite_course']);
        $course_teacher = mysqli_real_escape_string($this->db->link, $data['course_teacher']);
        $course_semester = mysqli_real_escape_string($this->db->link, $data['course_semester']);



        if ($course_name == "" || $course_code == "" || $course_credit == "" || $program == "" || $course_teacher == "" || $course_semester == "") {

            $msg = "
                    <div class='alert alert-danger'>
                      <h4> Field can not be empty. </h4>
                   </div>";

            return $msg;
        } else {

            $query = "UPDATE courses 
			       SET course_name = '$course_name',course_code = '$course_code',course_credit = '$course_credit', program = '$program', prerequisite_course = '$prerequisite_course', course_teacher = '$course_teacher', course_semester = '$course_semester'
				   WHERE id = '$sid'";

            $updated_row = $this->db->update($query);

            if ($updated_row) {
                $_SESSION['courseUpdateMessage'] = "<div class='alert alert-success'>
                              <h4>Course updated successfully.</h4>
            </div>";
            header('Location: manage-course.php');
                    exit();
                
            } else {
                $_SESSION['courseUpdateMessage'] = "
            <div class='alert alert-danger'>
                           <h3> Failed. </h3>
            </div>";
            header('Location: manage-course.php');
            exit();
               
            }
        }
    }

    public function offerCourseInformation($data,$user_id){
        $program = mysqli_real_escape_string($this->db->link, $data['program']);
        $batch = mysqli_real_escape_string($this->db->link, $data['batch']);
        $semester = mysqli_real_escape_string($this->db->link, $data['semester']);
        $offer_date = date('Y-m-d');
        $registration_end = mysqli_real_escape_string($this->db->link, date("Y-m-d", strtotime($data['registration_end'])));
        $cur_date = date('Y-m-d');

        $checkQuery = "SELECT * FROM offered_courses_info WHERE program = '$program' AND batch = '$batch' AND semester = '$semester' AND registration_end > '$cur_date' AND deletion_status = 0 LIMIT 1";

            $chk = $this->db->select($checkQuery);
            if ($chk != false) {

                $_SESSION['message'] = "<div class='alert alert-danger'>Already Offered.</div>";
                        header('Location: offer-course.php');
                        exit();
            } else {
                $query = "INSERT INTO `offered_courses_info`(`program`, `batch`, `semester`, `offer_date`,`registration_end`, `user_id`) 
                   VALUES ('$program','$batch','$semester','$offer_date','$registration_end','$user_id')";

                $subinsert = $this->db->insert($query);

                if ($subinsert) {

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

    public function offeredCourses($id,$offerCourseInfo,$user_id){
        $query = "INSERT INTO `offered_courses`(`course_id`, `common_id`, `user_id`) 
               VALUES ('$id','$offerCourseInfo','$user_id')";

                $subinsert = $this->db->insert($query);
                return $subinsert;
    }

    public function getAllOffer() {
        $query = "SELECT * FROM offered_courses_info WHERE deletion_status = 0 AND registration_end >= DATE(NOW()) ORDER BY id DESC";
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

    public function getAllExpiredOffer() {
        $query = "SELECT * FROM offered_courses_info WHERE deletion_status = 0 AND registration_end < DATE(NOW()) ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllStudent() {

        $query = "SELECT * FROM students";

        $result = $this->db->select($query);

        return $result;
    }

    public function changeStatusToPending($stpid) {
        $query = "UPDATE students SET 
			status='0'
			WHERE id = '$stpid'";

        $result = $this->db->update($query);
        if ($result) {
            $_SESSION['message'] = "<div class='alert alert-success'>
                          <h4>Updated successfully.</h4>
        </div>";
        header('Location: student-list.php');
                exit();
            
        } else {
            $_SESSION['message'] = "
        <div class='alert alert-danger'>
                       <h3> Failed. </h3>
        </div>";
        header('Location: student-list.php');
        exit();
           
        }
    }

    public function changeStatusToOk($stoid) {
        $query = "UPDATE students SET 
			status='1'
			WHERE id = '$stoid'";

        $result = $this->db->update($query);
        if ($result) {
            $_SESSION['message'] = "<div class='alert alert-success'>
                          <h4>Updated successfully.</h4>
        </div>";
        header('Location: student-list.php');
                exit();
            
        } else {
            $_SESSION['message'] = "
        <div class='alert alert-danger'>
                       <h3> Failed. </h3>
        </div>";
        header('Location: student-list.php');
        exit();
           
        }
    }

    public function getPendingRegistration(){
        $query = "SELECT * FROM registration_info WHERE deletion_status = 0 AND status = 0";

        $result = $this->db->select($query);
        if($result){
            $total = mysqli_num_rows($result);
            return $total;
        }else{
            return 0;
        }
        
    }

    public function getPendingRegistrationList(){
        $query = "SELECT * FROM registration_info WHERE deletion_status = 0 AND status = 0";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAppliedCourseList($aid) {

        $query = "SELECT * FROM registered_course WHERE deletion_status = 0 AND registration_id = '$aid'";

        $result = $this->db->select($query);

        return $result;
    }

    public function getPreRequisiteInfo($student_ID,$prid){
        $query = "SELECT * FROM registered_course WHERE deletion_status = 0 AND student_id = '$student_ID' AND course_id = '$prid' AND status = 1";
        $result = $this->db->select($query);
        if($result != FALSE){
            return 'Done';
        }else{
            return 'Not Done';
        }
    }

    public function getPreRequisiteCourseInfo($rid,$stdId){
         $query = "SELECT * FROM registered_course WHERE deletion_status = 0 AND student_id = '$stdId' AND registration_id = '$rid' AND status = 1";
        
         $result = $this->db->select($query);
         return $result;
        // exit();
        // // while($info = $result->fetch_assoc()){
        //     if($result){
        //         while($info = mysqli_fetch_assoc($result)){
        //             $course = $info['course_id'];
        //             $preRequisite = $this->getOneCol('prerequisite_course','courses','id',$course);
        //             if($preRequisite != 0){
        //                 $chkPreQuery = "SELECT * FROM registered_course WHERE deletion_status = 0 AND student_id = '$stdId' AND registration_id = '$rid' AND course_id = '$preRequisite' AND status = 1";
        //                 $resultchkPreQuery = $this->db->select($chkPreQuery);
        //                 if($resultchkPreQuery != FALSE){
        //                     return '1';
        //                 }else{
        //                     return '0';
        //                 }
        //             }
                    
        //         }
        //     }
            
    }

    public function registrationApprov($aplid,$StdID){
        $query = "UPDATE registration_info 
			       SET status = '1' WHERE id = '$aplid'";

            $updated_row = $this->db->update($query);
            if($updated_row){
                $crsquery = "UPDATE registered_course 
			       SET status = '1' WHERE registration_id = '$aplid' AND student_id = '$StdID' AND status != '2'";
                   $updated_row_crs = $this->db->update($crsquery);
            }
            if ($updated_row) {
                $_SESSION['statusChangeMessage'] = "<div class='alert alert-success'>
                              <h4>Approved successfully.</h4>
            </div>";
            header('Location: pending-registration.php');
                    exit();
                
            } else {
                $_SESSION['statusChangeMessage'] = "
            <div class='alert alert-danger'>
                           <h3> Failed. </h3>
            </div>";
            header('Location: pending-registration.php');
            exit();
               
            }
    }

    public function getTotalStudent(){
        $query = "SELECT * FROM students WHERE status = 1";

        $result = $this->db->select($query);
        if($result){
            $total = mysqli_num_rows($result);
            return $total;
        }else{
            return 0;
        }
        
    }

    public function getTotalChairmen(){
        $query = "SELECT * FROM users WHERE user_type = 2 AND deletion_status = 0";

        $result = $this->db->select($query);
        if($result){
            $total = mysqli_num_rows($result);
            return $total;
        }else{
            return 0;
        }
        
    }

    public function getTotSupervisor(){
        $query = "SELECT * FROM users WHERE user_type = 3 AND deletion_status = 0";

        $result = $this->db->select($query);
        if($result){
            $total = mysqli_num_rows($result);
            return $total;
        }else{
            return 0;
        }
        
    }

    public function getTotalAccountant(){
        $query = "SELECT * FROM users WHERE user_type = 4 AND deletion_status = 0";

        $result = $this->db->select($query);
        if($result){
            $total = mysqli_num_rows($result);
            return $total;
        }else{
            return 0;
        }
        
    }

    public function rejectCourse($course_id,$aid){
        $query = "UPDATE registered_course 
			       SET status = '2' WHERE course_id = '$course_id' AND registration_id = '$aid'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
               $msg = "<div class='alert alert-success'>
                              <h4>Rejected successfully.</h4>
            </div>";
            return $msg;
                
            } else {
                $msg = "
            <div class='alert alert-danger'>
                           <h3> Failed. </h3>
            </div>";
            return $msg;
               
            }
    }

    public function getApprovedRegistrationList(){
        $query = "SELECT * FROM registration_info WHERE deletion_status = 0 AND status = 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateRegistrationDate($extend_id ,$extend_date){
        $end_date = date("Y-m-d", strtotime($extend_date));
        $query = "UPDATE offered_courses_info 
			       SET registration_end = '$end_date' WHERE id = '$extend_id'";
                   $updated_row = $this->db->update($query);
                   if ($updated_row) {
                    $_SESSION['message'] = "<div class='alert alert-success'>
                                  <h4>Updated successfully.</h4>
                </div>";
                header('Location: offer-list.php');
                        exit();
                    
                } else {
                    $_SESSION['message'] = "
                <div class='alert alert-danger'>
                               <h3> Failed. </h3>
                </div>";
                header('Location: offer-list.php');
                exit();
                   
                }
    }

    public function deleteOfferCourse($deloffercourse,$oid) {

        $query = "DELETE FROM offered_courses WHERE deletion_status = 0 AND id = '$deloffercourse'";

        $result = $this->db->delete($query);

        if ($result) {
            $_SESSION['delMsg'] = "<div class='alert alert-success'>
                            <h4>Course Deleted Successfully.</h4>
                       </div>";
            header('Location:'.$_SERVER['PHP_SELF'].'?oid='.$oid);
            exit();
        } else {
            $_SESSION['delMsg'] = "<div class='alert alert-danger'>
                            <h5>Failed to delete course.</h5>
                       </div>";
          header('Location:'.$_SERVER['PHP_SELF'].'?oid='.$oid);
            exit();
        }
    }

    public function addNewOfferCourse($data,$oid,$user_id) {

        $course_id = mysqli_real_escape_string($this->db->link, $data['addNewOfferCourse']);
        $newCrsCredit = $this->getOneCol('course_credit','courses','id',$course_id);

        $checkcrdtquery = "SELECT * FROM offered_courses WHERE deletion_status = 0 AND common_id = '$oid'";

        $result = $this->db->select($checkcrdtquery);

        $totalCredit = 0;
        while ($crsIdRow = $result->fetch_assoc()) {
            $courseID = $crsIdRow['course_id'];
            $crscredit = $this->getOneCol('course_credit','courses','id',$courseID);
            $totalCredit += $crscredit;
        }

        $newTotalCredit = $newCrsCredit + $totalCredit;

       if($newTotalCredit > 18){
            $_SESSION['insmsg'] = "<div class='alert alert-danger'>
                            <h4>You can not add more than 15 credits.</h4>
                        </div>";
            header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            exit();
        
       }
       

        $userQuery = "INSERT INTO `offered_courses`(`course_id`, `common_id`, `user_id`) 
              VALUES ('$course_id','$oid','$user_id')";

           $infoinsert = $this->db->insert($userQuery);
            if ($infoinsert) {
                $_SESSION['insmsg'] = "<div class='alert alert-success'>
                                <h4>Added Successfully.</h4>
                            </div>";
                header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
                exit();
            } else {
                $_SESSION['insmsg'] = "<div class='alert alert-danger'>
                                <h5>Failed to add.</h5>
                            </div>";
                header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
                exit();
            }

    }

    public function getTotalWithdraw(){
        $query = "SELECT * FROM registered_course WHERE deletion_status = 0 AND withdraw_status = 1";

        $result = $this->db->select($query);
        if($result){
            $total = mysqli_num_rows($result);
            return $total;
        }else{
            return 0;
        }
        
    }
    public function getTotalWithdrawList(){
        $query = "SELECT * FROM registered_course WHERE deletion_status = 0 AND withdraw_status = 1 ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function approvWithdrawCourse($wid){
        $query = "UPDATE registered_course 
			          SET withdraw_status  = '2'
					 WHERE id = '$wid'
					 ";

                $infoupdate = $this->db->update($query);

                if ($infoupdate) {

                    $_SESSION['message'] = "<div class='alert alert-success' style='text-align:center;'>

                                   <h4>Approved successfully.</h4>

				</div>";
                    header('Location: withdraw-list.php');
                    exit();
                } else {

                    $_SESSION['message'] = "<div class='alert alert-success' style='text-align:center;'><h4>Failed to Update.</h4></div>";
                    header('Location: withdraw-list.php');
                    exit();
                }
    }

    public function getgetOfferedSemesterByBatch($advisorBatch){
        $query = "SELECT semester FROM offered_courses_info WHERE deletion_status = 0 AND batch = '$advisorBatch'";
        $result = $this->db->select($query);
        
        return $result;
    }

    public function getAllCourseBySemester($advisorBatch) {
        $query = "SELECT * FROM courses WHERE deletion_status = 0 AND course_semester NOT IN (SELECT semester FROM offered_courses_info WHERE deletion_status = 0 AND batch = '$advisorBatch')";
        $result = $this->db->select($query);
        return $result;
    }
    


}

?>

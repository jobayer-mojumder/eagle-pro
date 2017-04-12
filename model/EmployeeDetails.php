<?php
    class EmployeeDetails {
        public function employeeRegistration($fullname,$phone,$designation,$username,$password,$dateofbirth,$blood_group,$user_type,$company_id,$newfilename){
            include('db_connect.php');
            try {
                $assigned_status=0;
                $status=0;
                $stmt = $conn->prepare("INSERT INTO user_table (full_name, phone,dateofbirth,imageref,blood_group, cmp_id,designation,username,password,user_type,assigned_status,status)
                    VALUES (:full_name, :phone,:dateofbirth,:imageref,:blood_group,:cmp_id, :designation,:username,:password,:user_type,:assigned_status,:status)");
                $stmt->bindParam(':full_name', $fullname);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':designation', $designation);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':user_type', $user_type);
                $stmt->bindParam(':cmp_id', $company_id);
                $stmt->bindParam(':dateofbirth', $dateofbirth);
                $stmt->bindParam(':imageref', $newfilename);
                $stmt->bindParam(':blood_group', $blood_group);
                $stmt->bindParam(':assigned_status', $assigned_status);
                $stmt->bindParam(':status', $status);
                $stmt->execute();
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $newfilename);
                return  $msg = 1;
            } catch (Exception $e) {
                //echo $e->getMessage();
                return $msg = 5;
            }

        }

        function viewDetails($company_id,$designation){
            include('db_connect.php');
            $stmt = $conn->prepare("SELECT * FROM user_table WHERE cmp_id='$company_id' AND designation='$designation' ORDER BY user_id DESC LIMIT 30");
            $stmt->execute();
            $rowNo = $stmt->rowCount();
            $result = $stmt->fetchall();
            if($rowNo>0){
                return $result;
            }else{
                return $result;
            }

        }
        function viewDetailsAll($company_id){
            include('db_connect.php');
            $stmt = $conn->prepare("SELECT * FROM user_table WHERE cmp_id='$company_id' ORDER BY user_id DESC");
            $stmt->execute();
            $rowNo = $stmt->rowCount();
            $result = $stmt->fetchall();
            if($rowNo>0){
                return $result;
            }else{
                return $result;
            }

        }

        public function employeeEdit($fullname,$phone,$designation,$username,$password,$dateofbirth,$blood_group,$newfilename,$id){
            include('db_connect.php');
            try {
                $assigned_status=0;
                $status=0;
                $stmt = $conn->prepare("UPDATE user_table SET full_name = :full_name, phone = :phone, dateofbirth = :dateofbirth, imageref= :imageref, blood_group= :blood_group, designation = :designation, username = :username, password = :password WHERE user_id= :id");
                $stmt->bindParam(':full_name', $fullname);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':designation', $designation);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':dateofbirth', $dateofbirth);
                $stmt->bindParam(':imageref', $newfilename);
                $stmt->bindParam(':blood_group', $blood_group);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $newfilename);
                return  $msg = 1;
                } catch (Exception $e) {
                //echo $e->getMessage();
                return $msg = 5;
            }

        }

    }
?>

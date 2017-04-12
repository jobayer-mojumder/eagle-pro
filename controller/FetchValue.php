<?php

class FetchValue
{
    function LoginCheck($username, $password)
    {
        include('db_connect.php');
        $stmt = $conn->prepare('SELECT `username`, `password`, `full_name`,  `cmp_id`,  `user_type`, user_id FROM user_table WHERE username = :username AND password = :password UNION
                SELECT  `username`, `password`, `company_name`, `cmp_id`, `user_type`, `phone` FROM company_table WHERE username = :username AND password = :password');
        $stmt->execute(array(':username' => $username, ':password' => $password));

        if ($data = $stmt->fetch( PDO::FETCH_OBJ )) {
        
            if($data->user_type=='admin'){
                $_SESSION['username']=$data->username;
                $_SESSION['password']=$data->password;
                $_SESSION['user_type']=$data->user_type;
                $_SESSION['full_name']=$data->company_name;
                $_SESSION['cmp_id']=$data->cmp_id;
                $_SESSION['user_id']=$data->user_id;
                header('Location: '.'index.php');
                echo$data->cmp_id;
            }else  if($data->user_type=='super_admin'){
                $_SESSION['username']=$data->username;
                $_SESSION['full_name']=$data->full_name;
                $_SESSION['password']=$data->password;
                $_SESSION['user_type']=$data->user_type;
                $_SESSION['user_id']=$data->user_id;
                $_SESSION['cmp_id']=$data->cmp_id;
                header('Location: '.'index.php');
            }
            else {
                $_SESSION['cmp_id']=$data->cmp_id;
                $_SESSION['username']=$data->username;
                $_SESSION['full_name']=$data->full_name;
                $_SESSION['password']=$data->password;
                $_SESSION['user_type']=$data->user_type;
                $_SESSION['user_id']=$data->user_id;
                
                $stmt2 = $conn->prepare("SELECT post_id from post_table WHERE user_id = :user_id");
                $stmt2->bindParam(':user_id', $_SESSION['user_id']); 
                $stmt2->execute();
                if ($data2 = $stmt2->fetch( PDO::FETCH_OBJ )) {
                    $_SESSION['post_id']= $data2->post_id;                
                }
                header('Location: '.'index.php');
            }

        } else {

            $err = 1;

        }
    }

    // Salesman's all orders
    function salesmanOrderView($salesman_id){
       include('db_connect.php');
        try {

            $stmt = $conn->prepare("SELECT t2.service_name, t1.salesman_id, t1.status, t1.customer_name, t1.phone from order_table t1
                JOIN service_table as t2 on t1.service_type = t2.service_id
                WHERE t1.salesman_id = $salesman_id");
            $stmt->execute();
            $rowNo=$stmt->rowCount();
            $result = $stmt->fetchall();
            return $result;
        } catch (Exception $e) {
            return "error";
        }
    }
    
    
    // Salesman's target view
    function salesmanTargetView($salesman_id, $month){
       include('db_connect.php');
        try {
            $output = array();
            $output['achieved'] = 0;
            $output['target'] = 0;
            
            $stmt = $conn->prepare("SELECT * from achieve_table WHERE post_id = $salesman_id AND month = '$month' LIMIT 1");
            
            $stmt->execute();
            $rowNo=$stmt->rowCount();
            
            if ($rowNo != 0)
            {
                $result = $stmt->fetchall();
                $output['achieved'] = $result[0]['total'];
                
            }
            
           
            $stmt = $conn->prepare("SELECT * FROM target_table where post_id = $salesman_id AND month = '$month' LIMIT 1");
            $stmt->execute();
		    $rowNo=$stmt->rowCount();
		    
            if ($rowNo != 0)
            {
                $result = $stmt->fetchall();
                $output['target'] = $result[0]['amount'];
            }
            
            return $output;
            
        } catch (Exception $e) {
            return "error";
        }
    }
	
	function realTimeView($time){
		try{
			$stmt = $conn->prepare("SELECT * FROM monitor_table WHERE last_entry LIKE '$time%'"); 
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			$rowNo=$stmt->rowCount();
			$result = $stmt->fetchall();
			return $return;
		}catch (Exception $e) {
            return "error";
        }
	}
    
}

?>

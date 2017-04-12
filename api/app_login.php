<?php
    include('../db_connect.php');

    if(isset($_GET['username']) && isset($_GET['password'])) {
        $username= $_GET['username']; #echo $username.'<br>';
        $password= $_GET['password']; #echo $password.'<br>';

        $password = md5($password);

        $stmt = $conn->prepare('
                SELECT * FROM user_table WHERE username = :username AND password = :password');
        $stmt->execute(array(':username' => $username, 'password' => $password));


        if ($data = $stmt->fetch( PDO::FETCH_OBJ )) {				
                $username = $data->username;
                $full_name = $data->full_name;
                $user_type = $data->user_type;
                $company_id = $data->cmp_id;
                $user_id = $data->user_id;
                echo '{"status": "success"}';
                
			

    	}else{
        	echo '{"status": "error"}';
    	}
}

?>


<?php
    include('../db_connect.php');
    if(isset($_GET['user_id'])) {
        $achieve=0;
		$company_id = $_GET['cmp_id'];
        $user_id = $_GET['user_id'];
		$month=date('M'); //echo$month;
        $stmt = $conn->prepare("SELECT * FROM post_table WHERE user_id='$user_id' LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetchall();
		foreach ($result as $row) {
			$post_id=$row['post_id']; //echo$post_id;
		}
		
		//Get Achievemnt
		$stmt = $conn->prepare("SELECT * 
			FROM achieve_table
			WHERE post_id ='$post_id'
			AND MONTH =  '$month'");
		$stmt->execute();
		$result = $stmt->fetchall();
		foreach ($result as $row) {
			$achieve=$achieve+$row['total']; //echo"Ac".$achieve;
		}
		//Get Achievemnt
		$stmt3 = $conn->prepare("SELECT * 
			FROM target_table
			WHERE post_id =$post_id
			AND MONTH LIKE  '$month%'");
		$stmt3->execute();
		$result3 = $stmt3->fetchall();
		foreach ($result3 as $row3) {
			$target=$row3['amount']; //echo"Tar".$target;
		}
		
        echo '{"target":"' . $target . '",
				"achieve":"' . $achieve . '"}';
		
		
	}else{
		echo '{"status": "error"}';
	}
?>


    

<?php
    include('../db_connect.php');
    if(isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];
		//$user_id = 1;
		$statement=$conn->prepare("SELECT area  FROM target_table WHERE salesman_id='$user_id'");
		$statement->execute();
		$result = $statement->fetchColumn();
		
		
		$company_id = $_GET['company_id'];
		$statement=$conn->prepare("SELECT shop_name, phone,road_no, thana, district,area FROM shop_table
		WHERE area='$result'");
		$statement->execute();
		$results=$statement->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results);
		echo$json;
		
		
	}else{
        echo '{"status": "error"}';
    }
		
		
		
?>




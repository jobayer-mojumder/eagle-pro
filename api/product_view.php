<?php
    include('../db_connect.php');
    
    if(isset($_GET['company_id'])) {
		$company_id = $_GET['company_id'];

		$statement=$conn->prepare("SELECT * FROM `service_table`");
		$statement->execute();
		$results=$statement->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results);
		echo$json;
		
		
	}else{
        echo '{"status": "error"}';
    }

?>



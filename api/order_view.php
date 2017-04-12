<?php
    include('../db_connect.php');
    
    //$t= $date = date('Y');#echo$t;
	$month=date('M');//echo$month;
    if(isset($_GET['user_id'])) {
		//$company_id = $_GET['company_id'];
		$company_id = 1;
		$user_id = $_GET['user_id'];
		$statement=$conn->prepare("SELECT 
			order_table.order_id, order_table.company_id, order_table.salesman_id, order_table.salesman_id_extra, 
			order_table.customer_name, order_table.phone, order_table.address, order_table.nid, order_table.pickup_date, 
			order_table.pickup_location, order_table.service_type, order_table.service_name, order_table.drop_off_date,
			order_table.drop_off_location, order_table.vehicle_type, order_table.service_price, order_table.month, order_table.year,
			order_table.latitude, order_table.longitude, order_table.order_placed_at, order_table.status, order_table.regtime
			FROM order_table, service_table
			WHERE order_table.service_type = service_table.service_id
			AND order_table.salesman_id_extra =  '$user_id'
			AND order_table.month LIKE '$month%'
			ORDER BY order_table.order_id DESC");
		$statement->execute();
		$results=$statement->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results);
		echo$json;
		
		
	}else{
        echo '{"status": "error"}';
    }

?>



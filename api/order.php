<?php
	include('../db_connect.php');
	$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $regtime=$dt->format('Y-m-d h-i-s');
	if(isset($_GET['salesman_id']) && isset($_GET['service_type'])) {
		
		
		//echo'Dhukse';
		$customer_name = $_GET['customer_name']; #echo $password.'<br>';
		$phone = $_GET['phone']; #echo $password.'<br>';
		$nid = $_GET['nid']; #echo $password.'<br>';
		$pickup_date = $_GET['pickUpDate'];
		//$pickup_date = date('Y-m-d',$pickup_date);echo$pickup_date;

		$pick_up_location=$_GET['pickLocation'];
		$company_id=$_GET['company_id'];//echo$company_id."<br>";
                $service_name=$_GET['service_type'];
                $service_name=substr($service_name,0,strrpos($service_name,'-'));//echo$service_name;
		$service_type=$_GET['service_type'];//echo$product_name."<br>";
		$output=(explode('-',$service_type));
		$service_type=$output[count($output)-1];//echo$service_type;
		$latitude=$_GET['latitude'];
		$drop_off_location=$_GET['drop_of_location'];
		//echo date('M Y');
		$drop_off_date=$_GET['drop_of_date'];
		$latitude=(float)$latitude;//echo$latitude."<br>";
		$longitude=$_GET['longitude'];
		$longitude=(float)$longitude;//echo$longitude."<br>";

		$salesman_id =$_GET['salesman_id'];
		$salesman_id =(int)$salesman_id;

                

		$address=$_GET['address'];//echo$address;
		$service_price="";
		$month=date('M');
		$year=date('Y');
		$order_placed_at=$_GET['gps_address'];//echo$address;
		$status=0;
		//Get Service Price
		$statement=$conn->prepare("SELECT service_table.service_price, post_table.post_id
			FROM service_table, post_table
			WHERE service_table.service_id ='$service_type'
			AND post_table.user_id ='$salesman_id'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $res){
			$service_price=$res['service_price']; //echo$service_price;
			$myPost=$res['post_id']; //echo"Post:".$myPost;
		}

 $holiday_cost=$_GET['holiday_cost'];
                 
if($holiday_cost!= null){
$service_price=(int)$holiday_cost;
}
		
		
		try {
			$stmt = $conn->prepare("INSERT INTO `order_table`(`company_id`, `salesman_id`,`salesman_id_extra`, `customer_name`, `phone`, `address`, `nid`, `pickup_date`,
			`pickup_location`, `service_type`,`service_name`, `drop_off_date`, `drop_off_location`,  `service_price`, `month`, `year`, `latitude`, `longitude`, `order_placed_at`, `status`)
			VALUES (:company_id, :myPost, :salesman_id,:customer_name, :phone, :address, :nid, :pickup_date, :pickup_location, :service_type,:service_name, :drop_off_date, :drop_off_location, 
			:service_price, :month, :year, :latitude, :longitude, :order_placed_at, :status)");

			$stmt->bindParam(':company_id', $company_id);
			$stmt->bindParam(':myPost', $myPost);
			$stmt->bindParam(':salesman_id', $salesman_id);
            $stmt->bindParam(':customer_name', $customer_name);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':address', $address);
			$stmt->bindParam(':nid', $nid);
			$stmt->bindParam(':pickup_date', $pickup_date);
			$stmt->bindParam(':pickup_location', $pick_up_location);
			$stmt->bindParam(':service_type', $service_type);
$stmt->bindParam(':service_name', $service_name);
			$stmt->bindParam(':drop_off_date', $drop_off_date);
			$stmt->bindParam(':drop_off_location', $drop_off_location);

			$stmt->bindParam(':service_price', $service_price);
			$stmt->bindParam(':month', $month);
			$stmt->bindParam(':year', $year);
			$stmt->bindParam(':latitude', $latitude);
			$stmt->bindParam(':longitude', $longitude);
			$stmt->bindParam(':order_placed_at', $order_placed_at);
			$stmt->bindParam(':status', $status);
			$stmt->execute();


			echo'Ok';
		} catch (Exception $e) {
			echo $e->getMessage();
			$msg=5;
		}
		
		
	}

?>


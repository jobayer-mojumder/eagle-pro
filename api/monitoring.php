<?php
 include('../db_connect.php');
    if(isset($_GET['user_id'])) {
			$company_id=$_GET['company_id'];//echo$company_id;
			$company_id=1;
			$user_id =$_GET['user_id'];
			$latitude=$_GET['latitude'];
			$latitude=(float)$latitude;
			$longitude=$_GET['longitude'];
			$longitude=(float)$longitude;
			$user_id =(int)$user_id;
			$address=$_GET['address'];//echo$address;
			$time=date("Y-m-d");//echo$time;
			$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
			$last_entry=$dt->format('Y-m-d h-i-s');
			$check = $conn->prepare("SELECT company_id,user_id,last_entry FROM monitor_table 
			WHERE user_id='$user_id' AND last_entry LIKE '$time%'"); 
			$check->execute();
			$row_count = $check->rowCount();//echo$rowCount;
			if($row_count>=1){
				try {
					$tempCounter=$row_count;
					$stmt = $conn->prepare("UPDATE monitor_table SET latitude='$latitude',longitude='$longitude',address='$address', last_entry='$last_entry' WHERE user_id='$user_id' AND last_entry LIKE '$time%'");
					$stmt->execute();
					echo'success update';
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}else{
				try {
					$stmt = $conn->prepare("INSERT INTO monitor_table (company_id , user_id ,latitude,longitude,address,last_entry)
					VALUES (:company_id ,:user_id,:latitude,:longitude,:address,:last_entry)  ");
					$stmt->bindParam(':company_id', $company_id);
					$stmt->bindParam(':user_id', $user_id );
					$stmt->bindParam(':latitude', $latitude);
					$stmt->bindParam(':longitude', $longitude);
					$stmt->bindParam(':address', $address);
					$stmt->bindParam(':last_entry', $last_entry);
					$stmt->execute();

					echo'success';
				} catch (Exception $e) {
					echo $e->getMessage();
					
				}
			}
		}
?>

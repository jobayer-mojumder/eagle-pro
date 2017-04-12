<?php 
include('db_connect.php');
	//$manager = $_POST['manager'];
	//$supervisor = $_POST['supervisor'];
	//$sales_officer = $_POST['sales_officer'];
	//$conn= getDb();
    $output = "<thead>
                   <tr>
                        <th>SL</th>
                        <th>Ordered By</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Service Type</th>
                        <th>Price</th>
                        <th>Status</th>
                   </tr>
               </thead>
               <tbody>";
               
   // $boss_id = $_SESSION['post_id']; 
   // $post_type = $_SESSION['user_type']; 
   
   $boss_id = $_POST['boss_id'];
   $post_type = $_POST['post_type']; 
    
    if ($post_type == "head")
    {

        $sql = "SELECT p.status, p.order_id, r.full_name, p.salesman_id, q.post_title, p.customer_name, p.phone, p.service_price, s.service_name
        FROM post_table t1
        JOIN post_table t2 ON t1.post_id = t2.boss_id
        JOIN post_table t3 ON t2.post_id = t3.boss_id
        JOIN order_table p ON p.salesman_id = t3.post_id
        JOIN post_table q ON q.post_id = p.salesman_id
        JOIN user_table r ON r.user_id = q.user_id
        JOIN service_table s ON s.service_id = p.service_type
        WHERE t1.boss_id = :boss_id
        ORDER BY p.order_id DESC";
    }    
    else if ($post_type == "manager")
    {
        $sql = "SELECT p.status, p.order_id, r.full_name, p.salesman_id, q.post_title, p.customer_name, p.phone, p.service_price, s.service_name
        FROM post_table t1
        JOIN post_table t2 ON t1.post_id = t2.boss_id
        JOIN order_table p ON p.salesman_id = t2.post_id
        JOIN post_table q ON q.post_id = p.salesman_id
        JOIN user_table r ON r.user_id = q.user_id
        JOIN service_table s ON s.service_id = p.service_type
        WHERE t1.boss_id = :boss_id
        ORDER BY p.order_id DESC";
    }
    else if ($post_type == "supervisor")
    {
        $sql = "SELECT p.status, r.full_name, p.salesman_id, p.customer_name, p.phone, p.service_price, s.service_name
        FROM post_table t1
        JOIN order_table p ON p.salesman_id = t1.post_id
        JOIN post_table q ON q.post_id = p.salesman_id
        JOIN user_table r ON r.user_id = q.user_id 
        JOIN service_table s ON s.service_id = p.service_type
        WHERE t1.boss_id = :boss_id
        ORDER BY p.order_id DESC";
    }
    else if ($post_type == "sales_officer")
    {
        $sql = "SELECT t2.service_name,user_table.full_name, t2.service_price, t1.salesman_id, t1.status, t1.customer_name, t1.phone from order_table t1
                LEFT JOIN service_table as t2 on t1.service_type = t2.service_id                
                LEFT JOIN post_table on post_table.post_id = t1.salesman_id
                LEFT JOIN user_table ON post_table.user_id = user_table.user_id                
                WHERE t1.salesman_id = :boss_id
                ORDER BY t1.order_id DESC";
    }
    
    
              
	$stmt = $conn->prepare($sql);

    $stmt->bindParam(':boss_id', $boss_id);

    $stmt->execute();
    $result = $stmt->fetchall();
    $count = 0;
    $conn='';
    foreach ($result as $row) {
        if ($row["status"] == 0)
        {
            $row["status"] = "Pending";
        }
        else if ($row["status"] == 1)
        {
            $row["status"] = "Approved";
        }
        else if ($row["status"] == 2)
        {
            $row["status"] = "Rejected";
        }
    
        $count++;
        $output .= '
            <tr>
	            <td>'.$count.'</td>
	            <td>'.$row["full_name"].'</td>
	            <td>'.$row["customer_name"].'</td>
	            <td>'.$row["phone"].'</td>
	            <td>'.$row["service_name"].'</td>
	            <td>'.$row["service_price"].'</td>  	            
	            <td>'.$row["status"].'</td>
        	</tr>';
    }

    $output .= '</tbody>';
    echo  $output;

                            
?>
